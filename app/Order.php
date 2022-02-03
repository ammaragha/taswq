<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'start','arrival','status','discount','total_price','address_id','cart_id'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User','user_orders','order_id','user_id');
    }
}
