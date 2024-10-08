<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status', // Статус заказа
        // Другие поля заказа...
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с продуктами через промежуточную таблицу
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
