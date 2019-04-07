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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', 'SpaController@index');

$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate',
    ]
);

$router->group(['prefix' => 'positions'], function () use ($router) {
    $router->get('/', 'PositionController@index');

    $router->post('store', 'PositionController@store');
    
    $router->post('update', 'PositionController@update');
    
    $router->post('delete', 'PositionController@delete');
    
});

$router->group(['prefix' => 'candidates'], function () use ($router) {
    $router->get('/', 'CandidateController@index');

    $router->post('store', 'CandidateController@store');
    
    $router->post('update', 'CandidateController@update');
    
    $router->post('delete', 'CandidateController@delete');
    
});

$router->group(['prefix' => 'companies'], function () use ($router) {
    $router->get('/', 'ClientController@index');

    $router->post('store', 'CandidateController@store');
    
    $router->post('update', 'ClientController@update');
    
    $router->post('delete', 'CandidateController@delete');
    
});