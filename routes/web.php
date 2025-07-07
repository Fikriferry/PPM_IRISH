<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CustomerController;

// Route untuk customer
Route::prefix('customer')->group(function () {
    Route::controller(CustomerAuthController::class)->group(function () {
        Route::middleware('check_customer_login')->group(function () {
            Route::get('login', 'login')->name('customer.login');
            Route::post('login', 'store_login')->name('customer.store_login');
            Route::get('register', 'register')->name('customer.register');
            Route::post('register', 'store_register')->name('customer.store_register');
        });

        Route::post('logout', 'logout')->name('customer.logout');
    });
});

use App\Http\Controllers\OrderExportController;

Route::get('/orders/export', [OrderExportController::class, 'export'])->name('orders.export');

// Route publik
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);
Route::get('/about', [HomepageController::class, 'about']);
Route::get('contact', [HomepageController::class, 'contact']);
Route::resource('categories', ProductCategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('user', CustomerController::class);
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/category/{slug}', [MenuController::class, 'filterByCategory']);
Route::get('/menu/all', [MenuController::class, 'allProductsPartial'])->name('menu.all');
Route::resource('galleries', GalleryController::class);
Route::put('/galleries/{id}/toggle', [GalleryController::class, 'toggleStatus'])->name('galleries.toggle');

Route::get('/api/products/search', function (\Illuminate\Http\Request $request) {
    $search = $request->get('term');
    $products = \App\Models\Product::where('is_active', true)
        ->where('name', 'like', "%$search%")
        ->limit(10)
        ->get(['id', 'name', 'price']);

    return response()->json($products);
})->name('api.products.search');

// Route dashboard
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    

})->middleware(['auth', 'verified']);

    Route::get('products-alias', fn() => redirect()->route('products.index'))->name('products');
    Route::resource('products', ProductController::class);


// Volt routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});



require __DIR__ . '/auth.php';
