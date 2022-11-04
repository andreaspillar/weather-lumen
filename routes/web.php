<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('/register', 'AuthController@registerUser');
    $router->post('/login', 'AuthController@login');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api/v1'], function ($router){
    $router->get('/logout', 'AuthController@logout');
});

$router->group(['middleware' => 'auth', 'prefix' => 'api/v1/weather'], function ($router){
    $router->post('/add', 'WeatherController@add');
    $router->get('/retrieve', 'WeatherController@retrieveAll');
    $router->get('/retrieve/{id}', 'WeatherController@retrieveId');
});