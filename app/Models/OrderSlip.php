<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSlip extends Model
{
    protected $fillable = ['order_number', 'customer_name', 'table_number', 'notes', 'status', 'total_price'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_slip_id', 'product_id')
            ->withTimestamps();
    }
}
