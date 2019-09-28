<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\Aes;
class ZiController extends Controller
{
   public function index(Request $request)
   {
//      echo phpinfo();
//       dd();
        $data='bf5a01f6fd15433fa3f9022f37207cccd044f145c18c94471c7edb7f7bc4a66405529edf845ea39a39ed8572ff18db24';

//        $data = $request->authstr;
        $info = new Aes('qwertyuiop');

        $data=$info->decrypt($data);
       $data=json_decode($data,1);
       $data = explode('&',$data);
       foreach ($data as $v){
           $bbb=explode('=',$v);
           $ccc[$bbb[0]]=$bbb[1];
       }
       if(empty($ccc['name']) || empty($ccc['age']) || empty($ccc['mobile'])){
           return ['code'=>203,'msg'=>'兄弟参数错误'];
       }

        dd($ccc);





   }
}
