<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/about',[FrontEndController::class,'about']);
Route::get('/cart',[FrontEndController::class,'cart']);
Route::get('/checkout',[FrontEndController::class,'checkout']);
Route::get('/',[FrontEndController::class,'index']);
Route::get('/products',[FrontEndController::class,'products']);
Route::get('/singleProduct/{id}',[FrontEndController::class,'singleProduct'])->name('single_product');


Route::post('/add_to_cart',[FrontEndController::class,'add_to_cart'])->name('add_to_cart');