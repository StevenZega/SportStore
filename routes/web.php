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