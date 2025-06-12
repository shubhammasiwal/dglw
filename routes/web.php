<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Worker\WorkerController;

Auth::routes();

Route::get('/', function () {
    return view('landing');
})->name('landing');
Route::get('/error', function () {
    return view('error.error');
});
Route::get('/app', function () {
    return view('layouts.app');
});

Route::group(['middleware' => ['role:portal_admin|admin|welfare_commissioner|data_operator']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['role:portal_admin']], function () {
    // Register Worker Flow
    Route::get('/register-worker', [WorkerController::class, 'registerWorker'])->name('register-worker');
    Route::post('/validate-worker-otp', [WorkerController::class, 'validateWorkerOTP'])->name('validate-worker-otp');
    Route::post('/validating-otp', [WorkerController::class, 'validatingOTP'])->name('validating-otp');
    Route::post('/post-eshram-data', [WorkerController::class, 'postEshramData'])->name('post-eshram-data');
});