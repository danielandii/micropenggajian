<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=> 'api'] , function()use ($router){
    
    $router ->get ('gaji' , ['uses' => 'GajiController@index']);
   
    $router ->get ('gaji/{id}' , ['uses' => 'GajiController@show']);

    $router ->delete ('gaji/{id}' , ['uses' => 'GajiController@destroy']);
    
    $router ->put ('gaji/{id}' , ['uses' => 'GajiController@update']);
    
    $router ->post ('gaji' , ['uses' => 'GajiController@create']);


    $router ->get ('histori_gaji' , ['uses' => 'HistoriGajiController@index']);
   
    $router ->get ('histori_gaji/{id}' , ['uses' => 'HistoriGajiController@show']);

    $router ->delete ('histori_gaji/{id}' , ['uses' => 'HistoriGajiController@destroy']);
    
    $router ->put ('histori_gaji/{id}' , ['uses' => 'HistoriGajiController@update']);
    
    $router ->post ('histori_gaji' , ['uses' => 'HistoriGajiController@create']);


    $router ->get ('user' , ['uses' => 'UserController@index']);
   
    $router ->get ('user/{id}' , ['uses' => 'UserController@show']);

    $router ->delete ('user/{id}' , ['uses' => 'UserController@destroy']);
    
    $router ->put ('user/{id}' , ['uses' => 'UserController@update']);
    
    $router ->post ('user' , ['uses' => 'UserController@create']);

    $router->get('getUserHistoriGaji/{id}', ['uses' => 'UserController@getUserHistoriGaji'] );
    
});

