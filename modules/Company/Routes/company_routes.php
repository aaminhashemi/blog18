<?php
Route::group(['namespace' => 'Company\Http\Controllers','prefix'=>'api'], function ($router) {
    $router->get('/company/list','CompanyController@index');
    $router->post('/company/{id}/delete','CompanyController@delete');
    $router->get('/company/edit/{id}','CompanyController@find');
    $router->post('/company/delete/{id}','CompanyController@delete');
    $router->post('/company/update/{id}','CompanyController@update');
    $router->post('/company/save','CompanyController@save');
});
