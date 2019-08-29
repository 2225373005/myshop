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
//登录
Route::get('/admin/log/', 'admin\IndexController@log');

Route::get('/admin/log_do/', 'admin\IndexController@log_do');

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
//微信素材添加 
Route::get('/admin/sucai/', 'admin\SuController@sucai');
Route::post('/admin/sucai_do/', 'admin\SuController@sucai_do');
//素材列表
Route::get('/admin/list/', 'admin\SuController@list');
//获取图片的临时素材
Route::get('/admin/tupian/', 'admin\SuController@tupian');
Route::get('/admin/get_voice_source/', 'admin\SuController@get_voice_source');
Route::get('/admin/tupian/', 'admin\SuController@tupian');

//获取永久素材
Route::get('/admin/sucai_yong/', 'admin\SuController@sucai_yong');




//添加用户标签
Route::get('/admin/biao/', 'admin\SuController@biao');
Route::post('/admin/biao_do/', 'admin\SuController@biao_do');
Route::get('/admin/biao_list/', 'admin\SuController@biao_list');
Route::get('/admin/biao_update/', 'admin\SuController@biao_update');
Route::get('/admin/biao_del/', 'admin\SuController@biao_del');
Route::get('/admin/biao_da/', 'admin\SuController@biao_da');
Route::post('/admin/biao_da_do/', 'admin\SuController@biao_da_do');
//获取标签下的粉丝列表
Route::get('/admin/biao_fei/', 'admin\SuController@biao_fei');
Route::post('/admin/biao_fei_do/', 'admin\SuController@biao_fei_do');
//获取用户的标签
Route::get('/admin/yong/', 'admin\SuController@yong');
//根据标签给用户发送消息
Route::get('/admin/biao_song/', 'admin\SuController@biao_song');
Route::post('/admin/biao_song_do/', 'admin\SuController@biao_song_do');


Route::post('/admin/biao_update_do/', 'admin\SuController@biao_update_do');

//微信二维码页面
Route::get('/admin/er_index/', 'admin\SuController@er_index');

//生成代参数的二维码
Route::get('/admin/er/', 'admin\SuController@er');
//永久二微码
Route::get('/admin/err/', 'admin\SuController@err');
//专属二微码
Route::get('/admin/wo/', 'admin\SuController@wo');

//微信自动回复
Route::post('/admin/zidong/', 'admin\SuController@zidong');

//微信菜单添加
Route::get('/admin/caidan/', 'admin\SuController@caidan');
Route::post('/admin/caidan_do/', 'admin\SuController@caidan_do');
Route::get('/admin/diaoyong/', 'admin\SuController@diaoyong');
//微信菜单展示列表
Route::get('/admin/cai_list/', 'admin\SuController@cai_list');


//微信表白
Route::get('/admin/biao_index/', 'admin\SuController@biao_index');
Route::post('/admin/biao_add/', 'admin\SuController@biao_add');
Route::get('/admin/biao_wo/', 'admin\SuController@biao_wo');
Route::get('/admin/biao_wode/', 'admin\SuController@biao_wode');
Route::get('/admin/biao_woyao/', 'admin\SuController@biao_woyao');

Route::post('/admin/biao_woyao_do/', 'admin\SuController@biao_woyao_do');
Route::get('/admin/biao_token/', 'admin\SuController@biao_token');
Route::get('/admin/access_token/', 'admin\SuController@access_token');

//微信油价
Route::get('/admin/you_index/', 'admin\SuController@you_index');

Route::get('/admin/pppp/', 'admin\SuController@pppp');


Route::get('/admin/class/', 'admin\SuController@class');
Route::post('/admin/class_add/', 'admin\SuController@class_add');
Route::get('/admin/class_list/', 'admin\SuController@class_list');
Route::get('/admin/class_caidan/', 'admin\SuController@class_caidan');
Route::get('/admin/aaa/', 'admin\SuController@aaa');







Route::get('/tool/index/', 'tool\You@index');












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

Route::get('wxx/index','wxx\IndexController@index');
Route::get('wxx/list','wxx\IndexController@list');
Route::get('wxx/zhanshi','wxx\IndexController@zhanshi');
Route::get('wxx/zsxq','wxx\IndexController@zsxq');

//微信登录
Route::get('wxx/login','wxx\IndexController@login');
Route::get('wxx/redirect','wxx\IndexController@redirect');
Route::get('wxx/adduser','wxx\IndexController@adduser');


Route::get('wxx/log','wxx\IndexController@log');
//获取模板列表
Route::get('wxx/template','wxx\IndexController@template');
//发送模板消息
Route::get('wxx/message','wxx\IndexController@message');

////我的表白
//Route::get('xxoo/index','admin\BiaoController@index');
//Route::post('xxoo/add','admin\BiaoController@add');

//周考
Route::get('xxxx/login','xxxx\xxoo@login');
Route::get('xxxx/login_do','xxxx\xxoo@login_do');

Route::get('xxxx/list','xxxx\xxoo@list');
Route::get('xxxx/list_do','xxxx\xxoo@list_do');
Route::get('xxxx/xiao','xxxx\xxoo@xiao');
Route::post('xxxx/xiao_do','xxxx\xxoo@xiao_do');








