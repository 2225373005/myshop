<?php

namespace App\Http\Controllers\deng;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
     public function log(){
     	return view('deng/log');
     }
     public function zhu(){
       return view('deng/zhu');
     }
     public function zhu_do(Request $request){
         $rand = rand(1000,9999);
         $time = time();
         $redis= new \Redis;
         $redis->connect('127.0.0.1','6379');
         $data =[
            'rand' => $rand,
            'time' => $time,
         ];
         $data = json_encode($data);
         $aa=$redis->set('xxoo',$data);
         // $bb =$redis->get('xxoo');
         // echo $bb;
         echo $rand;
     }
     public function zhu_doo(Request $request){
     	$info = $request->all();
     	
     	// $data = DB::table('deng')->where('name',$info['name'])->where('pwd',$info['pwd'])->first();
     	// if($data){
     		$redis = new \Redis;
     		$redis->connect('127.0.0.1','6379');
     		$aaa = $redis->get('xxoo');
     		$aaa = json_decode($aaa);
     		$time = time() - $aaa->time;
     		// dd($time);
     		if($time<=120 && $aaa->rand==$info['rand']){
     			
     				   $info = DB::table('deng')->insert([
 						'name'=>$info['name'],
 						'pwd'=>$info['pwd'],
   		         	]);
     				   if($info){
     				   	  return redirect('deng/log');
     				   }
     		
   		      
     		}else{
               echo "验证码错误";die;
     		}
     		// dd($aaa);
            	
     	// }else{

     	// 	echo "证号或密码错误";
     	// }
     	// dd($data);


     }
}
