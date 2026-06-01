<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'storage',
        'battery',
        'stock',
        'status',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
