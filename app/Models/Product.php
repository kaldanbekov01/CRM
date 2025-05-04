<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'barcode',
        'category_id',
        'supplier_id',
        'stock_quantity',
        'wholesale_price',
        'retail_price',
        'description'
    ];

    // Product belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to one Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Product may appear in many Orders
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
