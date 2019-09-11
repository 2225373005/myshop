<?php

namespace App\Http\Controllers\abb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tool\Aes;
use App\Http\Controllers\tool\Rsa;

class Index extends Controller
{
    public function index(){
       $url='http://wym.yingge.fun/api/test/addUser?authstr=';
       $aes= new Aes('fdjfdsfjakfjadii');

       $data='name=老表&age=22&mobile=2222';
        $info=$aes->encrypt($data);
//        dd($info);
       $info=file_get_contents($url.$info);
       dd($info);

    }

    public function zidong(){
      $data ='name=老表&age=22&mobile=2222';
      $info = new Aes('qwertyuiop');
      $data = json_encode($data);
//      $data=json_decode($data,1);
//      dd($data);
      $data =$info->encrypt($data);
      dd($data);
    }
}
