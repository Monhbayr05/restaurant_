<?php

use Illuminate\Support\Facades\Route;



Route::controller(\App\Http\Controllers\Api\PaymentController::class)->group(function () {
    Route::post('create-invoice', 'createInvoice')->name('api.invoice.create');

    Route::post('webhook/payment','handleWebhook')->name('api.webhook.payment');
});



