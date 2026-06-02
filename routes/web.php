<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vendors', VendorController::class);
Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);