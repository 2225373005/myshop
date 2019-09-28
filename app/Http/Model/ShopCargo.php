<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ShopCargo extends Model
{
    protected $table = 'shop_cargo';
    protected $primaryKey  = 'car_id';
    public $timestamps = false;
}
