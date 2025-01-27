<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderSlip extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['order_number', 'customer_name', 'table_number', 'notes', 'total_price'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_slip_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
