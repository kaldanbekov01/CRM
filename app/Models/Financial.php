<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    protected $fillable = [
        'income',
        'expense',
        'date',
        'user_id',
    ];
}
