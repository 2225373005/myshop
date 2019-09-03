<?php

namespace App\Http\Controllers\aaa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Index extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public  function log(){
//        dd(111);
        return view('aaa/log');
    }
    public  function log_do(){
        $data=$this->request->all();
        $info=DB::table('deng')->where('name',$data['name'])->where('pwd',$data['pwd'])->first();
        if($info){
            $this->request->session()->put('name',$data['name']);
            return redirect('aaa/list');
        }else{
            return redirect('aaa/log');
        }
    }

    public function list(){
        $name=$this->request->name;
        $where=[
                 ['subscribe','=',1],
            ];

        if(!empty($name)){
             $where[]=

                 ['nickname','=',$name]
             ;
//             dd($where);
        }

        $data = DB::table('openid')->where($where)->paginate(2);

//        dd($data);
        return view('aaa/list',['data'=>$data,'name'=>$name]);
    }

    public function sign(){
        return view('aaa/sign');
    }
    public function sign_do(){
        $date=date('Y-m-d');
        $date=strtotime($date);
//        echo time();
//        dd($date);
        $data=DB::table('qdjl')->where('uid',1)->orderBy('id','desc')->first();
        if($data->sign_time){

        }else{

        }
//        dd($data);

        $data=DB::table('lxqd')->where('name','老表')->first();
        if($data->sign_day<5 ){
            $data->sign_day+=1;
            $data->fen+=$data->sign_day*5;
            dd($data);
        }else{
            $data->sign_day=1;
            $data->fen+=$data->sign_day*5;
        }
//        dd($day);


        $data=DB::table('qdjl')->insert([
            'sign_time'=>time(),
            'uid'=>1,
        ]);
        if($data){


        }

        return view('aaa/sign_do');
    }


}
