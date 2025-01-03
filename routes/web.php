<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/about',[FrontEndController::class,'about']);
Route::get('/cart',[FrontEndController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontEndController::class,'checkout']);
Route::get('/',[FrontEndController::class,'index']);
Route::get('/products',[FrontEndController::class,'products']);
Route::get('/singleProduct/{id}',[FrontEndController::class,'singleProduct'])->name('single_product');


// Add to cart && Order Routes

Route::post('/add_to_cart',[FrontEndController::class,'add_to_cart'])->name('add_to_cart');

Route::post('/remove_from_cart',[FrontEndController::class,'remove_from_cart'])->name('remove_from_cart');

Route::get('/checkout',[FrontEndController::class,'checkout'])->name('checkout');

Route::post('/place_order',[FrontEndController::class,'place_order'])->name('place_order');

Route::get('/payment',[PaymentController::class,'payment'])->name('payment');
Route::post('/pay',[PaymentController::class,'pay'])->name('pay');

Route::get('/processPayment',[PaymentController::class,'processPayment'])->name('processPayment');
