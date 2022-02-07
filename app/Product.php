<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'availability', 'quantities',
        'sold_times', 'price', 'discount', 'rating', 'weight',
        'color', 'notes', 'subcat_id', 'brand_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * 
     */
    public function av()
    {
        return $this->wiht('images')->where('availability',0)->get();
    }

    /**
     * product main Image
     * @param Product $id
     * @return image
     */
    static function mainImage($id)
    {
        $img = Product::find($id)->images()->where('type','main')->first()->image;
        return Storage::disk('google')->url($img);
    }

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

    public function images()
    {
        return $this->hasMany('App\ProductImage','pro_id');
    }

    public function carts()
    {
        return $this->belongsToMany('App\cart','cart_products','pro_id','cart_id')->withPivot('quantity');
    }
}
