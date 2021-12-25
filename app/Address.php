<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'city','street','lng','lat','notes','usability','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
