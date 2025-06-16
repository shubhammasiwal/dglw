<?php

use App\Models\SocialCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gender\GenderController;
use App\Http\Controllers\Worker\WorkerController;
use App\Http\Controllers\WorkerType\WorkerTypeController;
use App\Http\Controllers\CodeDirectory\CodeDirectoryController;
use App\Http\Controllers\MaritalStatus\MaritalStatusController;
use App\Http\Controllers\SocialCategory\SocialCategoryController;
use App\Http\Controllers\WorkerRelationship\WorkerRelationshipController;

Auth::routes();

Route::get('/', function () {
    return view('landing');
})->name('landing');
Route::get('/error', function () {
    return view('errors.error');
});
Route::get('/app', function () {
    return view('layouts.app');
});

Route::group(['middleware' => ['role:portal_admin|admin|welfare_commissioner|data_operator']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['role:portal_admin|admin|welfare_commissioner']], function () {
    // Register Worker Flow
    Route::get('/register-worker', [WorkerController::class, 'registerWorker'])->name('register-worker');
    Route::post('/validate-worker-otp', [WorkerController::class, 'validateWorkerOTP'])->name('validate-worker-otp');
    Route::post('/validating-otp', [WorkerController::class, 'validatingOTP'])->name('validating-otp');
    Route::post('/post-eshram-data', [WorkerController::class, 'postEshramData'])->name('post-eshram-data');
});

Route::group(['middleware' => ['role:portal_admin|admin']], function () {
    // Code Directory and its tools routes
    Route::resource('code-directory', CodeDirectoryController::class);
    Route::resource('marital-status', MaritalStatusController::class);
    Route::resource('social-category', SocialCategoryController::class);
    Route::resource('gender', GenderController::class);
    Route::resource('worker-relationship', WorkerRelationshipController::class);
    Route::resource('worker-type', WorkerTypeController::class);
});