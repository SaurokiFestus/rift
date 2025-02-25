<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::get('/shop', [ProductController::class, 'index'])->middleware('auth');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/basket', [BasketController::class, 'index'])->name('cart.index');
    Route::post('/basket/add/{id}', [BasketController::class, 'addToCart'])->name('cart.add');
    Route::post('/basket/update/{id}', [BasketController::class, 'updateCart'])->name('cart.update');
});

Route::post('/checkout', [BasketController::class, 'checkout'])->name('cart.checkout');

//Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');//Admin panel
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{id}/update', [OrdersController::class, 'updateStatus'])->name('admin.orders.update');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store',  [ProductController::class, 'store'])->name('admin.products.store');
});

//User order routes
Route::middleware(['auth'])->group(function(){
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/cart/checkout', [BasketController::class, 'checkout'])->name('cart.checkout');
});