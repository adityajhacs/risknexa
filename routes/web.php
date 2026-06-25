<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AssessmentQuestionController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {

    Route::resource('vendors', VendorController::class);
    Route::resource('assessments', AssessmentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('assessment-questions', AssessmentQuestionController::class);

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/vendor-dashboard', function () {

    $assessments = App\Models\Assessment::where(
        'vendor_id',
        auth()->user()->vendor_id
    )->get();

    return view(
        'vendor.dashboard',
        compact('assessments')
    );

})->middleware('auth');
Route::get(
    '/vendor/assessment/{assessment}',
    [App\Http\Controllers\VendorAssessmentController::class, 'show']
)->name('vendor.assessment.show')->middleware('auth');
require __DIR__.'/auth.php';
