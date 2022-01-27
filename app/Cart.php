<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'carts';
    
    protected $fillable = [
        'total_price','status','user_id'
    ];

}
