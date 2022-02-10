<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SalesController::class)->group(function () {
    Route::get('/upload', 'index')->name('upload.index');
    Route::post('/upload', 'upload')->name('upload');
    Route::get('/store-data', 'store')->name('store');
});
