<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentQuestionController;
use App\Http\Controllers\EvidenceUploadController;
use App\Http\Controllers\VendorPortalController;

Route::get(
    '/my-assessments',
    [VendorPortalController::class, 'index']
)->middleware('auth')->name('vendor.assessments');

Route::get('/', function () {
    return view('welcome');
});

Route::post(
    '/my-assessments/{assessment}/submit',
    [VendorPortalController::class, 'submitAssessment']
)->name('vendor.assessments.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('vendors', VendorController::class);
Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);
Route::resource('assessments', AssessmentController::class);

Route::put(
    '/assessment-questions/{assessmentQuestion}',
    [AssessmentQuestionController::class, 'update']
)->name('assessment-questions.update');

Route::post(
    '/assessments/{assessment}/review',
    [AssessmentController::class, 'review']
)->name('assessments.review');

Route::get(
    '/assessments/{assessment}/evidence/create',
    [EvidenceUploadController::class, 'create']
);
Route::get('/my-assessments',
    [VendorPortalController::class,'index']
)->name('my.assessments');

Route::get(
    '/my-assessments/{assessment}',
    [VendorPortalController::class,'show']
)->name('vendor.assessments.show');

Route::post(
    '/assessments/{assessment}/evidence',
    [EvidenceUploadController::class, 'store']
);

Route::post(
    '/my-assessments/{assessment}/save',
    [VendorPortalController::class,'saveResponses']
)->name('vendor.assessments.save');

Route::delete(
    '/evidence/{evidenceUpload}',
    [EvidenceUploadController::class, 'destroy']
)->name('evidence.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
