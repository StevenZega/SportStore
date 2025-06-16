<?php

use Illuminate\Support\Facades\Route;

Route::get('/shoes', [ShoesController::class, 'index']);

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/order', function () {
    return view('order');
});