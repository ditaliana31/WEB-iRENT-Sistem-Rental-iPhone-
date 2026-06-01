<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rental_date',
        'return_date',
        'total_price',
        'status',
        'rental_status',
        'rating',
        'review'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
