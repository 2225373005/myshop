<?php

namespace App\Http\Controllers\jie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Jieko;

class JieController extends Controller
{
    public function jie(){
      $data=Jieko::jiekou()->toArray();
      $data=json_encode($data,1);
      dd($data);
//      echo $data;


    }
}
