<?php

use Illuminate\Support\Facades\Route;
/** @var \Illuminate\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/', function () {
    return csrf_token(); 
});


$router->post('/hash/', ['uses' => 'HashController@generate',    'as'   => 'hash.generate']);

$router->get('/hash/{string}', ['uses' => 'HashController@visit',    'as'   => 'hash.visit']);

$router->get('/hash/', ['uses' => 'HashController@index',    'as'   => 'hash.index']);



