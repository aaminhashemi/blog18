<?php
Route::group(['namespace' => 'User\Http\Controllers',  'middleware' => ['web'],'prefix'=>'api'], function ($router) {
    $router->get('/users/list','UserController@index');
    $router->get('/user/edit/{user}','UserController@find');
    $router->post('/user/update/{user}','UserController@update');
});
Route::group(['namespace' => 'User\Http\Controllers\Auth',  'prefix'=>'api'], function ($router) {
    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');
});

Route::group( ['namespace' => 'User\Http\Controllers\Auth',  'middleware' => ['auth:sanctum'],'prefix'=>'api'],function () {
    Route::post('/logout','AuthController@logout');
});
