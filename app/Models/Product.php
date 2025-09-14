<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'product_image',
    'product_category',
    'product_name',
    'product_price',
     ];

     public function category(){
        return $this->belongsTo(Category::class, 'product_category');
     }
}
