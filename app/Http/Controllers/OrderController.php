<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
public function create(Request $request)
{

$request->validate([
'customer_name' => 'required|string|max:255',
'customer_email' => 'required|email|max:255',
]);


$cart = Session::get('cart', []);

if (empty($cart)) {
return response()->json(['message' => 'Корзина пуста!'], 400);
}


$totalPrice = 0;
foreach ($cart as $item) {
$totalPrice += $item['price'] * $item['quantity'];
}


$order = Order::create([
'cart' => json_encode($cart),
'total_price' => $totalPrice,
]);


Session::forget('cart');

return response()->json(['message' => 'Заказ оформлен!', 'order_id' => $order->id]);
}
}
