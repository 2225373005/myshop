<?php

namespace App\Http\Controllers\xxxx;

use Illuminate\Http\Request;
use App\Http\Controllers\tool\Wx;
use DB;
class xxoo extends Controller
{
   public $wx;
   public $request;
   public  function __construct(Wx $wx,Request $request)
   {
       $this->wx=$wx;
       $this->request=$request;
   }
   public  function login(){
       return view('xxxx/login');
   }
   public  function login_do(){
       $url_do= asset('xxxx/list');
//       dd($url_do);

       $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('APPID').'&redirect_uri='.urlencode($url_do).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
       header('location:'.$url);
   }
   public  function  list(){
      $data=$this->request->all();
//      dd($data);
       $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('APPID').'&secret='.env('APPSECRET').'&code='.$data['code'].'&grant_type=authorization_code';
       $info=file_get_contents($url);
       $info=json_decode($info,1);
//       dd($info);
//   登录
      $data= DB::table('user_wechat')->join('user','user.id','=','user_wechat.uid')->where('user_wechat.openid',$info['openid'])->first();

//      dd($data);
    if(empty($data)){
        DB::beginTransaction();
        $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$info['access_token'].'&openid='.$info['openid'].'&lang=zh_CN';
        $data=file_get_contents($url);
        $data=json_decode($data,1);
//        dd($data);
        $id=DB::table('user')->insertGetId([
            'name'=>$data['nickname'],
            'password'=>'',
            'reg_time'=>time(),
        ]);
        DB::table('user_wechat')->insert([
            'uid'=>$id,
            'openid'=>$data['openid'],
            'add_time'=>time(),
        ]);
        $this->request->session()->put('name',$data['nickname']);
        DB::commit();
    }else{
//        dd($data->name);
        $this->request->session()->put('name',$data->name);
    }

    $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wx->access_token().'';
    $data=[
           "touser"=>$info['openid'],
           "template_id"=>"xk7G-cIK6qwIkrw0Bs7pgk0y2E0MIFLHE_PRErWDSiE",
           "url"=>asset('xxxx/list_do'),
           "data"=>[
               "first"=> [
                   "value"=>'欢迎登陆',
                       "color"=>"#173177"
                   ],
                   "keyword1"=>[
                   "value"=>$this->request->session()->get('name'),
                       "color"=>"#173177"
                   ],
                   "keyword2"=> [
                   "value"=>env('APP_URL'),
                       "color"=>"#173177"
                   ],
                   "keyword3"=> [
                   "value"=>time(),
                       "color"=>"#173177"
                   ],
                   "remark"=>[
                   "value"=>"222",
                       "color"=>"#173177"
                   ]
           ]
       ];
     $bbb=$this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
     $bbb= json_decode($bbb,1);
//     dd($bbb);
     if($bbb['errcode']==0){
         return redirect('xxxx/list_do');
     }


       //检查access_token知否有效

   }
   //展示列表
   public  function list_do(){
       $app = app('wechat.official_account');
       $user = $app->user->get('ofvtlt41O6T7AjMyUiS-B0ZbJLcI');
       dump($user);

         $data = DB::table('user')->get();
         return view('xxxx/list_do',['data'=>$data]);
   }
   //发送消息
   public function xiao(){
       $id = $this->request->id;
       return view('xxxx/xiao',['id'=>$id]);
   }
   public function xiao_do(){
//       $data=$this->request->all();
//       dd($data);
       $text=$this->request->text;
       $id = $this->request->id;
//       dd($id);
       $info=DB::table('user_wechat')->where('uid',$id)->select('openid')->first();
//      dd($info);
       $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wx->access_token().'';
       $data=[
           "touser"=>$info->openid,
           "template_id"=>"TAmpMh5UsYHknYFNz34COfGh9kb9u_Jlenqh9tdRHyk",
//           "url"=>asset('xxxx/list_do'),
           "data"=>[
               "first"=> [
                   "value"=>$this->request->session()->get('name'),
                   "color"=>"#173177"
               ],
               "remark"=>[
                   "value"=>$text,
                   "color"=>"#173177"
               ],

           ] 
       ];
//       dd($data);
       $data=$this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
       $data=json_decode($data,1);
       if($data['errcode']==0){
         DB::table('afasong')->insert([
             'name'=>$this->request->session()->get('name'),
             'text'=>$text,
         ]);
           return redirect('xxxx/list_do');
       }


   }

}
