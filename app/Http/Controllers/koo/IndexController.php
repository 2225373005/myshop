<?php

namespace App\Http\Controllers\koo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function log(){
    	return view('koo/log');
    }
    public function log_do(Request $request){
        $name = $request->name;
        $pwd = $request->pwd;
        $info = DB::table('deng')->where('name',$name)->where('pwd',$pwd)->first();
        if($info){
        	$request->session()->put('name',$info);
        	return redirect('koo/index');
        }
        // dd($info);

    }
    public function index(Request $request){
        $users = DB::table('news')->paginate(1);
        // dd($user);
        $id = $request->session()->get('name');
        $id=$id->id;
    	return view('koo/index',['users'=>$users,'id'=>$id]);
    }
    public function add(){
    	return view('koo/add');
    }
    public function add_do(Request $request){
    	$path = $request->file('x_file')->store('koo');
    	$name=$request->session()->get('name');
    	// dd($path);
        $data = $request->all();
        $info = DB::table('news')->insert([
   				'x_title'=>$data['x_title'],
   				'x_file'=>$path,
   				'x_name'=>$data['x_name'],
   				'add_time'=>time(),
   				'x_content'=>$data['x_content'],
   				'id'=>$name->id,
        	]);
       if($info){
       	   return redirect('koo/index');
       }
    }

    public function list(Request $request){
    	$id = $request->id;
        $redis = new \Redis;
        $redis->connect('127.0.0.1','6379');
        $data = $redis->get($id);
        $num = $redis->incr('num'.$id);
        // dd($num);
        if($data){
        	// dd(111);
        	echo "我是redis";
           $info = json_decode($data);

        }else{
          echo "我是数据库";
    	  $info = DB::table('news')->where('x_id',$id)->first();
    	  $data = json_encode($info);
    	  $redis->set($id,$data);

        }

    	// dd($info);
    	return view('koo/list',['info'=>$info,'num'=>$num]);
    }
     public function delete(Request $request){
         $id = $request->id;
         // dd($id);
         $info= DB::table('news')->where('x_id',$id)->delete();
         // dd($info);
         if($info){
            return redirect('koo/index');
         }
     }
}
