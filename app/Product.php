<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'availability', 'quantities',
        'sold_times', 'price', 'discount', 'rating', 'weight',
        'color', 'notes', 'subcat_id', 'brand_id'
    ];

    static function Residual($id)
    {
        $product = Product::find($id);
        return $product->quantities - $product->sold_times;
    }

    public function subcat()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
