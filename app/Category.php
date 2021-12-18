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
        'name','piority','image','color'
    ];

    static function nextPiority()
    {
        return Category::max('piority')+1;
    }
}
