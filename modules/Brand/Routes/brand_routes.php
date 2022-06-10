<?php
Route::group(['namespace' => 'Brand\Http\Controllers', 'prefix'=>'api'], function ($router) {
    $router->get('/brand/list','BrandController@index');
    $router->get('/brand/category/{id}/list','BrandController@brandCategoryIndex');
    $router->post('/brand/save','BrandController@save');
    $router->get('/brand/edit/{id}','BrandController@find');
    $router->post('/brand/update/{id}','BrandController@update');

});
