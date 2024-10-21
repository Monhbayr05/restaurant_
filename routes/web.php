<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('QR/{qr}', [TableController::class, 'getTable'])->name('qrcode');

require __DIR__ . '/auth.php';


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('admin/logout', 'destroy')
            ->name('admin.logout');
    });
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('admin/restaurant', 'index')
            ->name('admin.restaurant.index');
        Route::post('admin/restaurant', 'store')
            ->name('admin.restaurant.store');
        Route::get('admin/restaurant/{slug}/edit', 'edit')
            ->name('admin.restaurant.edit');
        Route::put('admin/restaurant/{slug}', 'update')
            ->name('admin.restaurant.update');
        Route::delete('admin/restaurant/delete/{slug}', 'destroy')
            ->name('admin.restaurant.delete');
    });
    Route::controller(TableController::class)->group(function () {
        Route::get('admin/table', 'index')
            ->name('admin.table.index');
        Route::post('admin/table', 'store')
            ->name('admin.table.store');



        Route::get('admin/table/{id}/edit', 'edit')
            ->name('admin.table.edit');
        Route::put('admin/table/{id}', 'update')
            ->name('admin.table.update');
        Route::delete('admin/table/{id}', 'destroy')
            ->name('admin.table.delete');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('admin/category', 'index')
            ->name('admin.category.index');
        Route::post('admin/category', 'store')
            ->name('admin.category.store');
        Route::put('admin/category/{id}', 'update')
            ->name('admin.category.update');
        Route::delete('admin/category/{id}', 'destroy')
            ->name('admin.category.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('admin/product', 'index')
            ->name('admin.product.index');
        Route::get('admin/product/create', 'create')
            ->name('admin.product.create');
        Route::post('admin/product/store', 'store')
            ->name('admin.product.store');


        Route::get('admin/products/{id}/image', 'image')
            ->name('admin.product.image');
        Route::post('admin/product/{id}/images', 'storeImage')
            ->name('admin.product.storeImage');

        Route::delete('admin/products/image/{id}', 'imageDestroy')
            ->name('admin.product.imageDestroy');

        Route::get('admin/product/{id}/edit', 'edit')
            ->name('admin.product.edit');

        Route::put('admin/product/{id}/update', 'update')
            ->name('admin.product.update');

        Route::delete('admin/product/delete/{slug}', 'destroy')
            ->name('admin.product.delete');
    });
});



