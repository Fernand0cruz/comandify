<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'category_id', 'is_available'];

    public function orderSlips()
    {
        return $this->belongsToMany(OrderSlip::class, 'order_product', 'product_id', 'order_slip_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

