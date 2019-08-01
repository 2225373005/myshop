<?php

namespace App\Http\Controllers\wx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function index(Request $request){
    	$data = $request->all();
    	// dd($data);
    	if(empty($data['access_token']) || $data['access_token']!=1234 ){
    		dd('access_token错误');
    	}
    	$info = DB::table('deng')->get();
    	return json_encode($info);
    }
}
