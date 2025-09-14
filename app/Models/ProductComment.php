<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'parent_id',
        'content',
    ];

    // Customer relation
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Replies relation (recursive)
    public function replies()
    {
        return $this->hasMany(ProductComment::class, 'parent_id')->with('replies');
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(ProductComment::class, 'parent_id');
    }

    // Product relation (optional, useful)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
