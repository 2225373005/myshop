<?php

namespace App\Http\Controllers\ting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
	public function log(){
		return view('ting/log');
	}
	public function log_do(Request $request){
       $name = $request->name;
       $pwd = $request->pwd;
       $info = DB::table('deng')->where('name',$name)->where('pwd',$pwd)->first();
       // dd($info);
       if(!$info){
          return redirect('ting/log');die;
       }
      $request->session()->put('name',$info);
      return redirect('ting/index');

	}
    public function index(Request $request){

    	return view('ting/index');
    } 

    public function add(){
    	return view('ting/add');
    }
    public function add_do(Request $request){
    	$data =$request->all();
    	// dd($data);
    	$info = DB::table('tingche')->insert([
      			'name'=>$data['name'],
      			'num'=>$data['num'],
    		]);
    	if($info){
    		return redirect('ting/index');
    	}
    }
    //添加门卫
    public function men(){
      return view('ting/men');
    }
    public function men_do(Request $request){
       $name = $request->name;
   	   $pwd =$request->pwd;
   	   $info = DB::table('deng')->insert([
        	'name'=>$name,
        	'pwd'=>$pwd,
        	'root'=>2,
   	   	]);
   	   if($info){
   	   	  return redirect('ting/index');
   	   }

    }

    //门卫
    public function ppp(){
    	// dd(123);
    	$info =DB::table('tingche')->where('id',1)->select('num')->first();
    	$num=DB::table('aaaa')->where('status',1)->count();
    	$info =$info->num;
    	// dd($num);
    	$num = $info - $num;
    	// dd($num);
    	return view('ting/ppp',['info'=>$info,'num'=>$num]);
    }

    public function save(){
       return view('ting/save');
    }
    public function save_do(){
       return view('ting/save_do');

    }
    public function ru(Request $request){
        $info = $request->name;
        $info = DB::table('aaaa')->insert([
            'name'=>$info,
            'add_time'=>time(),
            'status'=>1
          ]);
        if($info){
          return redirect('ting/ppp');
        }
        // dd($info);

    }
    public function shou(Request $request){
        // $time = strtotime("18:00");

        // dd($time);  
        $name = $request->name;
        // dd($info);
        $info = DB::table('aaaa')->where('name',$name)->where('status',1)->first();

        // dd($info);
        if($info){
            $time = time();
            $ban = 1800;
            $yi = 3600;
            $xiao = 3600*6;
            // dd($info->add_time);
            $miao = $time-($info->add_time);
            // dd($miao);
            if($miao<$ban){
               $qian = 0;
               // echo "123";
            }elseif($miao<=$xiao){
              $num = ceil($miao/$ban);
              // echo $num;
              $qian = 2*$num;
              // dd($qian);
            }else{
               $qian =24;
               $aaa = $miao-$xiao;
               $num = ceil($aaa/$yi);
               $qian =  $qian+$num;
               // echo $qian;
             
            }
            


            $data = DB::table('aaaa')->where('id',$info->id)->update([
                      'id'=>$info->id,
                      'status'=>2,
                      'old_add'=>$time,
                      'qian'=>$qian,
              ]); 
            if($data){
                $shi =floor($miao/3600);
                $ppp = ($miao%3600);
                $fei = inval($ppp/60);
                // dd($miao);
                // echo $name;
                // echo $qian;
                // dd($miao);
                return view('ting/shou',['name'=>$name,'qian'=>$qian,'shi'=>$shi,'fei'=>$fei]);

            }           
 

        }else{
          echo '没有此车';
        }
    }

    public function tong(){
      $wan = strtotime("00:00");
      $two = strtotime('24:00');
      $a=0;
      $info = DB::table('aaaa')->where('add_time','>',$wan)->where('add_time','<',$two)->count();
      $qian = DB::table('aaaa')->where('old_add','>',$wan)->where('old_add','<',$two)->get();
      
      foreach ($qian as $v) {
         $a +=$v->qian;
      }
      // dd($a);



      return view('ting/tong',['info'=>$info,'qian'=>$a]);
    }

}
