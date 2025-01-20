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


            $phoneNumber = $order->id;


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

        $signatureReceived = $request->header('Byl-Signature');

        // Signature шалгалт
        if ($signatureReceived && $this->isSignatureVaild($payload, $signatureReceived)) {
            // `type` утга нь `invoice.paid` эсэхийг шалгах
            if (isset($data['type']) && $data['type'] === "invoice.paid") {
                $order = Order::find($data['data']['object']['description']);

                Payment::create([
                    'invoice_id' => $data['data']['object']['id'], // Corrected to access the nested data
                    'order_id' => $order->id, // Assuming description is the order_id
                    'amount' => $data['data']['object']['amount'],
                    'status' => $data['data']['object']['status'],
                    'transaction_id' => $data['data']['object']['url'] ?? null, // Using URL as an example
                    'payment_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Order::where('id', $data['data']['object']['description'])->update([
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
