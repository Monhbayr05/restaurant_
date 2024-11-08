<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HumanOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class OrderController extends Controller
{
    public function index(){

        return view('user.checkout');
    }
    public function order(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'notes' => 'nullable|string|max:500',
            'cart_items' => 'required|json',
        ]);

        $cartItems = json_decode($validatedData['cart_items'], true);

        $totalPrice = 0;
        $foodNames = [];
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $foodNames[] = $item['name'];
        }

        $order = Order::create([
            'quantity' => count($cartItems),
            'price' => $totalPrice,
            'food_name' => implode(', ', $foodNames),
            'food_image' => 'Product Image',
        ]);

        HumanOrder::create([
            'order_id' => $order->id,
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'allergies' => $validatedData['notes'],
        ]);

        return redirect()->route('order')->with('success', 'Захиалга амжилттай хадгалагдлаа.');
    }

    public function show()
    {



        $categories = Category::all();
        $products = Product::all();

        return Inertia::render('Order', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
