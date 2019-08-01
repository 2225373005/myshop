<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Model\Deng;
class StudentController extends Controller
{
    public function login(){
       return view('login');
    }
    public function login_do(Request $request){
     $data = $request->all();
     // dump($data);
     $where=[
        ['name','=',$data['name']],
        ['pwd','=',$data['pwd']]
     ];
     // dump($where);die;
     $flights =   Deng::where($where)->first();

    // dump($flights);die;
    if($flights){
     $request->session()->put('username',$data['name']);
    return redirect('user/index');
    }else{
    return redirect('user/login');

    }


    }
    public function index(Request $request){
       $redis = new \Redis();
       $redis->connect('127.0.0.1','6379');
       $num = $redis->incr('num');
       $num = $redis->get('num');
       echo $num;

      //搜索
       $aaa = "";
       $name = $request->all();
        
       if(!empty($name['name'])){
        $aaa=$name['name'];
        $info = DB::table('user')->where('name','like','%'.$aaa.'%')->paginate(2);
       }else{
        $info = DB::table('user')->paginate(2);
       }
       
  

    	// echo 132;
    	
    	// dd($info); 
    	return view('index',['user'=>$info,'aaa'=>$aaa]);
    }
    public function delete(){
    	$id = $_GET['id'];
    	
    	$mode = DB::table('user')->delete($id);
    	if($mode){
    	// $this->index();
           return redirect('user/index');
    	}

    }
    public function add(){
        return view('add');
      
    }    
    //修改
    public function save(Request $request){
     $data =$request->all();
     $info = DB::table('user')->where(['id'=>$data['id']])->update([
          'id'=>$data['id'],
          'name'=>$data['name'],
          'age'=>$data['age'],
      ]);
     if($info){
           return redirect('user/index');

     }
      
    } 
    public function update(Request $request){
       $data =$request->all();

       $model  = DB::table('user')->where(['id'=>$data['id']])->first();

       return view('update',['model'=>$model]); 
        
    } 
   public function add_do(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'age' => 'required',
    ],[  'name.required' => '用户不能为空',
        'age.required' => '年龄不能为空',]);
       $data = $request->input();
       // dd($data);
       $mode =DB::table('user')->insert([
          'name'=>$data['name'],
          'age'=>$data['age'],
        ]);
       if($mode){
           return redirect('user/index');
       }else{
           echo "fail";
       }
    } 
}
