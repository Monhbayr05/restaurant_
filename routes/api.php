<?php

use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\User\OrderController::class)->group(function () {
    Route::post('byl/webhook' , 'storeWebhook')->name('byl.webhook');

});





