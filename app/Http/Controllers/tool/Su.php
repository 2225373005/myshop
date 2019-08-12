<?php

namespace App\Http\Controllers\tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Http\Controllers\tool\Wx;
use Illuminate\Support\Facades\Storage;
class Su
{
    public $request;
    public $client;
    public function __construct(Request $request,Client $client,Wx $wx)
    {
        $this->request=$request;
        $this->client=$client;
        $this->wx=$wx;

    }

    public function index($lei,$type){
        //获取上传文件的上传类型
        $path = $this->request->file($type);
//        dd($path);
        //获取文件的后缀
        $file_ext = $path->getClientOriginalExtension();
//        dd($file_ext);
        //重命名文件
        $file_ext = time().rand(1000,999).'.'.$file_ext;
//        dd($file_ext);
        //上传文件
        $save_file_path  = $path->storeAs('wechat/'.$type,$file_ext);
        //获取绝对路径
        $path='./storage/'.$save_file_path;
        //临时素材
        if($lei==1){
            $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->wx->access_token()."&type=".$type."";

        //永久素材
        }else{
           $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$this->wx->access_token()."&type=".$type."";
        }
//                    dd($url);

        if($type == 'video' && $lei == 2){

            $multipart[] = [
                'id'     => 'description',
                'contents' => json_encode(['title'=>'VIDEO_TITLE','introduction'=>'INTRODUCTION'])
            ];
        }
        $multipart=[
            [
                'name'     => 'media',
                'contents' => fopen(realpath($path), 'r'),
            ],
        ];
//        dd($multipart);

        $res = $this->client->request('post',$url,
            [
                'multipart' => $multipart

            ]);
        $body = $res->getBody();
        unlink($path);

        return $body;
    }
  //获取临时素材
    //图片
    public function dan(){
        $id='BzlUl7nylf9CXB_KDZCh1bsSdRKWRODf9rk5-JbeD142YDhf0IM6m0IwLIS2oSBx';

        $url='https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wx->access_token().'&media_id='.$id.'';
//       dd($url);
//        $data = file_get_contents($url);
        $client = new Client();
        $response = $client->get($url);
//        dd($response);
//        $response = $this->client->get($url);
        //获取文件名
        $file_info = $response->getHeader('Content-disposition');
//        dd($file_info);
        $file_name = substr(rtrim($file_info[0],'"'),-20);
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'wechat/image/'.$file_name;
        $re = Storage::disk('local')->put($path, $response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);

//       return $response;
    }
//音频



    public function list(){
        $url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->wx->access_token().'';
//        dd($url);
        $res = $this->client->request('post', $url, [
            'multipart' => [
                [
                    'type'
                ]

            ]
        ]);
    }




}
