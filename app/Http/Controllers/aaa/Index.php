<?php

namespace App\Http\Controllers\aaa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\Aes;
use App\Http\Controllers\tool\Rsa;
use DB;

class Index extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public  function log(){
        phpinfo();
           die();
//        dd('/gongsiyao/private.php');
        $private=file_get_contents('./gongsiyao/private.txt');
        $public=file_get_contents('./gongsiyao/public.txt');
//        dd($data);
        //举个粒子
        $Rsa = new Rsa();
// $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
// p($keys);
        $privkey = $private;//$keys['privkey'];
        $pubkey  = $public;//$keys['pubkey'];
//        dd($privkey);
//echo $privkey;die;
//初始化rsaobject
        $Rsa->init($privkey, $pubkey,TRUE);

//原文
        $data = '志国你爸让你回家吃饭来';

//私钥加密示例
//加密
        $encode = $Rsa->priv_encode($data);
        var_dump($encode);
//解密
        $ret = $Rsa->pub_decode($encode);
        var_dump($ret);

//公钥加密示例
//加密
        $encode = $Rsa->pub_encode($data);
        var_dump($encode);
//解密
        $ret = $Rsa->priv_decode($encode);
        var_dump($ret);

//        $obj = new Aes('1234567890123456');
//        $url = "13439704307";
//        echo $eStr = $obj->encrypt($url);
//        echo "<hr>";
//        $eStr='hLlDHcFgKgfDJMNR8yWFVq3ZFRmKh1TXFbV0G/qFE+rtT98uUvbIYMxK+Du4/OJ8A1Eal28skNg6ie10w80Xc8IbBJRLtmavduUC5IkceDf/haoh56jPxgIBTbgBa0a9YRDb5FrDWyQdA8VWMqEJpSZ0Ck99CR5Uxu/zKUU5U+amdhjLrn8pVJ5nSYx4KF3s';
//        echo $obj->decrypt($eStr);
//        dd(111);
//        return view('aaa/log');
    }

    public  function log_do(){
        $data=$this->request->all();
        $info=DB::table('deng')->where('name',$data['name'])->where('pwd',$data['pwd'])->first();
        if($info){
            $this->request->session()->put('name',$data['name']);
            return redirect('aaa/list');
        }else{
            return redirect('aaa/log');
        }
    }

    public function list(){
        $name=$this->request->name;
        $where=[
                 ['subscribe','=',1],
            ];

        if(!empty($name)){
             $where[]=

                 ['nickname','=',$name]
             ;
//             dd($where);
        }

        $data = DB::table('openid')->where($where)->paginate(2);

//        dd($data);
        return view('aaa/list',['data'=>$data,'name'=>$name]);
    }

    public function sign(){
        return view('aaa/sign');
    }
    public function sign_do(){
        $date=date('Y-m-d');
        $date=strtotime($date);
//        echo time();
//        dd($date);
        $data=DB::table('qdjl')->where('uid',1)->orderBy('id','desc')->first();
        if($data->sign_time){

        }else{

        }
//        dd($data);

        $data=DB::table('lxqd')->where('name','老表')->first();
        if($data->sign_day<5 ){
            $data->sign_day+=1;
            $data->fen+=$data->sign_day*5;
            dd($data);
        }else{
            $data->sign_day=1;
            $data->fen+=$data->sign_day*5;
        }
//        dd($day);


        $data=DB::table('qdjl')->insert([
            'sign_time'=>time(),
            'uid'=>1,
        ]);
        if($data){


        }

        return view('aaa/sign_do');
    }


}
