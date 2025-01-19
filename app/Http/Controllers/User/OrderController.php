<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;



class OrderController extends Controller
{

    // public function checkout(Request $request)
    // {
    //     // 1) Хүсэлтийн өгөгдлүүдээ шалгана
    //     $validatedData = request()->validate([
    //         'cartItems' => 'required|array',
    //         'cartItems.*.id'       => 'required|integer',
    //         'cartItems.*.name'     => 'required|string|max:255',
    //         'cartItems.*.price'    => 'required|numeric|min:0',
    //         'cartItems.*.quantity' => 'required|integer|min:1',
        
    //         'totalAmount' => 'required|numeric|min:1',
        
    //         'description' => 'nullable|string|max:500',
    //         'table_id'    => 'nullable|integer',
    //         'phoneNumber' => 'required|string|min:8|max:15',
    //     ]);
        
        

    //     // 2) Тухайн захиалгыг DB-дээ бүртгэж хадгална (жишээ код)
    //     //  $order = Order::create([
    //     //      'phone' => $request->phoneNumber,
    //     //      'description' => $request->description,
    //     //      'total_amount' => $request->totalAmount,
    //     //  ]);

    //     // 3) Byl-д нэхэмжлэх үүсгэх
    //     $client = new Client();
    //     $bylBaseUrl   = env('BYL_BASE_URL', 'https://byl.mn');
    //     $bylProjectId = env('BYL_PROJECT_ID');
    //     $bylToken     = env('BYL_TOKEN');      

    //     try {
    //         $response = $client->request('POST', "$bylBaseUrl/api/v1/projects/$bylProjectId/invoices", [
    //             'headers' => [
    //                 'Authorization' => "Bearer $bylToken",
    //                 'Content-Type'  => 'application/json',
    //                 'Accept'        => 'application/json'
    //             ],
    //             'json' => [
    //                 // Та front-оос ирсэн нийт дүнг оруулна
    //                 'amount'      => $request->totalAmount,
    //                 'description' => $request->phoneNumber ?: 'Order Payment',
    //                 // auto_advance = true => төлбөр төлөгдөөд дууссан л бол эцэслэнэ
    //                 'auto_advance' => true
    //             ]
    //         ]);

    //         $invoiceData = json_decode($response->getBody()->getContents(), true);

    //         // Нэхэмжлэхийн линк
    //         $invoiceUrl = $invoiceData['data']['url'] ?? null;

    //         if (!$invoiceUrl) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Failed to get invoice URL from Byl-bbb'
    //             ], 500);
    //         }

    //         // 4) Амжилттай нэхэмжлэх үүссэн тохиолдолд front-end рүү invoiceUrl буцаана
    //         // Мөн үүнийг orders хүснэгтийнхээ аль нэг талбарт хадгалж болно
    //         // $order->invoice_url = $invoiceUrl;
    //         // $order->save();

    //         return response()->json([
    //             'success' => true,
    //             'invoiceUrl' => $invoiceUrl,
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Byl invoice create error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to create invoice-aaa'
    //         ], 500);
    //     }
    // }

    // public function handleWebhook(Request $request)
    // {
    //     // Byl webhook-с ирж буй түүхий body
    //     $rawBody = $request->getContent();
    //     $signature = $request->header('byl-signature');
    //     $hashKey = env('BYL_HASH_KEY');

    //     // HMAC шалгах
    //     $computedSignature = hash_hmac('sha256', $rawBody, $hashKey);

    //     if (!hash_equals($computedSignature, $signature)) {
    //         return response('Invalid signature', 403);
    //     }

    //     // Амжилттай бол event-ийн мэдээллийг авч лог хийх буюу DB-г шинэчлэх
    //     $payloadData = json_decode($rawBody, true);
    //     Log::info('BYL Webhook Data: ', $payloadData);

    //     // Тухайн invoice төлбөр төлөгдсөн, цуцлагдсан гэх зэрэг event-тэй холбоотой
    //     // өөрийн бизнес логик (orders хүснэгтийг шинэчлэх, төлбөрийн төлөв гэх мэт)-ыг
    //     // энд бичиж болно.

    //     return response('Webhook received!', 200);
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
    public function index()
    {
        return Inertia::render('Checkout'); // resources/js/Pages/Checkout.jsx гэсэн файлаа render
    }
}
