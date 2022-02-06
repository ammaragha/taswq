<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'start','arrival','status','discount','total_price','address_id','cart_id'
    ];


    public function cart()
    {
        return $this->belongsTo('App\Cart','cart_id');
    }
}
