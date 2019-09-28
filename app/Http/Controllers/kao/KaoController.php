<?php

namespace App\Http\Controllers\kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\You;
use DB;
use Illuminate\Support\Facades\Cache;
class KaoController extends Controller
{
    public function index(){
        $url='http://api.avatardata.cn/ActNews/Query?key=89e95999b676443e95c11436728ddd00&keyword=奥巴马';
        $data=file_get_contents($url);
        $data=json_decode($data,1);
//        dd($data);
        if($data['error_code']=='0'){

            foreach ($data['result'] as $v){

                $xxoo=DB::table('xinwei')->where('title',$v['title'])->first();
//                dd($xxoo);
                if(!$xxoo){
                    $info=DB::table('xinwei')->insert([
                        'title'=>$v['title'],
                        'content'=>$v['content'],
                        'full_title'=>$v['full_title'],
                        'pdate'=>$v['pdate'],
                        'src'=>$v['src'],
                        'pdate_src'=>$v['pdate_src'],
                    ]);
                }

            }
//            dd(1);
        }

    }

//    数据存redis
 public function  list(Request $request ){
//     Cache::put('name',11);
//     dd(Cache::get('name'));


        $page=$request->page??1;
//        dd($page);
        if(isset($page)){
            //访问权限
//            dd();
            $id=json_encode($_SERVER['SERVER_ADDR']);
//            Cache::forget($id);
            $data=Cache::get($id);
//            dd($data);

//            dd($num);
//            dd($data);
//            $num=$data??0;
            if(!$data){
                $num=1;
//                Cache::forget($id);
            }else{
//                dd(22);
                $num=$data+1;
            }
//            dump($num);
            Cache::put($id,$num,60);
//            dd($data);
            if($num>3){
                return ['code'=>'201','msg'=>'接口调用上线'];
            }



//            Cache::put($id,json_encode($data));



            $table='weixin'.$page;
           $redis = Cache::get($table);
           if($redis){
//                dump($page).$page;
                $data=Cache::get($table);
           }else{
//               dd($redis);
//               dump(111).$page;
            $data=DB::table('xinwei')->paginate(2)->toArray();
//            dd($data);
               $redis = Cache::put($table,json_encode($data));

           }
//           dump(json_decode($data,1));
           return json_encode(['code'=>200,'data'=>$data]);




        }




 }

}
