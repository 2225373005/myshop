<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    protected $table = 'shop_category';
    protected $primaryKey  = 'cid';
    public $timestamps = false;
}
