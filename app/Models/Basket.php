<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'quantity',
        'product_id',
        'order_id',
    ];

    // A basket belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // A basket belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
