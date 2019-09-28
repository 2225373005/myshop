<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\ShopCategory;
use App\Http\Model\ShopAttribute;
use App\Http\Model\ShopType;
use App\Http\Model\ShopGoods;
use App\Http\Model\ShopGoodsattr;
use App\Http\Model\ShopCargo;
use App\Http\Model\ShopCart;  //购物车表
use App\Http\Model\Deng;
use Illuminate\Support\Facades\Cache;
class ShopController extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    //登录
    public function login(){
        $name = $this->request->name;
        $pwd = $this->request->pwd;
//        $data=$this->request->all();
//        dd($data);
        $data=Deng::where('name',$name)->where('pwd',$pwd)->first();
        if($data){
            $token=md5($data['id'].time());
            $info=Deng::where('id',$data['id'])->update([
                'token'=>$token,
                'extime'=>time()+7200,
            ]);
//            dd($token);
            if($info){
                $this->request->session()->put('deng_id', $data['id']);
                return json_encode(['code'=>'200','msg'=>'登录成功','token'=>$token]);
            }
        }else{
            return json_encode(['code'=>'201','msg'=>'请先正确登录']);
        }

    }
    //加入购物车
    public function shop_gou(){
        //属性id
        $attr_id=$this->request->attr_id;
        $attr_id=implode(',',$attr_id);
//        dd($attr_id);
        //商品id   通过 html页面 url获取的
        $id=$this->request->id;
        //用户id  token中间键授权时传过来的
        $deng_id=$this->request->get('deng_id');
//        dd($deng_id);
        $data=ShopCart::insert([
            'g_id'=>$id,
            'u_id'=>$deng_id,
            'number'=>1,
            'attr'=>$attr_id,
            'create_time'=>time(),
        ]);
        if($data){
            return json_encode(['code'=>'200','msg'=>'添加成功']);
        }
//        dump($data);
//        dd($attr_id);
    }
    //购物车展示
    public function shop_gou_list(){
        //用户id  token中间键授权时传过来的
//        $arr=[];
        $deng_id=$this->request->get('deng_id');
        $data=ShopCart::where('shop_cart.u_id',1)->LeftJoin('shop_goods','shop_cart.g_id','=','shop_goods.g_id')->get()->toArray();
        foreach ($data as $key=>$value){
//            dump($value['attr']);
            $attr=explode(',',$value['attr']);
            $arr=[];
//            dump($attr);

            foreach ($attr as$k=>$v){
                $data[$key]['attr_shu'][]=ShopGoodsattr::where('shop_goodsattr.attr_id',$v)->leftJoin('shop_attribute','shop_goodsattr.a_id','=','shop_attribute.aid')->get()->toArray();
            }
//
//            dump($arr);

        }
//        dd($data);
        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }

    }

//    public function yan(){
//        $token=$this->request->token;
////        dd($token);
//        if(empty($token)){
//            return json_encode(['code'=>'203','msg'=>'请传参数']);
//        }
//        $data = Deng::where('token',$token)->first();
//        if($data){
//                $time=time();
//                if($time>$data['extime']){
//                    //时间过期
//                    return json_encode(['code'=>'205','msg'=>'token过期']);
//                }else{
//                    //实时更新
//                    Deng::where('token',$token)->update([
//                        'extime'=>time()+7200,
//                    ]);
//
//                }
//
//        }else{
//            return json_encode(['code'=>'204','msg'=>'请先登录']);
//        }
//
//
//    }
  //首页展示
    public function index(){
//        header('content-type:application:json;charset=utf8');
//        header('Access-Control-Allow-Origin:*');
//        header('Access-Control-Allow-Methods:POST');
//        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        $biao = 'shop_goods';
////
        $value = Cache::get($biao);
//        dd($value);
        //jsonp传输
//        $jsoncallback='';
        if(!empty($_GET['callback'])){
            $jsoncallback=$_GET['callback'];
        }

//        dd($jsoncallback);
        if($value){

            if(isset($jsoncallback)){
                echo $jsoncallback."(".json_encode(['code'=>200,'data'=>$value]).")";
            }else{
                return json_encode(['code'=>200,'data'=>$value]);
            }
//            dd(22);
        }else{
            $data=ShopGoods::orderBy('g_id','desc')->limit(4)->get()->toArray();
            Cache::put($biao, $data,'86400');
            if($data){
                if(isset($jsoncallback)){
                    echo $jsoncallback."(".json_encode(['code'=>200,'data'=>$data]).")";
                }else{
                    return json_encode(['code'=>200,'data'=>$data]);
                }
            }
        }

//        return 12;

//       dd($data);
    }
    public function xxoo(){

//        Cache::put('key', '12123','30000');
        $value = Cache::get('key');
        dd($value);

    }
    //商品分类
    public function shop_category(){

        $biao = 'shop_category';

///     Cache 缓存
        $value = Cache::get($biao);
//        dd($value);
        //jsonp传输$_GET['callback']
        if(!empty($_GET['callback'])){
            $jsoncallback=$_GET['callback'];
        }
//        dd($callback);
        if( $value){

            if(isset($jsoncallback)){
                echo $jsoncallback."(".json_encode(['code'=>200,'data'=>$value]).")";
            }else{
                return json_encode(['code'=>200,'data'=>$value]);
            }
//            dd(22);
        }else{
            $data=ShopCategory::where('ctype','=','0')->get()->toarray();
            Cache::put($biao, $data,'86400');
            if($data){
                if(isset($jsoncallback)){
                    echo $jsoncallback."(".json_encode(['code'=>200,'data'=>$data]).")";
                }else{
                    return json_encode(['code'=>200,'data'=>$data]);
                }
            }
        }
    }
    //商品详情
    public function shop_goods_list(){
        $id= $_GET['id'];
        if(!empty($_GET['callback'])){
            $jsoncallback=$_GET['callback'];
        }
        $value=ShopGoods::where('g_id',$id)->first()->toArray();
        $info=ShopGoodsattr::where('shop_goodsattr.g_id',$id)->leftJoin('shop_attribute', 'shop_goodsattr.a_id', '=', 'shop_attribute.aid')
            ->get()->toArray();
        $xxoo=[];
        $ooxx=[];
        //获取商品属性
        foreach ($info as $k=>$v){
            if($v['atype']==2){
                $xxoo[$v['aid']][]=$v;
            }else{
                $ooxx[]=$v;
            }
//            dump($v);
        }

//        dd($ooxx);
        if(isset($jsoncallback)){
            echo $jsoncallback."(".json_encode(['code'=>200,'data'=>$value,'xxoo'=>$xxoo,'ooxx'=>$ooxx]).")";
        }else{
            return json_encode(['code'=>200,'data'=>$value,'xxoo'=>$xxoo,'ooxx'=>$ooxx]);
        }
    }



}
