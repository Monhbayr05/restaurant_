<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\BylService;
use Illuminate\Http\Request;
use Inertia\Inertia;


class OrderController extends Controller
{
    protected $payService;

    public function __construct(BylService $payService)
    {
        $this->payService = $payService;
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
            'cart_items' => 'required|json',
            'table_id' => 'required|numeric|exists:tables,id', // Table ID is required
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

        // Total price calculation
        $totalPrice = array_reduce($validatedCartItems, function ($carry, $item) {
            return $carry + $item['quantity'] * $item['price'];
        }, 0);

        // Create the order
        $order = Order::create([
            'price' => $totalPrice,
            'phone_number' => $validatedData['phone'],
            'allergies' => $validatedData['notes'],
        ]);

        foreach ($validatedCartItems as $item) {
            OrderItem::create([
                'table_id' => $validatedData['table_id'], // Table ID is correctly passed
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
                'product_id' => $item['id'],
                'phone_number' => $validatedData['phone'],
            ]);
        }

        // **Byl.mn API ашиглаж нэхэмжлэл үүсгэх**
        try {
            $phoneNumber = $validatedData['phone'];

            // BylService ашиглан нэхэмжлэл үүсгэх
            $invoice = $this->payService->createInvoice($totalPrice, $phoneNumber, true);

            // Нэхэмжлэлийн статусыг шалгах
            if ($invoice['data']['status'] === 'open') {
                // Нэхэмжлэлийг хадгалах
                Invoice::create([
                    'user_id' => auth()->id(),
                    'invoice_id' => $invoice['data']['id'],
                    'url' => $invoice['data']['url'],
                    'status' => $invoice['data']['status'],
                    'amount' => $invoice['data']['amount'],
                    'customer_id' => $invoice['data']['customer_id'],
                    'description' => $invoice['data']['description'],
                    'number' => $invoice['data']['number'],
                    'project_id' => $invoice['data']['project_id'],
                    'due_date' => $invoice['data']['due_date'],
                ]);

                // Төлбөрийн URL рүү чиглүүлэх
                return redirect($invoice['data']['url']);
            } elseif ($invoice['data']['status'] === 'closed') {
                return redirect()->back()->with('error', 'Нэхэмжлэл хаагдсан байна.');
            } else {
                return redirect()->back()->with('error', 'Төлбөрийн нэхэмжлэл үүсгэх явцад алдаа гарлаа.');
            }
        } catch (\Exception $e) {
            \Log::error('Byl.mn API алдаа: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Нэхэмжлэл үүсгэх явцад алдаа гарлаа.');
        }

        return redirect()->with('success', 'Захиалга амжилттай хадгалагдлаа.');
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
