<?php
Route::group(['namespace' => 'Slider\Http\Controllers', 'prefix'=>'api'], function ($router) {
    $router->get('/slider/list','SliderController@index');
    $router->post('/slider/save','SliderController@save');
    $router->get('/slider/edit/{id}','SliderController@edit');
    $router->post('/slider/update/{id}','SliderController@update');
    $router->post('/slider/{id}/delete','SliderController@delete');
   // $router->get('/user/edit/{user}','UserController@find');
   // $router->post('/user/update/{user}','UserController@update');
});

