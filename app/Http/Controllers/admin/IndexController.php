<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Goods;
use DB;
class IndexController extends Controller
{
    public function index(){
        return view('admin/index');
    }
    public function add(Request $request){
        $path = $request->file('goods_pic')->store('admin');

        $data = $request->all();

        $flight = new Goods;
        $flight->goods_name=$data['goods_name'];
        $flight->goods_price=$data['goods_price'];
        $flight->goods_up=$data['goods_up'];
        $flight->goods_num=$data['goods_num'];
        $flight->goods_content=$data['goods_content'];
        $flight->goods_pic=$path;
        $flight->add_time=time();

        $model=$flight->save();

        if($model){
            return redirect('admin/list_goods');
        }

        dd($model);
        dd($data);
    }
    public function add_goods(){
        return view('admin/add_goods');
    }
    public function list_goods(Request $require){


        
        //访问量
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $num = $redis->incr('good_num');
        // echo $num;
        $goods_name = $require->goods_name??'';
        // dd($goods_name);
        $where= [
            ['goods_name','like',"%$goods_name%"]
        ];
        $model = DB::table('goods')->where($where)->paginate(2);
        // dd($model);
        return view('admin/list_goods',['model'=>$model,'goods_name'=>$goods_name,'num'=>$num]);
    }
    public function update(Request $request){
        $goods_id = $request->goods_id;
        $where=[
           ['goods_id','=',$goods_id],
        ];
        $data = DB::table('goods')->where($where)->first();
        return view('admin/update_list',['data'=>$data]);
        
    }

    public function goods_update(Request $request){
        $data = $request->all();
        unset($data['_token']);
        
        $path = $request->file('goods_pic');
        if($path){
           $path=$path->store('admin');
           $data['goods_pic']=$path;
           
           
        }else{
            unset($data['goods_pic']);
           
        }
        $where = [
            ['goods_id','=',$data['goods_id']]
        ];
        $info = DB::table('goods')->where($where)->update($data);
        // dd($path);
        // dd($data);
        // dd($info);
        if($info){
           return redirect('admin/list_goods');
        }
    }

    public function user(){
        $info = DB::table('deng')->get();
        // dd($info);
        return view('admin/user',['info'=>$info]);
    }
    public function shouquan(Request $request){
        $id = $request->all();
        $where=[
            ['id','=',$id],
        ];
        $info = DB::table('deng')->where($where)->update(['root'=>'1']);
        if($info){
            echo json_encode(['code'=>'1','msg'=>1]);
        }else{
            echo json_encode(['code'=>'2','msg'=>2]);

        }
    }
}
