<?php
Route::group(['namespace' => 'Product\Http\Controllers', 'prefix'=>'api'], function ($router) {
    $router->get('/product/{id}/edit','ProductController@edit');
    $router->get('/product/list','ProductController@index');
    $router->post('/product/save','ProductController@save');
    $router->post('/product/{id}/gallery/upload','ProductController@gallerySave');
    $router->get('/product/{id}/gallery','ProductController@getGallery');
    $router->post('/product/{id}/update','ProductController@update');
    $router->post('/product/{id}/delete','ProductController@delete');
});
