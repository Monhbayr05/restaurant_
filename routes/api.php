<?php

use App\Http\Controllers\User\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(OrderController::class)->group(function () {
    Route::post('byl/webhook' , 'storeWebhook')->name('byl.webhook');
});
