<?php
Route::group(['namespace' => 'Attribute\Http\Controllers', 'prefix'=>'api'], function ($router) {
    $router->post('/attribute/save','AttributeController@save');
    $router->post('/attribute/{id}/value/save','AttributeController@saveValue');
    $router->get('/attribute/{id}/values/list','AttributeController@indexValue');
    $router->post('/attribute/{id}/delete','AttributeController@delete');
    $router->post('/attribute/value/{id}/delete','AttributeController@deleteValue');
    $router->get('/attribute/list','AttributeController@index');
    $router->get('/attribute/edit/{id}','AttributeController@edit');
    $router->get('/attribute/value/edit/{id}','AttributeController@editValue');
    $router->post('/attribute/update/{id}','AttributeController@update');
    $router->post('/attribute/value/update/{id}','AttributeController@updateValue');
});
