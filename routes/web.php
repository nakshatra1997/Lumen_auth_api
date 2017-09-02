<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->get('/boards/{board}','BoardController@show');
$app->get('/boards','BoardController@index');
$app->post('/boards','BoardController@store');
$app->put('/boards/{boards}','BoardController@update');
$app->delete('/boards/{boards}','BoardController@destroy');
$app->post('/login','AuthController@login');
$app->get('/logout','AuthController@logout');
$app->post('/register','AuthController@register');