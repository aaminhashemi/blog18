<?php
Route::group(['namespace' => 'User\Http\Controllers',  'middleware' => ['web','auth:sanctum'],'prefix'=>'api'], function ($router) {
    $router->get('/user/list','UserController@index');
    $router->post('/user/save','UserController@save');
    $router->post('/user/add_role','UserController@addRole');
    $router->get('/user/edit/{user}','UserController@find');
    $router->post('/user/update/{user}','UserController@update');
});
Route::group(['namespace' => 'User\Http\Controllers\Auth',  'prefix'=>'api'], function ($router) {
    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');
    $router->post('/check','AuthController@check');
});

Route::group( ['namespace' => 'User\Http\Controllers\Auth',  'middleware' => ['auth:sanctum'],'prefix'=>'api'],function () {
    Route::post('/logout','AuthController@logout');
});
