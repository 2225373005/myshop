<?php

namespace App\Http\Controllers\cai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function  index(){
        $info = DB::table('qiu')->get();

        // $data =DB::table('cai')->select('w_cai')->get();
        // // dd($data);
        // $data = json_encode($data);
        // $data = json_decode($data,1);
        // dd($data);
        // dd($info);
        // $info = DB::table('qiu')
        //     ->leftJoin('cai', 'qiu.q_id', '=', 'cai.q_id')
        //     ->get();

       // dd($info);
    	return view('cai/index',['info'=>$info]);
    }
    public function add(){
    	return view('cai/add');
    }
    public function add_do(Request $request){

    $validatedData = $request->validate([
        'q_name' => 'required',
        'q_name1' => 'required',
        'odd_time' => 'required',
    ],[
     'q_name.required'=>'不能为空',
     'q_name1.required'=>'不能为空1',
     'odd_time.required'=>'时间不能为空',
    ]);

        $data = $request->all();
     
       	$data = DB::table('qiu')->insert([
               'q_name'=>$data['q_name'],
               'q_name1'=>$data['q_name1'],
               'odd_time'=>strtotime($data['odd_time']),
       		]);
        // dd($data);
        if($data){
        	return redirect('cai/index');
        }
    }

    public function list(Request $request){
    	// $data="";
        $q_id =$request->id;
        $info =DB::table('qiu')->where('q_id',$q_id)->first();
        
        $data = DB::table('cai')
            ->leftJoin('qiu', 'cai.q_id', '=', 'qiu.q_id')->where('cai.q_id','=',$q_id)
            ->first();

        // DB::table('cai')
        // ->leftJoin('qiu', function ($join) {
        //     $join->on('cai.q_id', '=', 'qiu.q_id')
        //          ->where('qiu.user_id', '>', 5);
        // })
        // ->get();
   //      dump($data);
   // dd($data);
        // $data =DB::table('cai')->where('q_id',$q_id)->first();
        if(!$data){
        	$data['w_cai']=0;
        	$data=json_encode($data);
        	$data=json_decode($data); 
        }
  // dd($data);
     // dd($data['w_cai']);	
        return view('cai/list',['info'=>$info,'data'=>$data]);
    }

    public function list_do(Request $request){
    	$q_id =$request->id;

        $info =DB::table('qiu')->where('q_id',$q_id)->first();

        $data=DB::table('cai')->where('q_id',$info->q_id)->first();
        // dd($data);
        // $a=[];
        if(!$data){
          $a=0;
        }else{
           $a=1; 
        }
        
        // dd($info);
        return view('cai/list_do',['info'=>$info,'a'=>$a]);
    }

    public function do_cai(Request $request){
    	// dd(123);
    	$info = $request->all();

    	$data = DB::table('cai')->insert([
               'q_id'=>$info['q_id'],
               'w_cai'=>$info['w_cai'],
    		]);
    	if($data){
    		return redirect('cai/index'); 
    	}
    }


}
