<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\Su;
use App\Http\Controllers\tool\Wx;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
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

    //生成代参数的二维码
    public function er(){
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wx->access_token().'';
        $data=[
            'expire_seconds'=>2592000,
            'action_name'=>'QR_STR_SCENE',
            'action_info'=>['scene'=>[
                "scene_id"=> 123,
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
    public function zidong(){
        echo $_GET['echostr'];
        die();
    }

}
