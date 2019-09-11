<?php

namespace App\Http\Controllers\jie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Jieko;
use App\Http\Model\Deng;

class JieController extends Controller
{
    public function jie(){
      $data=Jieko::jiekou()->toArray();
      $data=json_encode($data,1);
      dd($data);
//      echo $data;
    }
    //接口添加
    public function jie_add(Request $request){
        $name = $request->name;
        $pwd = $request->pwd;
        if(empty($name) || empty($pwd)){
            return json_encode(['code'=>201,'msg'=>'参数错误']);
        }
       $data=Deng::insert(['name'=>$name,'pwd'=>$pwd]);
        if($data){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'添加失败']);

        }
//       dd($data);
    }
    //查询展示
    public function  jie_list(){
        $data = Deng::get()->toArray();
//        dd($data);
        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }else{
            return json_encode(['code'=>202,'msg'=>'查询失败']);
        }

    }
    public function jie_delete(Request $request){
      $id=$request->id;
      if(empty($id)){
          return json_encode(['code'=>204,'msg'=>'无删除id']);
      }
         $data =Deng::where('id',$id)->delete($id);
      if($data){
          return json_encode(['code'=>200,'msg'=>'删除成功']);
      }else{
          return json_encode(['code'=>205,'msg'=>'删除失败']);
      }

    }

    public  function  jie_update(Request $request){
        $id=$request->id;
        if(empty($id)){
            return json_encode(['code'=>205,'msg'=>'id参数错误']);
        }
        $data=Deng::where('id',$id)->first();
        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }else{
            return json_encode(['code'=>206,'msg'=>'查询失败']);
        }

    }
    public  function  jie_update_do(Request $request){
        $id=$request->id;
        $name=$request->name;
        $pwd=$request->pwd;
//        dd($pwd);
        if(empty($id) || empty($name) || empty($pwd)){
            return json_encode(['code'=>205,'msg'=>'所传参数错误']);
        }
        $data=Deng::where('id',$id)->update([
            'id'=>$id,
            'name'=>$name,
            'pwd'=>$pwd,
        ]);

        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }else{
            return json_encode(['code'=>206,'msg'=>'查询失败']);
        }

    }



}
