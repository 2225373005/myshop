<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Zhou;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        dd(222);
        $sou = $request->sou;
        $where=[];
        if(isset($sou)){
            $where=[
                ['names','like',"%$sou%"]
            ];
        }
//        dd($where);

//        $redis=new \Redis();
//        $redis->connect('127.0.0.1','6379');

         $data =Zhou::where($where)->paginate(2)->toArray();
//        dd($data);
//        if(isset($sou)) {
            foreach ($data['data'] as $k => $v) {
                $v['names'] = str_replace($sou, '<b style="color: red;">'.$sou.'</b>', $v['names']);
            $data['data'][$k]['names']=$v['names'];
//            echo $v['names'];
            }
//
//        }else{
//
//            $data= $redis->get('page'.$data['current_page']);
//            if(isset($data)){
//
//            }else{
//                $data= $redis->set('page'.$data['current_page'],$data);
//            }
//
//        }
//        dd($data);





//        $data= $redis->get('oooo');
//        dd($data);


//        dd();
//        dd($data);
        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }
//         dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info=$request->all();
        $data=date('Y-m-j');
        $path = $request->file('file')->store('zhou/'.$data);
        $info['file']=$path;

        $info=Zhou::insert($info);

        if($info){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }




//       $data = $request->all();dd($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Zhou::where('id',$id)->first()->toArray();
        if($data){
            return json_encode(['code'=>200,'data'=>$data]);
        }

//        dd($data);
//        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
         $data = $request->all();
//         dd($data['file']);
       if($request->hasFile('file')){
//           dd(11);
           $date=date('Y-m-j');

           $path = $request->file('file')->store('zhou/'.$date);
           $data['file']=$path;
//           dd($data);
       }else{
           unset($data['file']);
       }
       unset($data['_method']);
//       dd($data);
       $data = Zhou::where('id',$id)->update($data);
       if($data){
           return json_encode(['code'=>200]);
       }
//       dd($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//       $info = $request->img;
//       dd($info);
//        dd($id);
        $info =  Zhou::where('id',$id)->select('file')->first()->toArray();
//        dd('/storage/'.$info['file']);
        unlink('./storage/'.$info['file']);
        $data =  Zhou::where('id',$id)->delete();


//        dd();
        if($data){
            return json_encode(['code'=>200]);
        }
    }
}
