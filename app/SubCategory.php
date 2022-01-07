<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    
    protected $table = 'sub_categories';

    protected $fillable = [
        'name','piority','image','color','description','cat_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    static function nextPiority($id)
    {
        return SubCategory::where('cat_id',$id)->max('piority')+1;
    }

    public function cat()
    {
        return $this->belongsTo('App\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Product','subcat_id');
    }

}
