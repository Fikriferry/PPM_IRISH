<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\CustomerAuthController;

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

// Route publik
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);
Route::get('about', [HomepageController::class, 'about']);

Route::get('/menu', [MenusController::class, 'index'])->name('menu');
Route::get('/menu/category/{slug}', [MenusController::class, 'filterByCategory']);

// Route dashboard
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', ProductCategoryController::class);
    Route::get('products-alias', fn() => redirect()->route('products.index'))->name('products');
    Route::resource('products', ProductController::class);
    Route::resource('menus', MenusController::class);
});

// Volt routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
