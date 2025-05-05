<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_amount',
        'payment_method',
        'client_id', // Nullable client_id
        'employee_id',
    ];

    // An order belongs to a client (client_id is nullable)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // An order belongs to an employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function basket()
    {
        return $this->hasMany(Basket::class);
    }
}

