<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_products';

    protected $fillable  = [
        'pro_id','cart_id','quantity','total_price'
    ];
}
