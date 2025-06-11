<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Worker\WorkerController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/register-worker', [WorkerController::class, 'registerWorker'])->name('register-worker');
Route::post('/validate-worker-otp', [WorkerController::class, 'validateWorkerOTP'])->name('validate-worker-otp');
Route::post('/validating-otp', [WorkerController::class, 'validatingOTP'])->name('validating-otp');
// Route::post('/view-eshram-data', [WorkerController::class, 'viewEshramData'])->name('view-eshram-data');
Route::post('/post-eshram-data', [WorkerController::class, 'postEshramData'])->name('post-eshram-data');


Route::get('/error', function () {
    return view('error.error');
});

Route::get('/app', function () {
    return view('layouts.app');
});