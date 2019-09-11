<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Deng;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //获取
    public function index(Request $request)
    {
        $name =$request->name;
        if(!empty($name)){

            $data = Deng::where('name','like',"%$name%")->orwhere('pwd','like',"%$name%")->paginate(2)->toArray();
//            dd($data);
        }else{
            $data = Deng::paginate(2)->toArray();
        }



        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }else{
            return json_encode(['code'=>202,'msg'=>'查询失败','data'=>$data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加
    public function store(Request $request)
    {
        $name = $request->name;
        $pwd = $request->pwd;

        if(empty($name) || empty($pwd)){
            return json_encode(['code'=>201,'msg'=>'参数错误']);
        }
        $data=Deng::insert(['name'=>$name,'pwd'=>$pwd]);
//        dd($data);
        if($data){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'添加失败']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除
    public function destroy($id)
    {
//        $id=$request->id;
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
}
