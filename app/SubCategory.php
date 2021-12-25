<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    
    protected $table = 'sub_categories';

    protected $fillable = [
        'name','piority','image','color','description','cat_id'
    ];

    static function nextPiority()
    {
        return SubCategory::max('piority')+1;
    }

    public function cat()
    {
        return $this->belongsTo('App\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

}
