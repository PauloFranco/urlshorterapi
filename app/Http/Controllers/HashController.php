<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateHash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Hash;
use App\Models\ShortUrl;
use DOMDocument;

class HashController extends Controller
{

    public function index(){


        $urls = ShortUrl::all()->sortByDesc('count')->take(100);


        return $urls;
    }

    public function generate(Request $request){


        $string = $request->get('full_url');


         GenerateHash::dispatch($string);


            return "OK";
            
    }

    public function visit(Request $request, $string){


        $hashed_url = ShortUrl::where('hash', $string)->first();

        $hashed_url->count++;
        $hashed_url->save();

        $url = $hashed_url->full_url;

        return redirect()->away($url);

    }
}
