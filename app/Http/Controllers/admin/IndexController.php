<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Goods;
use DB;
use App\Http\Controllers\tool\Wx;
use GuzzleHttp\Client;
class IndexController extends Controller
{
    public function log(){
        return view('admin/log');
    }
    public function log_do(){
        

        $url ="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN";
    }

   //微信素材添加
   public function sucai(){

    return view('admin/sucai');
   }
   public function sucai_do(Wx $wx,Request $request){
   // $data=$request->all();
   $client = new Client();
   if($request->hasFile('image')){
    //图片
    $path = $request->file('image')->store('wechat/image');
    // dd($path);
    $path = './storage/'.$path;

    $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$wx->access_token().'&type=image';
    
 
          $response = $client->request('post',$url,[
                'multipart' => [
                        [
                            'name'     => 'image',
                            'contents' => fopen(realpath($path), 'r'),
                        ]
                    ]
                
            ]);
    $body=$response->getBody();
    unlink($path);
    echo $body;
    dd();


    
   }elseif($request->hasFile('voice')){
    //语音 
    $img_file = $request->file('voice');
    // 获取音频的后缀名/
    $file_ext = $img_file->getClientOriginalExtension();
    //重命名
    $file_name=time().rand(1111,9999).'.'.'MP3';
    // dd($file_name);
    //保存文件
    $file_name = $img_file->storeAs('wechat/voice',$file_name);
    // dd($file_name);
    //保存路径
    $path="./storage/".$file_name;

    $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$wx->access_token().'&type=voice';

     $response = $client->request('post',$url,[
                'multipart' => [
                        [
                            'name'     => 'voice',
                            'contents' => fopen(realpath($path), 'r'),
                        ]
                    ]
                
            ]);
     // dd($response);
    $body=$response->getBody();
     unlink($path);
    echo $body;
    dd();
    // dd($file_ext);
  
   }elseif($request->hasFile('video')){
    //视屏
       $img_file = $request->file('video');
       // 获取音频的后缀名/
       $file_ext = $img_file->getClientOriginalExtension();
       //重命名
       $file_name=time().rand(1111,9999).'.'.'MP4';
//        dd($file_name);
       //保存文件
       $file_name = $img_file->storeAs('wechat/video',$file_name);
//        dd($file_name);
       //保存路径
       $path="./storage/".$file_name;

       $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$wx->access_token().'&type=video';

       $response = $client->request('post',$url,[
           'multipart' => [
               [
                   'name'     => 'video',
                   'contents' => fopen(realpath($path), 'r'),
               ]
           ]

       ]);
       // dd($response);
       $body=$response->getBody();
       unlink($path);
       echo $body;
       dd();
   }else{
    //缩略图
       $path = $request->file('thumb')->store('wechat/thumb');

   }

   
    
    return view('admin/sucai');
   }


    public function index(){
        return view('admin/index');
    }
    public function add(Request $request){
        $path = $request->file('goods_pic')->store('admin');

        $data = $request->all();

        $flight = new Goods;
        $flight->goods_name=$data['goods_name'];
        $flight->goods_price=$data['goods_price'];
        $flight->goods_up=$data['goods_up'];
        $flight->goods_num=$data['goods_num'];
        $flight->goods_content=$data['goods_content'];
        $flight->goods_pic=$path;
        $flight->add_time=time();

        $model=$flight->save();

        if($model){
            return redirect('admin/list_goods');
        }

        dd($model);
        dd($data);
    }
    public function add_goods(){
        return view('admin/add_goods');
    }
    public function list_goods(Request $require){


        
        //访问量
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $num = $redis->incr('good_num');
        // echo $num;
        $goods_name = $require->goods_name??'';
        // dd($goods_name);
        $where= [
            ['goods_name','like',"%$goods_name%"]
        ];
        $model = DB::table('goods')->where($where)->paginate(2);
        // dd($model);
        return view('admin/list_goods',['model'=>$model,'goods_name'=>$goods_name,'num'=>$num]);
    }
    public function update(Request $request){
        $goods_id = $request->goods_id;
        $where=[
           ['goods_id','=',$goods_id],
        ];
        $data = DB::table('goods')->where($where)->first();
        return view('admin/update_list',['data'=>$data]);
        
    }

    public function goods_update(Request $request){
        $data = $request->all();
        unset($data['_token']);
        
        $path = $request->file('goods_pic');
        if($path){
           $path=$path->store('admin');
           $data['goods_pic']=$path;
           
           
        }else{
            unset($data['goods_pic']);
           
        }
        $where = [
            ['goods_id','=',$data['goods_id']]
        ];
        $info = DB::table('goods')->where($where)->update($data);
        // dd($path);
        // dd($data);
        // dd($info);
        if($info){
           return redirect('admin/list_goods');
        }
    }

    public function user(){
        $info = DB::table('deng')->get();
        // dd($info);
        return view('admin/user',['info'=>$info]);
    }
    public function shouquan(Request $request){
        $id = $request->all();
        $where=[
            ['id','=',$id],
        ];
        $info = DB::table('deng')->where($where)->update(['root'=>'1']);
        if($info){
            echo json_encode(['code'=>'1','msg'=>1]);
        }else{
            echo json_encode(['code'=>'2','msg'=>2]);

        }
    }
}
