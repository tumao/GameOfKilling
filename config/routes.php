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
Route::get('admin/genmenu', 'App\Controllers\Admin\Wechat\WeChatConfController@generageMenu');	// 生成微信菜单
Route::get('admin/cleartoken', 'App\Controllers\Admin\Wechat\WeChatConfController@clearToken');

// api
Route::get('api/test', 'App\Api\FileController@test');
Route::get('api/weixin', 'App\Api\CallbackController@weixin');
Route::post('api/weixin', 'App\Api\CallbackController@weixin');
Route::get ('api/getxml', 'App\Api\CallbackController@getXmlData');

// front
Route::get ('opening', 'App\Controllers\Front\Game\IndexController@opening');		// 开局，创建游戏
Route::post ('opening', 'App\Controllers\Front\Game\IndexController@opening');
Route::get('entering', 'App\Controllers\Front\Game\IndexController@entering');
Route::get ('roomlist', 'App\Controllers\Front\Game\IndexController@roomList');
Route::get ('getwxinfo', 'App\Controllers\Front\Game\IndexController@getWxUserInfo');	// 获取code
Route::get ('room', 'App\Controllers\Front\Game\IndexController@room');			// 房间列表

Route::get('informs', 'App\Controllers\Front\Main\MainController@inform');			// 通知
Route::get('abstracts', 'App\Controllers\Front\Main\MainController@abstracts');		// 简介
Route::get('about', 'App\Controllers\Front\Main\MainController@about');			// 关于