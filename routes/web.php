<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/product/create',
    [ProductController::class,'create'])
    ->name('product.create');

Route::post('/product/store',
    [ProductController::class,'store'])
    ->name('product.store');
// Route::middleware('auth')->group(function () {

//     Route::resource(
//         'product',
//         ProductController::class
//     );

   
  
// });

// Route::get('/product-data', [ProductController::class, 'getProducts'])
//     ->name('product.data');

// Route::middleware('auth')
//     ->group(function () {

//         Route::resource(
//             'categories',
//             CategoryController::class
//         );

//     });
Route::middleware('auth')->group(function(){

    Route::get('/dashboard', function () {

        return redirect()->route('product.index');

    })->name('dashboard');
    
});


Route::middleware('auth')->group(function () {
    

    // USER + ADMIN
    Route::post('/logout',
    [AuthenticatedSessionController::class,'destroy']
)->name('logout');

    Route::resource(
        'product',
        ProductController::class
    )->only(['index', 'show']);

     Route::get(
        '/cart',
        [CartController::class, 'index']
    )->name('cart.index');

    Route::post(
        '/add-to-cart/{id}',
        [CartController::class, 'addToCart']
    )->name('add.to.cart');

    Route::post(
        '/remove-cart/{id}',
        [CartController::class, 'remove']
    )->name('remove.cart');

    Route::post(
        '/update-cart/{id}',
        [CartController::class, 'update']
    )->name('update.cart');

    Route::get(
        '/checkout',
        [OrderController::class, 'checkout']
    )->name('checkout');

    Route::post(
        '/place-order',
        [OrderController::class, 'placeOrder']
    )->name('place.order');

      Route::get(
        '/invoice',
        [OrderController::class, 'invoice']
    )->name('invoice');
 

    Route::post(
        '/stripe-checkout',
        [OrderController::class, 'stripeCheckout']
    )->name('stripe.checkout');

    Route::get(
        '/payment-success',
        [OrderController::class, 'paymentSuccess']
    )->name('payment.success');

    Route::get(
        '/payment-cancel',
        [OrderController::class, 'paymentCancel']
    )->name('payment.cancel');
    Route::get('/invoice-pdf', [OrderController::class, 'invoicePdf'])
        ->name('invoice.Pdf');

    Route::post('/feedback',
        [FeedbackController::class, 'store'])
        ->name('feedback.store');

        
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

});

Route::middleware(
['auth','admin']
)

->group(function(){

    // ADMIN ONLY

    Route::resource(
        'categories',
        CategoryController::class
    );


    Route::resource(
        'product',
        ProductController::class
    )->except(['index','show']);

});
require __DIR__.'/auth.php';
