<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopGoods extends Model
{
    protected $table = 'shop_goods';
    protected $primaryKey  = 'g_id';
    public $timestamps = false;
}
