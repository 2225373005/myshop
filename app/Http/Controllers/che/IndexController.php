<?php

namespace App\Http\Controllers\che;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function index(){
    	return view('che/index');
    }
    //添加车次
    public function add(Request $request){
        $data = $request->all();
        // unset($data['_token']);

        $info = DB::table('che')->insert([
               'c_che'=>$data['c_che'],
               'c_chu'=>$data['c_chu'],
               'c_dao'=>$data['c_dao'],
               'c_chutime'=>strtotime($data['c_chutime']),
               'c_daotime'=>strtotime($data['c_daotime']),
               'c_price'=>$data['c_price'],
               'c_num'=>$data['c_num'],
               
        	]);
        if($info){
        	return redirect('che/piao');
        }
    }
    //添加车票
    public function piao(){
        $info=DB::table('che')->select('c_id','c_che')->get();
        // dd($info);   
     
    	return view('che/piao',['info'=>$info]);
    }
    //添加座
    public function save(Request $request){
       $info  =  $request->all();
       unset($info['_token']);
       // dd($info);
       $data=DB::table('zuo')->insert($info);
       if($data){
       	return redirect('che/zhan');
       }
    }

    //展示
    public function zhan(Request $request){
       $c_chu = $request->c_chu??"";
       $c_dao = $request->c_dao??""; 
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
       $num = $redis->incr("$c_chu-$c_dao");
       if($redis->get("$c_chu-$c_dao-")){
       	// echo "$c_chu-$c_dao-";
         $info = $redis->get("$c_chu-$c_dao-");
         $info = json_decode($info);
         echo $num;
         // echo $info;
         // echo 22;
         // dd($info);

       }else{
           echo 33;
	      
	       echo $num;
	        
	       $where = [
	          ['c_chu','like',"%$c_chu%"],
	          ['c_dao','like',"%$c_dao%"],
	       ];
	       $info = DB::table('che')->where($where)->get();

	       $data = json_encode($info);
	       // dd($data);
	        if($num>5){
	            $redis->set("$c_chu-$c_dao-",$data);
	            // $aa = $redis->get("$c_chu-$c_dao-");
	            // dd($aa);
	        }
	          
	       
       }
       

 
       

       // dd($info);
       // $info = DB::table('che')
       //      ->leftJoin('zuo', 'che.c_id', '=', 'zuo.c_id')
       //      ->get();
       // dd($info);
       return view('che/zhan',['info'=>$info,'c_chu'=>$c_chu,'c_dao'=>$c_dao]);

    }
}
