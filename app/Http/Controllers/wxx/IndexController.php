<?php

namespace App\Http\Controllers\wxx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
 

  //微信登录
  public function login(){
    $redirect_uri="http://www.myshop.com/wxx/redirect";

    $http ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('APPID')."&redirect_uri=".urlencode($redirect_uri)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
   // dd($http);
    header("location:".$http);

  }
  // 通过code获得access_token
  public function redirect(Request $request){
    $data = $request->all();
    $code = $data['code'];
    $http ="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('APPID')."&secret=".env('APPSECRET')."&code=".$code."&grant_type=authorization_code";
    $info= file_get_contents($http);
    $info = json_decode($info,1);
    $access_token=$info['access_token'];
    $openid=$info['openid'];
    $this->adduser($access_token,$openid,$request);
    // dd($data);
  }
  public function adduser($access_token,$openid,$request){
    //微信登录时存入数据库
    
    //查找数据库中是否有openid的这条数据
    $ooxx=DB::table('user_wechat')->where('openid',$openid)->first();
    if(!empty($ooxx)){
      $user_info = DB::table("user")->where('id',$ooxx->uid)->first();
      $request->session()->put('username',$user_info->name);
      $this->message($openid,$user_info);
      header('Location: http://www.myshop.com/admin/index');

    }else{
   DB::beginTransaction();
    $aaa = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
    $info=file_get_contents($aaa);
    $info = json_decode($info,1);
    //微信登录时添加账号密码
    $id=DB::table('user')->insertGetId([
        'name'=>$info['nickname'],
        'reg_time'=>time(),
        'password'=>'',

      ]);

    $data = DB::table('user_wechat')->insert([
                    'openid'=>$info['openid'],
                    'uid'=>$id,
 
                  ]);
    $user_info = DB::table("user")->where('id',$id)->first();
     $request->session()->put('username',$user_info->name);

   DB::commit();
  $this->message($openid,$user_info);
            //你在我们的网站登录了
   header('Location: http://www.myshop.com/admin/index');


    }
  }

//获取模板列表
public function template(){
  $url="https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=".$this->access_token()."";
  $url=file_get_contents($url);
  dd($url);

}
// 发送模板消息
public function message($openid,$user_info){
  // dd($ooxx);
  $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->access_token().'';
  $data=[
           "touser"=>$openid,
           "template_id"=>"xk7G-cIK6qwIkrw0Bs7pgk0y2E0MIFLHE_PRErWDSiE",
           "url"=>"http://www.baidu.com",  
              
           "data"=>[
                   "first"=> [
                       "value"=>"欢迎登陆",
                       "color"=>""
                   ],
                   "keyword1"=>[
                       "value"=>$user_info->name,
                       "color"=>""
                   ],
                   "keyword2"=> [
                       "value"=>"222",
                       "color"=>""
                   ],
                   "keyword3"=> [
                       "value"=>"4444",
                       "color"=>""
                   ],
                   "remark"=>[
                       "value"=>"12312",
                       "color"=>"",
                   ]
           ]
       ];

  $data=$this->post($url,json_encode($data));
// dd($data);

}

//  post请求页面
  public function post($url, $data ){
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

  //获取用户信息
  public function list(){
  	    $access_token = $this->access_token();
  	    $users=$this->index();
  	    $users=json_decode(json_encode($users),1);
  	    //dd($users);
  	    foreach ($users['openid'] as  $v) {
  	    $user_info= file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$v}&lang=zh_CN");
        $user_info=json_decode($user_info,1);
        // dd($user_info);
        $info[]=$user_info;

    
  	    }
  	    // dd($info);
        
     if(!empty($info)){
         $db=  DB::table('openid')->select('openid')->get()->toarray();
         	foreach ($info as  $v) {
         		// dump($v);
             if(in_array($v['openid'],$db)){
                $data = DB::table('openid')->insert([
                'openid'=>$v['openid'],
                'add_time'=>$v['subscribe_time'],
                'subscribe'=>$v['subscribe'],
                'headimgurl'=>$v['headimgurl'],
                'sex'=>$v['sex'],
                'nickname'=>$v['nickname'],
                'city'=>$v['city'],
              ]);
             }
             
         	


         		
         	}
         }

  // dd($info);

       // dd($user_info);
  }
   //获取用户列表
   public function index(){
	    $access_token = $this->access_token();
    	// dd($access_token);
    	$info =file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid=");
    	$info = json_decode($info);
    	$info = $info->data;
    	return $info;
    	// dd($info);
    }
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

    public function zhanshi(){
        $info = DB::table('openid')->select('nickname','id')->get();
        // dd($info);
        return view('wxx/zhanshi',['info'=>$info]);
    }
    public function zsxq(Request $request){
    	$id=$request->id;
        $info = DB::table('openid')->where('id',$id)->first();
        return view('wxx/zsxq',['info'=>$info]);

        // dd($info);
    }
}
