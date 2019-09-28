<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
//购物车表
class ShopCart extends Model
{
    protected $table = 'shop_cart';
    protected $primaryKey  = 'c_id';
    public $timestamps = false;
}
