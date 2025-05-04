<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company_name',
        'phone',
        'email',
        'address',
        'user_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
