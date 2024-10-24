<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


class OrderController extends Controller
{
    public function show()
    {
        return Inertia::render('Order');
    }

    public function submit(Request $request)
    {
        // Extract the data sent from the frontend
        $data = $request->validate([
            'totalAmount' => 'required|numeric',
            'orderItems' => 'required|array',
            'table' => 'nullable|string',
        ]);

        // Implement the logic for creating an order and interacting with QPay here
        // For demonstration, let's assume you generate a payment URL
        $paymentUrl = 'https://payment-gateway.com/pay?order_id=1234';

        return response()->json([
            'success' => true,
            'paymentUrl' => $paymentUrl,
        ]);
    }
}
