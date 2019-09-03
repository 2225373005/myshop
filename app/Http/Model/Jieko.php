<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Jieko extends Model
{
    protected $table = 'openid';
    protected $primaryKey='id';
    public $timestamps = false;

    public static function  jiekou(){
//        $flights = DB::table('openid')->get();
        $flights=Jieko::get();
//        dd($flights);
        return $flights;
    }
}
