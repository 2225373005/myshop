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
    	$model = DB::table('user')->where($where)->first('id');
    	// dd($model);
    	
    	$model1 = DB::table('user')->where([['id','=',$model]])->first();
        dump($model1);
        // $info=[
        //     'id'=>
        //     'name'=>$data['name']
        // ];
    	// if($model){
    	// 	$request->session()->put();
    	// }
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
}
