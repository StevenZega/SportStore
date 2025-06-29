<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/shoes', function () {
    return view('pages.plp');    
})->name('plp');

Route::get('/shoes/{i}', function () {
    return view('pages.pdp');    
})->name('pdp');

Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');

Route::get('/minicart', function () {
    return view('pages.minicart');
})->name('minicart');

Route::get('/my-profile', function () {
    return view('pages.my-profile');
})->name('my-profile');
