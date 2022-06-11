<?php
Route::group(['namespace' => 'RolePermission\Http\Controllers','prefix'=>'api'], function ($router) {
    $router->get('/permission/list','RolePermissionController@Permissions');
    $router->post('/permission/save','RolePermissionController@savePermission');

    $router->get('/role/list','RolePermissionController@Roles');
    $router->post('/role/save','RolePermissionController@saveRole');
});
