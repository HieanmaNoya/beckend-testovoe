<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cart;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Получаем текущую корзину из сессии
        $cart = Session::get('cart', []);

        // Если товар уже есть в корзине, увеличиваем количество
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            // Иначе добавляем новый товар
            $cart[$request->product_id] = [
                'quantity' => $request->quantity,
                // Здесь можно добавить дополнительные данные о товаре, например:
                'name' => $request->input('name'), // название товара
                'price' => $request->input('price'), // цена товара
            ];
        }

        // Сохраняем обновлённую корзину в сессию
        Session::put('cart', $cart);

        return response()->json(['message' => 'Товар добавлен в корзину!', 'cart' => $cart]);
    }

    public function view()
    {
        // Получаем текущую корзину из сессии
        $cart = Session::get('cart', []);

        return response()->json($cart);
    }

    public function remove(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        // Получаем текущую корзину из сессии
        $cart = Session::get('cart', []);

        // Удаляем товар из корзины, если он существует
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            Session::put('cart', $cart);
            return response()->json(['message' => 'Товар удалён из корзины!', 'cart' => $cart]);
        }

        return response()->json(['message' => 'Товар не найден в корзине!'], 404);
    }
}
