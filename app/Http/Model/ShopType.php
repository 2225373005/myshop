<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    protected $table = 'shop_type';
    protected $primaryKey  = 'tid';
    public $timestamps = false;
}
