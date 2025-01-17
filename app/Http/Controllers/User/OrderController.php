<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;



class OrderController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'totalAmount' => 'required|numeric',
                'cartItems' => 'required|array',
                'cartItems.*.id' => 'required|exists:products,id',
                'cartItems.*.quantity' => 'required|numeric|min:1',
                'cartItems.*.price' => 'required|numeric',
                'description' => 'nullable|string|max:500',
                'tableId' => 'nullable|numeric|exists:tables,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }



        $calculatedTotal = 0;

        foreach ($validatedData['cartItems'] as $item) {
            $calculatedTotal += $item['price'] * $item['quantity'];
        }


        if (abs($calculatedTotal - $validatedData['totalAmount']) > 0.01) {
            return response()->json([
                'message' => 'The total amount does not match the calculated total.',
            ], 400);
        }

        // Create the order
        $order = Order::create([
            'price' => $calculatedTotal,
            'allergies' => $validatedData['description'],
            'table_id' => $validatedData['tableId'],
        ]);

        // Add items to the order
        foreach ($validatedData['cartItems'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'table_id' => $validatedData['tableId'],
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully!',
            'order_id' => $order->id,
        ], 201);
    }


    // public function store(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|numeric',
    //         'email' => 'required|email',
    //         'notes' => 'nullable|string|max:500',
    //         'cart_items' => 'required|json',
    //         'table_id' => 'nullable|numeric|exists:tables,id',
    //     ]);

    //     dd($validatedData);
    //     $cartItems = json_decode($validatedData['cart_items'], true);
    //     //        dd($cartItems);

    //     $validatedCartItems = [];
    //     foreach ($cartItems as $item) {
    //         $validator = \Validator::make($item, [
    //             'id' => 'required|exists:products,id',
    //             'quantity' => 'required|numeric|min:1',
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         $validatedCartItems[] = $validator->validated();
    //     }

    //     $totalPrice = 0;

    //     foreach ($cartItems as $item) {
    //         $totalPrice += $item['price'] * $item['quantity'];
    //     }

    //     //        dd($validatedCartItems);

    //     $order = Order::create([
    //         'price' => $totalPrice,
    //         'name' => $validatedData['name'],
    //         'phone_number' => $validatedData['phone'],
    //         'email' => $validatedData['email'],
    //         'allergies' => $validatedData['notes'],
    //     ]);

    //     foreach ($validatedCartItems as $item) {
    //         OrderItem::create([
    //             'table_id' => $validatedData['table_id'],
    //             'order_id' => $order->id,
    //             'quantity' => $item['quantity'],
    //             'product_id' => $item['id'],
    //         ]);
    //     }

    //     return redirect()->route('order')->with('success', 'Захиалга амжилттай хадгалагдлаа.');
    // }

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
}
