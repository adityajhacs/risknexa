<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('vendors', VendorController::class);
Route::resource('assessments', AssessmentController::class);

Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);