<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name','image','color'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
