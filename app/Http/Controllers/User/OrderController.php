<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
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


            $phoneNumber = $validatedData['phone'];


            $invoice = $this->payService->createInvoice($totalPrice, $phoneNumber, true);


            if ($invoice['data']['status'] === 'open') {
                return redirect($invoice['data']['url']);
            } else{
                return redirect()->back()->with('error', 'Нэхэмжлэл үүсгэх явцад алдаа гарлаа.');
            }

        return redirect()->with('success', 'Захиалга амжилттай хадгалагдлаа.');
    }

    public function storeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $data = json_decode($payload, true);
       // \Log::info('Webhook received:', $data);

        $signatureReceived = $request->header('Byl-Signature');


        if ($signatureReceived && $this->isSignatureVaild($payload, $signatureReceived)) {
            if (!isset($data['invoice_id'], $data['order_id'], $data['amount'], $data['status'])) {
                return response()->json(['message' => 'Шаардлагатай өгөгдөл байхгүй байна.'], 400);
            }

            if ($data['status'] === 'paid') {
                Payment::create([
                    'invoice_id' => $data['invoice_id'],
                    'order_id' => $data['order_id'],
                    'amount' => $data['amount'],
                    'status' => $data['status'],
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'payment_date' => $data['payment_date'] ?? now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Order::where('id', $data['order_id'])->update([
                    'status' => 'completed',
                ]);
                return response()->json(['message' => 'Төлбөр амжилттай бүртгэгдлээ.'], 200);
            }
        }


        return response()->json(['message' => 'Төлбөр амжилтгүй байна.'], 400);
    }

    protected function isSignatureVaild($payload, $signatureReceived)
    {
        $secretKey = env('BYL_WEBHOOK_SECRET');
        $calculatedSignature = hash_hmac('sha256', $payload, $secretKey);
        return hash_equals($signatureReceived, $calculatedSignature);
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
