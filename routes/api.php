<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example route
Route::get('/example', function () {
    return response()->json(['message' => 'This is an example route']);
});

// // Route with controller
// Route::get('/users', 'Api\UserController@index');
// Route::get('/users/{id}', 'Api\UserController@show');
// Route::post('/users', 'Api\UserController@store');
// Route::put('/users/{id}', 'Api\UserController@update');
// Route::delete('/users/{id}', 'Api\UserController@destroy');

//Route::get('/test','App\Http\Controllers\UserController@index');

Route::namespace('Api')->group(function () {
    Route::get('/test','App\Http\Controllers\UserController@index');
   
});


