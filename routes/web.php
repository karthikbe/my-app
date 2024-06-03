<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/orders',[OrdersController::class,'index'])->name('orders.index');
Route::get('/orders/create',[OrdersController::class,'create'])->name('orders.create');
Route::post('/orders/store',[OrdersController::class,'store'])->name('orders.store');
Route::get('/orders/edit/{orders}',[OrdersController::class,'edit'])->name('orders.edit');
Route::put('/orders/update/{orders}',[OrdersController::class,'update'])->name('orders.update');
Route::get('/orders/delete/{orders}',[OrdersController::class,'destroy'])->name('orders.delete');
Route::get('/import-order',[OrdersController::class,'importOrder'])->name('orders.import');
Route::post('/upload-order',[OrdersController::class,'uploadOrder'])->name('orders.upload');