<?php

namespace App\Http\Controllers\kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Deng;
use App\Http\Controllers\tool\Wx;
use Illuminate\Support\Facades\Cache;
class ZhouController extends Controller
{
    public $request;
    public $wx;
    public function __construct (Request $request,Wx $wx){
        $this->request=$request;
        $this->wx=$wx;
    }
    public function login(){
        $name= $this->request->name;
        $pwd= $this->request->pwd;
//        $token= $this->request->token;
//        dd($name);
      if(empty($name) || empty($pwd)){
            return json_encode(['code'=>201,'msg'=>'参数错误']);
        }

        $data= Deng::where('name',$name)->where('pwd',$pwd)->first();

        if($data){
            $token=md5($data['id'].time());
            $this->request->session()->put('zhou_id',$data['id']);
            Deng::where('id',$data['id'])->update([
                'token'=>$token,
                'extime'=>time()+7200,
            ]);
            return json_encode(['code'=>200,'token'=>$token]);
        }else{
            return json_encode(['code'=>202,'msg'=>'没有此用户']);
        }
    }

    public function cha(){

        $table='result';
        if(empty(Cache::get($table))){
            $url='http://api.k780.com:88/?app=weather.future&weaid=1&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json';
            $data =file_get_contents($url);
            $data=json_decode($data,1);
            $time=time();
            $ling=strtotime(date('Y-m-d 24:00:00'));
            $ling=$ling-$time;
            Cache::put($table,$data[$table],$ling);
            $data= json_encode($data[$table]);
        }else{
            $data= Cache::get($table);
        }
//        dd($data);
        return $data;

//        dd($data);
//  Cache::put('qq', '1');
//
//        $data=json_decode($data,1);
//        Cache::put('qq', '1');
//        dd( Cache::get('qq'));
//        dd($data);
    }

}
