<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'user_id',
        'payment_method',
        'total',
        'status',
        'rental_status',
        'rating',
        'review',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION CARTS
    |--------------------------------------------------------------------------
    */

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
