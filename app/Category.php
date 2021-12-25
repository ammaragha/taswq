<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';


    /**
     * attr that mass assignble
     * @var array
     */
    protected $fillable = [
        'name','piority','image','color','description'
    ];

    static function nextPiority()
    {
        return Category::max('piority')+1;
    }

    

    public function subs()
    {
        return $this->hasMany('App\SubCategory','cat_id');
    }
}
