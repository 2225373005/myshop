<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopGoodsattr extends Model
{
    protected $table = 'shop_goodsattr';
    protected $primaryKey  = 'g_id';
    public $timestamps = false;
}
