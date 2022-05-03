<?php

use Illuminate\Support\Arr;


function make_title( $title = null )
{
    $title = Arr::wrap( $title );

    array_push( $title, config( 'app.name' ) );

    return join( ' - ', $title );
}

function form_fields( $method )
{
    $method = strtoupper( $method );

    return new \Illuminate\Support\HtmlString( view( 'common.form.defaults', compact( 'method' ) ) );
}