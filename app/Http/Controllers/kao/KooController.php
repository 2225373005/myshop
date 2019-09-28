<?php

namespace App\Http\Controllers\kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\tool\Wx;
class KooController extends Controller
{
    public function index(){
        return view('aaaa/index');
    }

    public function login(Request $request){
//        dd(11);
        $phone=$request->phone;
        $verify_code=$request->verify_code;
        $password=$request->password;
        $source=$request->source;
        if( empty($phone ) || empty($verify_code)  || empty($password) || empty($source)){
            return json_encode(['code'=>201,'msg'=>'参数不全']);
        }
        if($verify_code!='123456'){
            return json_encode(['code'=>202,'msg'=>'验证码错误']);
        }
        $data=DB::table('deng')->where('name',$phone)->first();
        if($data){
            return json_encode(['code'=>203,'msg'=>'已有手机号']);
        }
        $info=DB::table('deng')->insert([
            'name'=>$phone,
            'pwd'=>$password,
            'source'=>$source,
        ]);
        if($info){
            return json_encode(['code'=>200,'msg'=>'注册成功']);
        }
    }

    public function login_do(Request $request){
        $name = $request->phone;
        $pwd  = $request->password;
//        dd($name);
        $data = DB::table('deng')->where('name',$name)->where('pwd',$pwd)->first();
        if(!$data){
            return json_encode(['code'=>204,'msg'=>'用户或密码错误']);
        }
        $time=time();
//        dd($data->id);
        $token=md5($time.$data->id);
        DB::table('deng')->where('id',$data->id)->update([
            'token'=>$token,
            'extime'=>$time+7200,
        ]);
        return json_encode(['code'=>200,'msg'=>'登录成功','token'=>$token]);
//        dd($token);
    }

    //订单接口
    public function ding(Request $request){
        $token =$request->token;
        if(empty($token)){
            return json_encode(['code'=>207,'msg'=>'没有token参数']);
        }
        $data=DB::table('deng')->where('token',$token)->first();
//        dd($data);
        if($data){
            $info =DB::table('shop_goodsattr')->where('a_id',$data->id)->get();
//            dd($info);
            return json_encode(['code'=>200,'msg'=>'我的订单','data'=>$data]);
        }
    }

    public function zhao(Request $request){
        $data =$request->all();
        $aaa='';
//        dd($data);
        foreach ($data['names'] as $k=>$v){
            $aaa.=$v.'='.$data['can'][$k].'&';
        }

        if($data['xxoo']=='get'){

            $aaa=trim($aaa,'&');
            $aaa=trim($aaa,'"');
//            dd($data['url'].'?'.$aaa);
            $url=$data['url'].'?'.$aaa;
            $data = file_get_contents($url);
        }else{
            $xxoo=[];
            foreach ($data['names'] as $k=>$v){
//                dump($v);
                $xxoo[$v]=$data['can'][$k];
            }
//            dd($xxoo);
            $data=Wx::post($data['url'],$data);
        }


//   dd($aaa);


        dd($data);
    }

}
