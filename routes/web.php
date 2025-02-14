<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;


Auth::routes();

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('/suggested-products/{userId}', [CartController::class, 'get_similar_products']);

Route::get('/cart',[CartItemController::class,'index'])->name('cart');

Route::post('/update_quantity', [CartItemController::class, 'updateQuantity'])->name('update_quantity');

Route::post('/cart/remove', [CartItemController::class, 'removeFromCart'])->name('remove_from_cart');

Route::get('/checkout', [OrderController::class,'checkOut'])->name('checkout');

Route::post('placeOrder', [OrderController::class, 'placeOrder'])->name('placeOrder');

Route::get('/dashbord',[OrderController::class,'index'])->name('dashbord');

