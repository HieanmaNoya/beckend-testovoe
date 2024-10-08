<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product; // Предполагается, что у вас есть модель Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all(); // Возвращает список товаров
    }

    // Методы для добавления, редактирования и удаления товаров будут здесь
}
