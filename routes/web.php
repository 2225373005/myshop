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
Route::post('/index/login_do/', 'index\IndexController@login_do');
Route::get('/index/register/', 'index\IndexController@register');
Route::post('/index/register_do/', 'index\IndexController@register_do');
//文件上传
Route::get('/index/add_goods/', 'index\IndexController@add_goods');
Route::post('/index/add_goods_do/', 'index\IndexController@add_goods_do');

