<?php

namespace App\http\model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey='goods_id';

//    const CREATED_AT = 'add_time';
    public $timestamps = false;
//    const UPDATED_AT = 'last_update';


    public function getGoodsUpAttribute($value)
    {
        return $value==1?'是':'否';
    }
    public function setGoodsUpAttribute($value)
    {
        $this->attributes['goods_up'] = strtolower($value)=='是'?1:0;
    }
}
