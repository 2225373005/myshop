<?php

namespace App\Http\Controllers\kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;	
class IndexController extends Controller
{
	 public  $ppp;
    public function logs(){
    	return view('kao/logs');
    }
    public function logs_do(Request $request){
         $name = $request->name;
         $pwd  = $request->pwd;
         $where =[
             ['name','=',$name],
             ['pwd','=',$pwd],
         ];
         $info = DB::table('deng')->where($where)->first();
         // dd($info);
         if($info){
         	$request->session()->put('name',$info);
         	return redirect('kao/add');
         }
    }

    public function add(Request $request){
    	// $request->session()->forget('name');
    	 $value = $request->session()->get('name');
    	 // dd($value);
    	return view('kao/add');
    }
    public function add_do(Request $request){
    	$d_id=$request->d_id;
    	$info =$request->all();
    	unset($info['_token']);
        if($d_id==1){
             $info = DB::table('cradion')->insert($info);
        }elseif($d_id==2){
        	// dd($info['b_answ']);
        	$info['b_answ']=implode(',',$info['b_answ']);
        	// dd($info);
             $info = DB::table('ccheckbox')->insert($info);
        }else{
             $info = DB::table('capan')->insert($info);
            // dd($info);
        }
        if($info){
        	return redirect('kao/index');
        }
    }













  

    //周考2
    public function aaa(){
    	return view('kao/aaa');
    }

    public function aaa_do(Request $request){
        $name = $request->name;
        $pwd = $request->pwd;
        $where =[
            ['name','=',$name],
            ['pwd','=',$pwd],
        ];

        $data = DB::table('deng')->where($where)->first();
        // dd($data);
        if($data){
        	return redirect('kao/bbb');
        }


    }
    public function bbb(){
    	return view('kao/bbb');
    }
    public function bbb_do(Request $request){
        $title = $request->title;
        $info = DB::table('question_test')->insertGetId(['title'=>$title,'add_time'=>time()]);
        // dd($info);
        if($info){
        	
        	// $this->ccc($info);
        	
        	return redirect('kao/ccc');
        }
    }

    public function ccc(){
     
      return view('kao/ccc');
    }

    public function ccc_do(Request $request){
    	$d_id = $request->d_id;
        $info = $request->all();
        // dd($info);
        unset($info['_token']);
        // DB::beginTransaction();
        DB::connection('mysql')->beginTransaction();
        $data = true;
        if($d_id==1){
          $data = DB::table('question_problem')->insertGetId([
              'type_id'=>$d_id,
              'problem'=>$info['c_info'],
              'add_time'=>time(),
        	]);
          $data1 = DB::table('question_answer')->insert([
          	]);
        
        $data = 
        }elseif($d_id==2){

        }else{

        }

        
        
    }
}
