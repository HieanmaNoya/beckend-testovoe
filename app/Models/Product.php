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
        // Другие поля...
    ];

    // Связь с корзиной
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}
