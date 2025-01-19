<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;



class OrderController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
            'cart_items' => 'required|json',
            'table_id' => 'nullable|numeric|exists:tables,id',
        ]);

        $cartItems = json_decode($validatedData['cart_items'], true);

        $validatedCartItems = [];
        foreach ($cartItems as $item) {
            $validator = \Validator::make($item, [
                'id' => 'required|exists:products,id',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required|numeric|min:0',
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validatedCartItems[] = $validator->validated();
        }

        $totalPrice = array_reduce($validatedCartItems, function ($carry, $item) {
            return $carry + $item['quantity'] * $item['price'];
        }, 0);

        $order = Order::create([
            'price' => $totalPrice,
            'phone_number' => $validatedData['phone'],
            'allergies' => $validatedData['notes'],
        ]);

        foreach ($validatedCartItems as $item) {
            OrderItem::create([
                'table_id' => $validatedData['table_id'],
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
                'product_id' => $item['id'],
                'phone_number' => $validatedData['phone'],
            ]);
        }

        return redirect()->route('order')->with('success', 'Захиалга амжилттай хадгалагдлаа.');
    }


    public function show()
    {
        $categories = Category::select('id', 'name', 'thumbnail')->get();
        $products = Product::with('category:id,name')->select(
            'id',
            'name',
            'price',
            'category_id',
            'thumbnail',
            'quantity_limit'
        )->get();


        // dd(['categories' => $categories, 'products' => $products]);

        return Inertia::render('Order', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    public function index()
    {
        return inertia('Checkout');
    }
}
