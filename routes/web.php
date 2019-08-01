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







//车票
Route::get('/che/index','che\IndexController@index');
Route::post('/che/add','che\IndexController@add');
Route::post('/che/save','che\IndexController@save');

Route::get('/che/piao','che\IndexController@piao');

//展示页面
Route::get('/che/zhan','che\IndexController@zhan');


//题库
Route::get('/kao/logs','kao\IndexController@logs');
Route::post('/kao/logs_do','kao\IndexController@logs_do');

Route::group(['middleware' => ['kao']], function () {
   Route::get('/kao/add','kao\IndexController@add');
   Route::post('/kao/add_do','kao\IndexController@add_do');
   Route::post('/kao/index','kao\IndexController@index');



});


//周考2
//登录
Route::get('/kao/aaa/','kao\IndexController@aaa');
Route::post('/kao/aaa_do/','kao\IndexController@aaa_do');
// 展示添加考研项目
Route::get('/kao/bbb/','kao\IndexController@bbb');
//添加考研项目
Route::post('/kao/bbb_do/','kao\IndexController@bbb_do');

Route::get('/kao/ccc/','kao\IndexController@ccc');

Route::post('/kao/ccc_do/','kao\IndexController@ccc_do');



//竞猜
Route::get('/cai/index/','cai\IndexController@index');
Route::get('/cai/add/','cai\IndexController@add');
Route::post('/cai/add_do/','cai\IndexController@add_do');

Route::get('/cai/list/','cai\IndexController@list');
Route::get('/cai/list_do/','cai\IndexController@list_do');
Route::post('/cai/do_cai/','cai\IndexController@do_cai');



//停车
Route::get('/ting/log/','ting\IndexController@log');
Route::post('/ting/log_do/','ting\IndexController@log_do');

Route::group(['middleware' => ['ting']], function () {
    Route::get('/ting/index/','ting\IndexController@index');
	Route::get('/ting/add/','ting\IndexController@add');
	Route::post('/ting/add_do/','ting\IndexController@add_do');
	Route::get('/ting/men/','ting\IndexController@men');
	Route::get('/ting/tong/','ting\IndexController@tong');
	Route::post('/ting/men_do/','ting\IndexController@men_do');
	
});

Route::get('/ting/ppp/','ting\IndexController@ppp');
Route::get('/ting/save/','ting\IndexController@save');
Route::get('/ting/save_do/','ting\IndexController@save_do');
Route::post('/ting/ru/','ting\IndexController@ru');
Route::post('/ting/chu/','ting\IndexController@chu');
Route::get('/ting/miao/','ting\IndexController@miao');
Route::post('/ting/shou/','ting\IndexController@shou');



Route::get('deng/log','deng\IndexController@log');
Route::get('deng/zhu','deng\IndexController@zhu');
Route::post('deng/zhu_do','deng\IndexController@zhu_do');
Route::post('deng/log_do','deng\IndexController@log_do');
Route::post('deng/zhu_doo','deng\IndexController@zhu_doo');



Route::get('koo/log','koo\IndexController@log');
Route::post('koo/log_do','koo\IndexController@log_do');

Route::group(['middleware' => ['koo']], function () {
	Route::get('koo/index','koo\IndexController@index');
	Route::get('koo/add','koo\IndexController@add');
	Route::post('koo/add_do','koo\IndexController@add_do');
	Route::get('koo/list','koo\IndexController@list');
	Route::get('koo/delete','koo\IndexController@delete');
    
});



//微信接口
Route::post('wx/notify','wx\IndexController@index');



