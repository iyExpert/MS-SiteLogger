<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return 'Microservice SiteLogger is running...<br/>' . $router->app->version();
});

$router->group(['prefix' => 'api/v1', 'namespace' => 'API\v1'], function () use ($router) {
    $router->get('ping', ['uses' => 'SiteLoggerController@ping']);
    $router->get('pingdb', ['uses' => 'SiteLoggerController@pingDB']);

    //Logs
    $router->get('logs', ['uses' => 'SiteLoggerController@index']);
    $router->post('logs', ['uses' => 'SiteLoggerController@store']);
    $router->get('logs/{_id}', ['uses' => 'SiteLoggerController@show']);
    $router->delete('logs', 'SiteLoggerController@destroyMultiple');
});
