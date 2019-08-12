<?php

namespace App\Http\Controllers\tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Wx 
{
    //获取微信access_token
    public function access_token(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $data = $redis->get('access_token');
        // $redis->del('access_token');
       // dd($data);
        if(!empty($data)){
        	 // echo 222;
             $data = json_decode($data);
             $access_token = $data->access_token;
        }else{
        	// echo 33;
	        $datas=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('APPID')."&secret=".env('APPSECRET')."");
	    	$data = json_decode($datas);
	    	$access_token = $data->access_token;
	    	$expires_in = $data->expires_in;
	    	$redis->set('access_token',$datas,$expires_in);

        }
        


    	return $access_token;
    }
    //  post请求页面
    public function post($url, $data=[] ){
        //初使化init方法
        $ch = curl_init();
        //指定URL
        curl_setopt($ch, CURLOPT_URL, $url);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //声明使用POST方式来进行发送
        curl_setopt($ch, CURLOPT_POST, 1);
        //发送什么数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //忽略证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return $output;
    }

}
