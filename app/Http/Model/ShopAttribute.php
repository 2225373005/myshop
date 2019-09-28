<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopAttribute extends Model
{
    protected $table = 'shop_attribute';
    protected $primaryKey  = 'aid';
    public $timestamps = false;
}
