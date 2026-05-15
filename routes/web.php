<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

Route::get('/checkout', [CartController::class, 'checkout'])
        ->name('checkout');

Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])
        ->name('add.to.cart');

Route::post('/remove-from-cart/{id}', [CartController::class, 'remove'])
        ->name('remove.cart');

Route::post('/update-cart/{id}', [CartController::class, 'update'])
        ->name('update.cart');


Route::get('/product', [ProductController::class,'index'])
    ->name('product.index');

Route::get('/product-data', [ProductController::class,'getProducts'])
    ->name('product.data');

Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);
