<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use DOMDocument;
use Illuminate\Support\Str;



class GenerateHash implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var int */
    public $tries = 3;

    public $timeout = 1200;

    /** @var string */
    private $string;

    /** @var int */
    private $requests;

    /** @var int */
    private $attempt;

    /** @var datetime */
    private $start;

    public function __construct( $string)
    {
        $this->string = 'http://www.google.com/';

        
    }

    public function handle()
    {

        $key = Str::random(8);
        $hash = md5($key.$this->string);
        $substring = substr($hash,0,4);

        $hashed_url = ShortUrl::where('hash', $substring)->first();

        if($hashed_url){

            $hashed_url->count++;
            $hashed_url->save();

        }else{

            $httpClient = new \GuzzleHttp\Client();
            $response = $httpClient->get($this->string);
            $htmlString = (string) $response->getBody();

            libxml_use_internal_errors(true);
            $doc = new DOMDocument();
            $doc->loadHTML($htmlString);
            $elements = $doc->getElementsByTagName('title');

            $title = $elements->item(0)->textContent;



            $hashed_url = ShortUrl::create([
                'full_url' => $this->string,
                'hash' => $substring,
                'title' => $title? $title:'title',
                'count' => 1
            ]);
        }


        return $hashed_url->hash;
    }
    
}
