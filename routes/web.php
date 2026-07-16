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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorUserController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\DomainController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/assessment-test', [AssessmentController::class, 'test']);
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Vendor Dashboard (Vendor Admin + Vendor User)
Route::middleware(['auth'])->group(function () {

    Route::get('/vendor-dashboard', [VendorDashboardController::class,'index'])
        ->name('vendor.dashboard');

});

// Vendor User Management (Only Vendor Admin)
Route::middleware(['auth', 'vendor.admin'])->group(function () {

    Route::resource('vendor-users', VendorUserController::class);

});
Route::middleware('auth')->group(function () {
    Route::resource('vendors', VendorController::class);
    Route::resource('frameworks', FrameworkController::class);
Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);
Route::resource('assessments', AssessmentController::class);
Route::resource('domains', DomainController::class);
Route::post(
    '/my-assessments/{assessment}/submit',
    [VendorPortalController::class, 'submitAssessment']
)->name('vendor.assessments.submit');
Route::get(
    '/my-assessments/{assessment}/question/{question}/history',
    [VendorPortalController::class,'history']
)->name('vendor.assessments.history');
Route::get(
    '/assessments/{assessment}/report',
    [AssessmentController::class, 'report']
)->name('assessments.report');


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
Route::get(
    '/my-assessments',
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
    '/my-assessments/{assessment}/question/{question}/save',
    [VendorPortalController::class, 'saveQuestion']
)->name('vendor.assessments.saveQuestion');

Route::resource('users', UserController::class);

Route::get(
    '/reports',
    [AssessmentController::class, 'reports']
)->name('reports.index');
Route::delete(
    '/my-assessments/{assessment}/question/{question}/evidence',
    [VendorPortalController::class, 'deleteEvidence']
)->name('vendor.assessments.deleteEvidence');
Route::delete(
    '/evidence/{evidenceUpload}',
    [EvidenceUploadController::class, 'destroy']
)->name('evidence.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';