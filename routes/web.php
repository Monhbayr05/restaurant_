<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ChefMiddleware;
use App\Http\Middleware\ManagerMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::controller(\App\Http\Controllers\Admin\TableController::class)->group(function () {
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
        Route::get('admin/product2', 'index2')
            ->name('admin.product.index2');
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

Route::controller(RoleController::class)->group(function () {
    Route::get('role/index', 'index')->name('role.index');
    Route::get('role/create', 'create')->name('role.create');
    Route::post('role/store', 'store')->name('role.store');
    Route::delete('role/delete/{id}', 'destroy')->name('role.destroy');
});

Route::middleware(['auth', ChefMiddleware::class])->group(function () {
    Route::get('chef/dashboard', function () {
        return view('chef.dashboard');
    })->name('chef.dashboard');

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('chef/logout', 'destroy')
            ->name('chef.logout');
    });
});

Route::middleware(['auth', ManagerMiddleware::class])->group(function () {
   Route::get('manager/dashboard', function () {
      return view('manager.dashboard');
   })->name('manager.dashboard');

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('manager/logout', 'destroy')
            ->name('manager.logout');
    });

   Route::controller(\App\Http\Controllers\Manager\TableController::class)->group(function () {
       Route::get('manager/table', 'index')->name('manager.table.index');
       Route::post('manager/table', 'store')->name('manager.table.store');
       Route::delete('manager/table/{id}', 'destroy')->name('manager.table.destroy');
       Route::put('manager/table/{id}', 'update')->name('manager.table.update');
   });

   Route::controller(\App\Http\Controllers\Manager\OrderController::class)->group(function () {
      Route::get('manager/order', 'index')->name('manager.order.index');
   });
});

Route::controller(OrderController::class)->group(function () {
   Route::get('order', 'show')->name('order');
   Route::get('order/checkout', 'index')->name('order.checkout');
   Route::post('order/checkout', 'store')->name('order.store');
});

