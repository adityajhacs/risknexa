<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vendors', VendorController::class);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('assessments', AssessmentController::class);