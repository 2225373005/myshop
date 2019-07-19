<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['login']], function () {
   Route::get('/user/add/', 'StudentController@add');
   Route::get('/user/index/', 'StudentController@index');
	Route::get('/user/delete/', 'StudentController@delete');
	// Route::get('/user/add/', 'StudentController@add');
	Route::post('/user/add_do/', 'StudentController@add_do');
	Route::get('/user/update/', 'StudentController@update');
	Route::post('/user/save/', 'StudentController@save');
});

Route::get('/user/login/', 'StudentController@login');
Route::post('/user/login_do/', 'StudentController@login_do');

//项目
Route::get('/index/login/', 'index\IndexController@login');
Route::get('/index/index/', 'index\IndexController@index');
Route::post('/index/login_do/', 'index\IndexController@login_do');
Route::get('/index/register/', 'index\IndexController@register');
Route::post('/index/register_do/', 'index\IndexController@register_do');
//文件上传
Route::get('/index/add_goods/', 'index\IndexController@add_goods');
Route::post('/index/add_goods_do/', 'index\IndexController@add_goods_do');
// 前台详情页
Route::get('/index/details/', 'index\IndexController@details');
//加入购物车
Route::get('/index/cart/', 'index\IndexController@cart');
//购物车显示
Route::get('/index/cart_do/', 'index\IndexController@cart_do');
//确认订单页面
Route::get('/index/xxoo/', 'index\IndexController@xxoo');




//后端
Route::get('/admin/index/', 'admin\IndexController@index');
Route::post('/admin/add/', 'admin\IndexController@add');
Route::get('/admin/add_goods/', 'admin\IndexController@add_goods');
Route::get('/admin/list_goods/', 'admin\IndexController@list_goods');

Route::get('/admin/update_list/', 'admin\IndexController@update_list');
Route::post('/admin/goods_update/', 'admin\IndexController@goods_update');
Route::group(['middleware' => ['update']], function () {
	Route::get('/admin/update/', 'admin\IndexController@update');
});
Route::get('/admin/user/', 'admin\IndexController@user');
Route::post('/admin/shouquan/', 'admin\IndexController@shouquan');


//支付宝调用  同步
Route::get('/zhifubao/', 'PayController@do_pay');
Route::get('/return_url/', 'PayController@aliReturn');//同步
Route::post('/notify_url/', 'PayController@aliNotify');//异步

//前台订单页面
Route::get('/index/dingdan/', 'index\IndexController@dingdan');




