<?php

Route::get('', function(){
	header ('Location:/admin/cate/backend');
});

// admin
Route::get('admin', function(){
	header ("Location:/admin/cate/backend");
});

Route::get('admin/login', 'App\Controllers\Admin\User\UserController@login');					// login
Route::post('admin/login', 'App\Controllers\Admin\User\UserController@login');

Route::get('admin/create_user', 'App\Controllers\Admin\User\UserController@createUser'); 		// 创建用户
Route::get('admin/test', 'App\Controllers\Admin\User\UserController@test');

Route::get('admin/cate/(:any)', 'App\Controllers\Admin\Catelogue\CatelogueController@index');
Route::post('admin/cate', 'App\Controllers\Admin\Catelogue\CatelogueController@index');
Route::post('admin/cate/tree', 'App\Controllers\Admin\Catelogue\CatelogueController@tree');		// 展示所有的菜单树
Route::post('admin/cate/move', 'App\Controllers\Admin\Catelogue\CatelogueController@move');		// 移动菜单项，向上或者向下
Route::post('admin/cate/edit', 'App\Controllers\Admin\Catelogue\CatelogueController@update');	// 更新菜单
Route::post('admin/cate/reload', 'App\Controllers\Admin\Catelogue\CatelogueController@reload');	// 刷新
Route::post('admin/cate/del', 'App\Controllers\Admin\Catelogue\CatelogueController@del');		// 删除菜单项
Route::post('admin/cate/add', 'App\Controllers\Admin\Catelogue\CatelogueController@add');		// 添加菜单项

Route::get('admin/wechat', 'App\Controllers\Admin\Wechat\WeChatConfController@getAppid');
Route::get('admin/genmenu', 'App\Controllers\Admin\Wechat\WeChatConfController@generageMenu');	// 
Route::get('admin/cleartoken', 'App\Controllers\Admin\Wechat\WeChatConfController@clearToken');

// api
Route::get('api/test', 'App\Api\FileController@test');
Route::get('api/weixin', 'App\Api\CallbackController@weixin');
Route::post('api/weixin', 'App\Api\CallbackController@weixin');

// front
Route::get ('mygame', 'App\Controllers\Front\Game\IndexController@index');