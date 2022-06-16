<?php
Route::group(['namespace' => 'Category\Http\Controllers','middleware' => ['web','auth:sanctum'],'prefix'=>'api'], function ($router) {
    $router->get('/category/list','CategoryController@index');
    $router->post('/category/{id}/delete','CategoryController@delete');
    $router->get('/category/non_child/list','CategoryController@parentIndex');
    $router->get('/category/non_child/except/{category}','CategoryController@parentIndexExcept');
    $router->get('/category/edit/{id}','CategoryController@find');
    $router->post('/category/update/{id}','CategoryController@update');
    $router->post('/category/save','CategoryController@save');
    $router->get('/category/menu/list','CategoryController@menuCategory');
    $router->get('/category/{id}/brands','CategoryController@getBrands');
    $router->get('/category/{id}/subcategories','CategoryController@getSubCategories');
    $router->post('/category/{id}/brand/save','CategoryController@saveBrands');
    $router->get('/category/{id}/products','CategoryController@categoryProducts');
    $router->get('/category/{id}/products/{standard}','CategoryController@categoryProductsOrder');
    $router->post('/categories/brand/{id}/delete','CategoryController@deleteBrand');
    $router->post('/category/save/score','CategoryController@saveScore');

    $router->get('/menu','CategoryController@menu');



    // /categories/${id}/brand/${item}/delete
});
/*Route::get('/category/list',[CategoryController::class,'index']);
Route::post('/category/{category}/delete',[CategoryController::class,'delete']);
//Route::get('/product/list',[ProductController::class,'index']);
Route::get('/category/non_child/list',[CategoryController::class,'parentIndex']);
Route::get('/category/non_child/except/{category}',[CategoryController::class,'parentIndexExcept']);
Route::get('/category/{category}',[CategoryController::class,'find']);
Route::post('/category/update/{category}',[CategoryController::class,'update']);
Route::post('/category/save',[CategoryController::class,'save']);*/
