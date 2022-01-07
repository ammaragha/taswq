<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'image', 'type', 'piority', 'pro_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
