<?php

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

$router->group(['prefix' => 'api'], function () use ($router) {
    
    $router->post('/login', 'AuthController@login');
    $router->post('/register','AuthController@register');
    $router->post('/logout', 'AuthController@logout');

});

$router->group(['prefix' => 'api', 'middleware' => ['client.credentials']], function () use ($router) {

    $router->group(['prefix' => 'account'], function () use ($router) {
        $router->get('/', ['uses' => 'AccountController@index']);
        $router->get('/currentUserAccount', ['uses' => 'AccountController@currentUserAccount']);
        $router->post('/', ['uses' => 'AccountController@store']);
        $router->get('/{account}', ['uses' => 'AccountController@show']);
        $router->patch('/{account}', ['uses' => 'AccountController@update']);
        $router->delete('/{account}', ['uses' => 'AccountController@destroy']);
    });

});
