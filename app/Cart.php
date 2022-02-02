<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'carts';

    protected $fillable = [
        'total_price', 'status', 'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'cart_products', 'cart_id', 'pro_id')
            ->withPivot('quantity', 'total_price')
            ->as('item');
    }
}
