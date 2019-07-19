<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function login(Request $request){
    	// echo 2131;
         return view('index/login');
    }

    public function login_do(Request $request){
    	$data = $request->all();
    	$where=[
             ['name','=',$data['name1']],
             ['password','=',$data['password']],
    	];
    	$model = DB::table('user')->where($where)->first();
   	 // dd($model);

//    	$model1 = DB::table('user')->where([['id','=',$model]])->first();
//        dump($model1);
        // $info=[
        //     'id'=>
        //     'name'=>$data['name']
        // ];
    	 if($model){
    	 	$request->session()->put('name',$model);
    	 	return redirect('index/index');
    	 }
    }
    public function index(){
        $where= [
            ['goods_up','=','1'],
            ['goods_new','=','1']
        ];
        $info= DB::table('goods')->where($where)->get();
        $info1= DB::table('goods')->limit(6)->get();
       

        return view('index/index',['info'=>$info,'info1'=>$info1]);
    }
    public  function details(Request $request){
         $data = $request ->goods_id;
         // dd($data);
        $info = DB::table('goods')->where('goods_id',$data)->first();
        // dd($info);
        return view('index/details',['info'=>$info]);
    }


    public function register(Request $request){
    	// echo 2131;
         return view('index/register');
    }
    public function register_do(Request $request){
    	// echo 2131;
    	$data=$request->all();
        $model =DB::table('user')->insert(['name'=>$data['name1'],'password'=>$data['password'],'email'=>$data['email'],'reg_time'=>time()]);
       
        if($model){
        	return redirect('index/login');
        }
    }

    public function add_goods(){

    	return view('index/add_goods');
    }
    public function add_goods_do(Request $request){
       $path = $request->file('goods_pic')->store('goods');
       echo asset('storage').'/'.$path;
    }
    public function cart(Request $request){
      $value = $request->session()->get('name');
     
        if(!$value){
        return redirect('index/login');die;
     }

     $goods_id = $request->goods_id;
     // dd($goods_id);
     $id= $value->id;
     // dd($id);
     $info = DB::table('goods')->where('goods_id',$goods_id)->first();
     // dd($info->goods_id);
     $where = [
       'uid'=>$id,
       'goods_id'=>$info->goods_id,
       'goods_name'=>$info->goods_name,
       'goods_pic'=>$info->goods_pic,
       'goods_price'=>$info->goods_price,
       'add_time'=>time(),

     ];
     $data = DB::table('cart')->insert($where);
     if($data){
        return redirect('index/cart_do');
     }
    }
    //确认订单
    public function  xxoo(Request $request){
        $where =[];
        $goods_id = $request->goods_id;
        // dd($goods_id);
        $where = explode (',',$goods_id);
        $request->session()->put('goods_id',$where);
        $data = DB::table('cart')->whereIn('goods_id',$where)->get();
        $zongjia = "0";
        foreach ($data as $key => $v) {
              // dump($v->goods_price);
              $zongjia += $v->goods_price;
        }
        // dd($zongjia);
        return view('index/xxoo',['data'=>$data,'zongjia'=>$zongjia]);
        // dd($total_amount);
    } 

    public function cart_do(Request $request){
        $value = $request->session()->get('name');
        // dd($value);
        $id=$value->id;
        // dd($id);
        $where = [
           ['uid','=',$id]
        ];
        $info = DB::table('cart')->where($where)->get();
        // dd($info);
        // $goods_id = [];
        $goods_id="";
        foreach ($info as $v) {
            $goods_id.=$v->goods_id.',';
            // dump($v->id);
        }
        $goods_id=trim($goods_id,',')??'';
        // $goods_id = array_unique($goods_id);
       // dd($goods_id);
        return view('index/cart_do',['info'=>$info,'goods_id'=>$goods_id]);
    }

    public function dingdan(Request $request){
         $data = DB::table('order')->get();
         // dd($data);
         return view('index/dingdan',['data'=>$data]);
    }
}
