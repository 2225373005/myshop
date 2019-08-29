<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\Su;
use App\Http\Controllers\tool\Wx;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use DB;
class SuController extends Controller
{

    public $request;
    public $client;
    public $wx;
    public $su;
    public function __construct(Request $request,Su $su,Wx $wx,Client $client)
    {
        $this->request=$request;
        $this->su=$su;
        $this->wx=$wx;
        $this->client=$client;

    }
    public function sucai(){

        return view('admin/sucai');
    }
    //获取永久素材
    public function sucai_yong(){
        $url='https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$this->wx->access_token().'';

        $res= $this->client->post($url, [
            'query' =>
                [
                    'access_token'=>$this->wx->access_token(),
                    'media_id' => 'Yc32EPu6VDqzekCAWelNWLlvXqRXtPena2xQCs1J6sA',

                ],

        ]);
        $body = $res->getBody();
//        $res = json_decode($body, 1);
        echo ($body);
    }


    //上传素材
    public function  sucai_do(Request $request){
        $ooxx=$request->ooxx;
        if($request->hasFile('image')){
            $aa=$this->su->index($ooxx,'image');
            echo $aa;
            dd();
        }elseif ($request->hasFile('voice')){
            $aa=$this->su->index($ooxx,'voice');
            echo $aa;
            dd();
        }elseif ($request->hasFile('video')){
            $aa=$this->su->index($ooxx,'video');
            echo $aa;
            dd();
        }else{
            $aa=$this->su->index($ooxx,'thumb');
            echo $aa;
            dd();
        }
//       $data=$this->request->file('image');
//       dd($data);
    }
    //获取图片的临时素材
    public function tupian(){
        $data = $this->su->dan();
        dd($data);
    }
    //获取视频的临时素材
    public function video(){
        $media_id = 'f9-GxYnNAinpu3qY4oFadJaodRVvB6JybJOhdjdbh7Z0CR0bm8nO4uh8bqSaiS_d'; //视频
        $url = 'http://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wx->access_token().'&media_id='.$media_id;
        $client = new Client();
        $response = $client->get($url);
        $video_url = json_decode($response->getBody(),1)['video_url'];
        $file_name = explode('/',parse_url($video_url)['path'])[2];
        //设置超时参数
        $opts=array(
            "http"=>array(
                "method"=>"GET",
                "timeout"=>3  //单位秒
            ),
        );
        //创建数据流上下文
        $context = stream_context_create($opts);
        //$url请求的地址，例如：
        $read = file_get_contents($video_url,false, $context);
        $re = file_put_contents('./storage/wechat/video/'.$file_name,$read);
        var_dump($re);
        die();
    }
    //获取音频
    public function get_voice_source()
    {
        $media_id = 'HhMgA923598lLtqYsFBZcJlKhdZY75RHO6PaPFEpBxNZGR7LPb_3HpxwwaJnLC5-';
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wx->access_token().'&media_id='.$media_id;
        //echo $url;echo '</br>';
        //保存图片
        $client = new Client();
        $response = $client->get($url);
        //$h = $response->getHeaders();
        //echo '<pre>';print_r($h);echo '</pre>';die;
        //获取文件名
        $file_info = $response->getHeader('Content-disposition');
        $file_name = substr(rtrim($file_info[0],'"'),-20);
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'wechat/voice/'.$file_name;
        $re = Storage::put($path, $response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);
    }

    //素材列表
    public function list(){


        $url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->wx->access_token().'';
//        $client=new Client;
        $aaa= [
            'type'=>'image',
            'offset'=>0,
            'count'=>20,
        ];
        $auth=json_encode($aaa);
//        dd($auth);
        $res = $this->wx->post($url,$auth);
        dump($res);
        dd();
        echo $res->getBody();

    }

    public function biao(){
        return view('admin/biao');
    }
    public function biao_do(Request $request){
        $data=$request->name;
//        dd($data);
        $url='https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->wx->access_token().'';
        $datas=[
            'tag'=>[
                'name'=>$data,
            ]
        ];
        $info=$this->wx->post($url,json_encode($datas,JSON_UNESCAPED_UNICODE));
//        $datas=json_encode($datas);
//        dd($info);
        if($info){
            return redirect('admin/biao_list');
        }
    }
    public function biao_list(){
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$this->wx->access_token()."";
        $data=file_get_contents($url);

        $data=json_decode($data,1);
        return view('admin/biao_list',['data'=>$data]);

    }
    public function biao_update(Request $request){
//        dd('123');
        $id=$request->id;
        return view('admin/biao_update',['id'=>$id]);
    }
    public function  biao_update_do(Request $request){
        $id=$request->id;
        $name=$request->name;
        $url="https://api.weixin.qq.com/cgi-bin/tags/update?access_token=".$this->wx->access_token()."";
        $data=[
            'tag'=>[
                'id'=>$id,
                'name'=>$name,
            ]

        ];
        $data= $this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        if($data){
            return redirect('admin/biao_list');
        }
    }

    //删除标签
    public function biao_del(Request $request){
        $id=$request->id;
        $url="https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=".$this->wx->access_token()."";
        $data=[
            "tag"=>[
                'id'=>$id,
            ]
        ];
        $info=$this->wx->post($url,json_encode($data));
        return redirect('admin/biao_list');
    }

    //为粉丝打标签展示
    public function biao_da(Request $request){
        $id=$request->id;
        $url='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->wx->access_token().'';
        $data=file_get_contents($url);
        $data=json_decode($data,1)['data'];
//        dd($data);
        return view('admin/biao_da',['data'=>$data,'id'=>$id]);
    }
    //为粉丝打标签
    public function biao_da_do(Request $request){
        $name=$request->name;
        $id=$request->id;

//       dd($name);
        $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->wx->access_token().'';
        $data=[
            'openid_list'=>$name,
            'tagid'=>$id
        ];
        $data=json_encode($data);
//       dd($data);
        $data= $this->wx->post($url,$data);
        return redirect('admin/biao_list');
    }

    //获取粉丝标签下的粉丝列表
    public function biao_fei(Request $request){
        $id= $request->id;
        $url='https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$this->wx->access_token().'';
        $data =[
            'tagid'=>$id,
        ];
        $data=$this->wx->post($url,json_encode($data));
        $data=json_decode($data,1)['data'];
//   dd($data);

        return view('admin/biao_fei',['data'=>$data,'id'=>$id]);
    }

    //取消标签下的粉丝
    public function biao_fei_do(Request $request){
        $name=$request->name;
//        dd($name);
        $id=$request->id;
        $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.$this->wx->access_token().'';
        $data=[
            'openid_list'=>$name,
            'tagid'=>$id,
        ];

        $data=$this->wx->post($url,json_encode($data));
        dd($data);
    }

    //获取用户的标签
    public function yong(Request $request){
        $openid=$request->openid;
        $url='https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->wx->access_token().'';
        $data=[
            'openid'=>$openid,
        ];
        $data=$this->wx->post($url,json_encode($data));
        //用户身上的标签
        $data=json_decode($data,1)['tagid_list'];
        $url1='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->wx->access_token().'';
        $datas=file_get_contents($url1);
        $datas=json_decode($datas,1)['tags'];
//     dd($data);
        foreach ($data as $v){
            foreach ($datas as $vo){
                if($v==$vo['id']){
                    echo $vo['name'].'&nbsp';
                }
            }
        }

//     dd($data);
//     return view('admin/yong',['data'=>$data]);
//     dd($data);
    }

    //跟据标签给用户发送消息
    public function biao_song(Request $request){
//        dd(11);
        $id=$request->id;

        return view('admin.biao_song',['id'=>$id]);
    }

    public function  biao_song_do(Request $request){
        $datas = $request->all();
//        dd($datas);
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->wx->access_token().'';
        $data=[ 'filter'=>[
            'is_to_all'=>false,
            'tag_id'=>$datas['id'],
        ],
            'text'=>[
                'content'=>$datas['name']
            ],
            'msgtype'=>'text',
        ];
        $data = $this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));

        dd($data);
    }
    //生成二微码页面
    public function er_index(){
        $data = DB::table('user')->get();
//        dd($data);

        return view('admin/er_index',['data'=>$data]);
    }
    //生成代参数的二维码
    public function er(){
        $id=$this->request->id;
//        dd($id);
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wx->access_token().'';
        $data=[
            'expire_seconds'=>2592000,
            'action_name'=>'QR_LIMIT_STR_SCENE',
            'action_info'=>['scene'=>[
                "scene_id"=> $id,
            ]],
        ];
        $data=$this->wx->post($url,json_encode($data));
        $data=json_decode($data,1);
//        dd($data);
        $url1='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$data['ticket'].'';
        header('location:'.$url1);
//        dd($url1);
//         $info=file_get_contents($url1);
//         echo $info;
        dd();
        return view();
    }
    //生成永久二维码
    public function err(){
        $id=$this->request->id;
//        dd($id);
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wx->access_token().'';

        $data=[
            'action_name'=>'QR_LIMIT_STR_SCENE',
            'action_info'=>['scene'=>[
                'scene_str'=>$id,
            ]],
        ];
//        dd($data);
        $data=$this->wx->post($url,json_encode($data));
        $data=json_decode($data,1);
//        dd($data);
        $urll='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$data['ticket'].'';
//        dd($urll);
        $client = new Client();
        $response = $client->get($urll);
//        dd($response->getBody());
        //获取文件名
        $h = $response->getHeaders();
//        dd($h);
        //echo '<pre>';print_r($h);echo '</pre>';die;
        $ext = explode('/',$h['Content-Type'][0])[1];
        $file_name = time().rand(1000,9999).'.'.$ext;
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'wx/'.$file_name;
//        dd($path);
        $re = Storage::disk('local')->put($path, $response->getBody());
        $qrcode_url = env('APP_URL').'/storage/'.$path;
//        dd($qrcode_url);
        //二维码存入larvel

        $aa=DB::table('user')->where('id',$id)->update(['qrcode'=>$urll,'agent_code'=>$qrcode_url]);
        if($aa){
            return redirect('admin/er_index');
        }

//        header('location:'.$url1);

    }
    //专属二维码
    public function wo(){
        $id=$this->request->id;
        $data = DB::table('user')->where('id',$id)->select('qrcode')->first();
//        dd($data);
        echo $data->qrcode;
    }

    //自动回复
    public function zidong(){
         //链接redis
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');

//        echo $_GET['echostr'];
//        die();;
        $data = file_get_contents("php://input");
//        dd($data);
        $xml = simplexml_load_string($data,'SimpleXMLElement', LIBXML_NOCDATA);
        $xml = (array)$xml; //转化成数组
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents(storage_path('logs/wx_event.log'),$log_str,FILE_APPEND);
//        dd($xml);
        if($xml['MsgType']=='event'){


            if($xml['Event']=='subscribe'){
//            echo $xml;
//            dd();

//                $uid= explode('_',$xml['EventKey'])[1];
//                $app = app('wechat.official_account');
//                $user = $app->user->get($xml['FromUserName']);
//
//                $info=DB::table('openid')->where('openid',$user['openid'])->first();
//                if(empty($info)){
//                      DB::table('openid')->insert([
//                        'openid'=>$user['openid'],
//                        'add_time'=>time(),
//                        'subscribe'=>$user['subscribe'],
//                        'headimgurl'=>$user['headimgurl'],
//                          'sex'=>$user['sex'],
//                          'nickname'=>$user['nickname'],
//                          'city'=>$user['city'],
//                          'num'=>0,
//                    ]);
//                }
//
//                $app = app('wechat.official_account');
//                $user = $app->user->get('ofvtlt41O6T7AjMyUiS-B0ZbJLcI');
//
//                $info=DB::table('openid')->where('openid',$user['openid'])->first();
//                if(!empty($info)){
//
//                    DB::table('openid')->insert([
//                        'openid'=>$user['openid'],
//                        'add_time'=>time(),
//                        'subscribe'=>$user['subscribe'],
//                        'headimgurl'=>$user['headimgurl'],
//                        'sex'=>$user['sex'],
//                        'nickname'=>$user['nickname'],
//                        'city'=>$user['city'],
//                        'num'=>0,
//                    ]);
//                }



//
                //二维码有参数
//                $agent_info = DB::table('user_wechat')->where(['uid'=>$uid,'openid'=>$xml['FromUserName']])->first();
//                if(empty($agent_info)){
//                    DB::table('user_wechat')->insert([
//                        'uid'=>$uid,
//                        'openid'=>$xml['FromUserName'],
//                        'add_time'=>time()
//                    ]);
//                }

                $message = '你好!';
                $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;

            }elseif($xml['Event']=='CLICK'){
                if($xml['EventKey']=='wodebiaobai'){
                    $openid=$xml['FromUserName'];
                    $data = DB::table('biao_bai')->where('openid',$openid)->get();
                    $message='';
                    foreach ($data as $v){
                        $message .= '收到'.$v->name.'表白:'.$v->text."\n";
                    }
//                    dd($message);
////                    dd($data);
//                    $message = '';
                    $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                    echo $xml_str;
                }elseif($xml['EventKey']=='kecheng'){
                $data =DB::table('class')->where('openid',$xml['FromUserName'])->first();
                    $data=json_decode($data,1);
                if(empty($data)){
                    $message='没有选修课程,请选修课程';
                    $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                    echo $xml_str;
                }else{

  $message= '第一节'.$data['class1']."\n".'第2节'.$data['class2']."\n".'第3节'.$data['class3']."\n".'第4节'.$data['class4'];
                    $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                    echo $xml_str;

//                    $message='已选';
//                    $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
//                    echo $xml_str;
                }

                }

            }else{

                $message = '你好!';
                $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }
        }elseif($xml['MsgType']=='text'){
           $content=$xml['Content'];
//           dd($content);
           $geshi='/^.*?油价$/';  //正则要验证的格式
           if(preg_match($geshi,$content)){
               //截取内容前两个子
               $aaa=substr($content,0,-6);
//               dd($aaa);
//            dd(111);
               $redis->incr($aaa);
               //
               if($redis->get($aaa.'油价')){
//                   $redis->del($aaa.'油价');
                   $info=$redis->get($aaa.'油价');
//                   dd($info);
                   $v=json_decode($info,1);
                   $message = $v['city'].'目前油价:'."\n".'92:'.$v['92h'].'元'."\n".'95h:'.$v['95h']."\n".'98h:'.$v['98h']."\n".'0h:'.$v['0h'];

                   $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
//                       dd(11);
                   echo $xml_str;
//                   dd('我是redis');


               }else{
                   $url='http://www.wantwo.cn/tool/index';
                   $data=file_get_contents($url);
                   $data=json_decode($data,1);

                   foreach ($data['result'] as$v){
                       if($v['city']==$aaa){

                           if($redis->get($aaa)>=5){
//                               $data=$redis->get($aaa.'油价');
                               $redis->set($aaa.'油价',json_encode($v));
                           }
//                       dd(11);
                           $message = $v['city'].'目前油价:'."\n".'92:'.$v['92h']."\n".'95h:'.$v['95h']."\n".'98h:'.$v['98h']."\n".'0h:'.$v['0h'];

                           $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
//                       dd(11);
                           echo $xml_str;
                       }
                   }

               }

//               if($redis->get($aaa)>=6){
//                  if($redis->get($aaa.'油价')){
//                      $data=$redis->get($aaa.'油价');
//                      $data=json_decode($data,1);
////                      dd('我是redis');
////                      echo 111;
//                  }else{
////                      dd(22);
//                      $url='http://www.wantwo.cn/tool/index';
//                      $data=file_get_contents($url);
//
//                      $redis->set($aaa.'油价',$data);
////                      $data=json_decode($data,1);
//
//                  }
//
//               }else{
////                   dd(33);
//                   //油价接口
//                   $url='http://www.wantwo.cn/tool/index';
//                   $data=file_get_contents($url);
//                   $data=json_decode($data,1);
//
////                   dd($data);
//                   $redis->incr($aaa);
////                   dd($redis->get($aaa));
////                   dd($data);
//               }
//               foreach ($data['result'] as$v){
//
//                   if($v['city']==$aaa){
////                       dd(11);
//                       $message = $v['city'].'目前油价:'."\n".'92:'.$v['92h']."\n".'95h:'.$v['95h']."\n".'98h'.$v['98h']."\n".'0h'.$v['0h'];
//
//                       $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
////                       dd(11);
//                       echo $xml_str;
//
//                   }
//               }



           }
//           dd(22);
           else{
                $message = '没有此城市';

                $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }
//           dd(222);




            $message = '你好!';
            $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
        }

//        \Log::Info(json_encode($xml));

    }
    //微信菜单添加
   public function caidan(){
        $data = DB::table('wx_cai')->where('type','event')->select('id','name')->get();


        return view('admin/caidan',['data'=>$data]);
   }
    public function caidan_do(){
        $data = $this->request->all();
        if(empty($data['zi'])){
           $data['zi']=0;
        }
        $info = DB::table('wx_cai')->where('zi',$data['zi'])->count();
//        dd($info);
        if($info<5){
            $data = DB::table('wx_cai')->insert([
                'name'=>$data['name'],
                'type'=>$data['type'],
                'zi'=>$data['zi'],
                'names'=>$data['names'],
                'url'=>$data['url'],
            ]);

            if($data){
                $this->diaoyong();
            }
        }else{
            echo "子菜单已满,请删除一条";
        }

    }
    //刷新微信菜单
    public  function  diaoyong(){
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wx->access_token().'';

//        dd($url);
        $data=DB::table('wx_cai')->get()->toArray();
//        dd($data);
        $info=array();
        $bbb=array();
        foreach ($data as $v){
//            dd($v->type);
            if($v->zi=='0' && $v->type=='click'){
//                dd($v);
                    $info[]=[
                        "type"=>"click",
                          "name"=>$v->name,
                          "key"=>'V1001_TODAY_MUSIC',
                    ];
            }elseif($v->type=='event'){

//                dd($v->id);
                $data=DB::table('wx_cai')->where('zi',$v->id)->get()->toArray();
//                dd($data);

                foreach ($data as $d){

                    $aaa=[
                           "type"=>'view',
                           "name"=>$d->names,
                           "url"=>$d->url,
                   ];
                    $bbb[]=$aaa;

                }
                $info[]=[
                    "name"=>$v->name,
                    "sub_button"=>$bbb,
                    ];
                $bbb=[];

            }
        }
        $data =[
            "button"=>
                $info
        ];
//        dd($data);
       $info = $this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
      if($info){
          return redirect('admin/cai_list');
      }

    }

    public function cai_list(){
        $data = DB::table('wx_cai')->get();
        $info=array();
        foreach ($data as $v){

            if($v->zi==0){
                $info[]=$v;
                foreach ($data as $vo ) {
                   if($v->id==$vo->zi){
                       $info[]=$vo;
                   }
                }
            }
        }


        return view('admin/cai_list',['info'=>$info]);
    }
   //微信添加表白
    public  function biao_index(){
        return view('admin.biao_index');
    }
    //微信表白添加
    public function  biao_add(){
//        dd(222);
        $data = $this->request->all();
        unset($data['_token']);
        $info = DB::table('biao')->insert($data);
        if($info){
            return redirect('admin/biao_wo');
        }

    }

    public  function  biao_wo(){
        //按用户查询一级分类
        $data= DB::table('biao')->groupBy('name')->select(['name'])->get();
//        dd($data);
        $xxoo=[];
        foreach ($data as $v){
//            dump($v);
            //查询二级分类
            $info = DB::table('biao')->where('name',$v->name)->get();
//            dump($info);
//            $xxoo=[];
            $sub_button=[];
            foreach ($info as $vo){

                if($vo->yi==1) {

                    if ($vo->type == 'click') {
                        $xxoo['button'][] = [
                            'type' => 'click',
                            "name" => $vo->name,
                            "key" => $vo->view,
                        ];
                    } elseif ($vo->type == 'view') {
                        $xxoo['button'][] = [
                            'type' => 'view',
                            "name" => $vo->name,
                            "url" => $vo->view,
                        ];
                    }
                }
                if($vo->yi==2){

//                    dump(11);
                    if($vo->type=='view'){

                         $sub_button[]=[
                             "type"=>"view",
                               "name"=>$vo->names,
                               "url"=>$vo->view,
                         ];
                    }elseif($vo->type=='click'){
                        $sub_button[]=[
                            "type"=>"click",
                            "name"=>$vo->names,
                            "url"=>$vo->view,
                        ];
                    }
                }

            }
            if(!empty($sub_button)){
                $xxoo['button'][] = ['name'=>$v->name,'sub_button'=>$sub_button];

            }
        }

        $url ="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->wx->access_token()."";
//        dd($url);
//        dd($xxoo);
//dd($url);
        $info = $this->wx->post($url,json_encode($xxoo,JSON_UNESCAPED_UNICODE));

//        dd($info);
    }
    //我的表白
    public function biao_wode(){
     return view('admin/biao_wode');
    }
    public function access_token(){
//        $url_do=asset('admin/biao_token');
        $url_do=asset('admin/class_list');

        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('APPID').'&redirect_uri='.$url_do.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('location:'.$url);
    }
    public function biao_token(){
       $data = $this->request->all();
//       $data=json_decode($data,1);
//       dd($data);
       $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('APPID').'&secret='.env('APPSECRET').'&code='.$data['code'].'&grant_type=authorization_code';
       $info=file_get_contents($url);
       $info=json_decode($info,1);
//       dd($info);
       $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$info['access_token'].'&openid='.$info['openid'].'&lang=zh_CN';
       $data=file_get_contents($url);
       $data=json_decode($data,1);

//       dd($data);
        $this->request->session()->put('name',$data['nickname']);

        return redirect('admin/biao_woyao');
    }

    //我要表白
    public  function  biao_woyao(){

      $url='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->wx->access_token().'';
      $info=file_get_contents($url);
      $info=json_decode($info,1);
      $info=$info['data']['openid'];
      foreach ($info as $v){
        $aaa[]=['openid'=>$v];
      }
      $url='https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token='.$this->wx->access_token().'';
//      $data=file_get_contents($url);

      $where=[
        'user_list'=>
            $aaa,

      ];
//      dd($where);
      $data=$this->wx->post($url,json_encode($where));
      $data=json_decode($data,1)['user_info_list'];
//      dd($data['user_info_list']);
//      dd($where);
//      dd($info);
        return view('admin/biao_woyao',['data'=>$data,'xxoo'=>$this->request->session()->get('name')]);
    }
    //表白内容添加
    public function  biao_woyao_do(){
        $data= $this->request->all();
        $info = DB::table('biao_bai')->insertGetId([
            'text'=>$data['text'],
            'name'=>$data['name'],
            'openid'=>$data['openid'],
        ]);
        if($info){

            $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wx->access_token().'';
            $data=[
                "touser"=>$data['openid'],
                "template_id"=>"uMyjs0sDBxYe40wqSkwl8B3IbzO6romYUJymExYh77o",

                "data"=>[
                    'first'=>[
                        'value'=>$data['name'],
                    ],
                    'last'=>[
                        'value'=>$data['text'],
                    ]
                ]
            ];
            $biao_info=$this->wx->post($url,json_encode($data));
            dd($biao_info);

        }
    }

    //油价
    public function you_index(){
        $app = app('wechat.official_account');

        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $url='http://www.wantwo.cn/tool/index';
        \Log::info('222');
//        dd($url);
        $data=file_get_contents($url);

//         dd($data);
        $data = json_decode($data,1)['result'];
//        dd($data);
        foreach ($data as $v){
//             dump($v);
            if($redis->exists($v['city'].'油价')){
                $info = $redis->get($v['city'].'油价');
                $info = json_decode($info,1);
//                   dump($info);
//                    dump($v);
                $ppp=0;
                foreach ($v as $k=>$vv){
                    if($vv != $info[$k]){
                        $ppp=1;

                    }
                }
//                dd($ppp);
                if($ppp==1){
                    $xxoo = $app->user->list($nextOpenId = null);
//                    dd($xxoo);
                    $xxoo = $xxoo['data']['openid'];
//                    dd($xxoo);
//dump($v);
                    foreach ($xxoo as $vo){
//   dd($vo);
//                            $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$wx->access_token().'';

                        $app->template_message->send([
                            "touser"=>$vo,
                            "template_id"=>"s-jfOJfqLa2kX7nXsS7trHmo2akdFlMESWBoFMXoRSk",
                            "data"=>[
                                "aaa"=>[
                                    "value"=>$v['city'].'最新油价'."\n",
                                    "color"=>"#173177"
                                ],
                                "bbb"=>[
                                    "value"=>'92:'.$v['92h'].'元'."\n".'95h:'.$v['95h']."\n".'98h:'.$v['98h']."\n".'0h:'.$v['0h']."\n",
                                    "color"=>"#173177"
                                ],
                                "fff"=>[
                                    "value"=>date('Y-m-d',time())."\n",
                                    "color"=>"#173177"
                                ]
                            ]

                        ]);
//                              dd($data);
//                            $data = $wx->post($url,json_encode($oooo,JSON_UNESCAPED_UNICODE));
//                              dd($data);
//                            dump($data);

                    }
                }


            }
        }
        /*
        $wx = new Wx();
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $url='http://www.wantwo.cn/tool/index';
//        dd($url);
        $data=file_get_contents($url);

//         dd($data);
        $data = json_decode($data,1)['result'];
//        dd($data);
        foreach ($data as $v){
//             dump($v);
            if($redis->exists($v['city'].'油价')){
                $info = $redis->get($v['city'].'油价');
                $info = json_decode($info,1);
//                   dump($info);
//                    dump($v);
                $ppp=0;
                foreach ($v as $k=>$vv){
                    if($vv != $info[$k]){
                        $ppp=1;

                    }
                }
                if($ppp==1){
                    $xxoo = DB::table('openid')->select('openid')->get()->toArray();
//dump($v);
                    foreach ($xxoo as $vo){
//   dd($vo);
                        $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$wx->access_token().'';

                        $oooo = [
                            "touser"=>$vo->openid,
                            "template_id"=>"s-jfOJfqLa2kX7nXsS7trHmo2akdFlMESWBoFMXoRSk",
                            "data"=>[
                                "aaa"=>[
                                    "value"=>$v['city'].'最新油价'."\n",
                                    "color"=>"#173177"
                                ],
                                "bbb"=>[
                                    "value"=>'92:'.$v['92h'].'元'."\n".'95h:'.$v['95h']."\n".'98h:'.$v['98h']."\n".'0h:'.$v['0h']."\n",
                                    "color"=>"#173177"
                                ],
                                "fff"=>[
                                    "value"=>date('Y-m-d',time())."\n",
                                    "color"=>"#173177"
                                ]
                            ]

                        ];
//                              dd($data);
                        $data = $wx->post($url,json_encode($oooo,JSON_UNESCAPED_UNICODE));
//                              dd($data);
//                            dump($data);

                    }
                }


            }
        }
//        dd($data);

*/
    }


    public function pppp(){
        $str='ccdsasdas';
        $num = strlen($str);
        $d="";
        $c=0;
        for($i=0;$i<=$num-1;$i++){
            $a=substr($str,$i,1);
            $b=substr($str,$i+1,1);

           if($a==$b){
            $c+=1;
           }

           if($a!=$b){
              if($c!=0){
                  $d.=$c.$a;
              }else{
                  $d.=$a;
              }
             $c=0;
           }
        }
        dd($d);
    }


    public function class(){
     $openid = $this->request->session()->get('openid');
       return view('admin/class',['openid'=>$openid]);
    }

    public function class_updete(){
        $openid = $this->request->session()->get('openid');
        $data = DB::table('class')->where('openid',$openid)->first();
        return view('admin/class_updete',['data'=>$data]);

    }
    public function class_update_do(){
        $data= $this->request->all();
        $data['num']+=1;
//        $time =mktime('2019-09-01');

        if($data['num']>=3 ){
            dd('不能修改');
        }else{
          unset($data['_token']);
          $info = DB::table('class')->where('openid',$data['openid'])->update($data);
          if($info){
              dd('修改完成');
          }
        }
//       dd($data);

    }
    public function class_add(){
        $data=$this->request->all();
        unset($data['_token']);
        $info=DB::table('class')->insert($data);

//        if($info){
//            return redirect('admin/class_list');
//        }
    }
    public  function class_list(){
        $data = $this->request->all();
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('APPID').'&secret='.env('APPSECRET').'&code='.$data['code'].'&grant_type=authorization_code';
        $info=file_get_contents($url);
        $info=json_decode($info,1);
        $this->request->session()->put('openid',$info['openid']);
//        dd($info['openid']);
        $xxoo = DB::table('class')->where('openid',$info['openid'])->first();
//        dd($xxoo);
        if($xxoo){
            return redirect('admin/class_updete');
        }else{
            return redirect('admin/class');
        }


//        return view('/admin/class_list');
    }

    public function class_caidan(){
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wx->access_token().'';
//        dd($url);
        $data=[
            "button"=>[
                 [
                     "type"=>"click",
                      "name"=>"查看课程",
                      "key"=>"kecheng",
                  ],
                [
                    "type"=>"view",
                    "name"=>"查看课程",
                    "url"=>'http://www.wantwo.cn/admin/accesss_token',
                ],
        ],
    ];
//        dd($data);
        $data=$this->wx->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        dd($data);

    }


  public function aaa(){
      $app = app('wechat.official_account');
      $user = $app->user->get('ofvtlt41O6T7AjMyUiS-B0ZbJLcI');

      $info=DB::table('openid')->where('openid',$user['openid'])->first();
      if(!empty($info)){

         DB::table('openid')->insert([
              'openid'=>$user['openid'],
              'add_time'=>time(),
              'subscribe'=>$user['subscribe'],
              'headimgurl'=>$user['headimgurl'],
              'sex'=>$user['sex'],
              'nickname'=>$user['nickname'],
              'city'=>$user['city'],
              'num'=>0,
          ]);
      }
  }









}
