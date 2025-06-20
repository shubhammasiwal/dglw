<?php

use App\Models\SocialCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\LGD\LGDStateController;
use App\Http\Controllers\Gender\GenderController;
use App\Http\Controllers\Worker\WorkerController;
use App\Http\Controllers\LGD\LGDDistrictController;
use App\Http\Controllers\Address\AddressTypeController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\Disability\DisabilityController;
use App\Http\Controllers\WorkerType\WorkerTypeController;
use App\Http\Controllers\CodeDirectory\CodeDirectoryController;
use App\Http\Controllers\MaritalStatus\MaritalStatusController;
use App\Http\Controllers\SocialCategory\SocialCategoryController;
use App\Http\Controllers\MigrationReason\MigrationReasonController;
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
    Route::get('/validate-otp', [WorkerController::class, 'validateOTP'])->name('validate-otp');
    Route::post('/validating-otp', [WorkerController::class, 'validatingOTP'])->name('validating-otp');
    Route::post('/save-eshram-data', [WorkerController::class, 'saveEshramData'])->name('save-eshram-data');

    // Registered Worker
    Route::get('/registered-workers', [WorkerController::class, 'registeredWorkers'])->name('registered-workers');
    Route::get('/registered-workers/{registered_worker}', [WorkerController::class, 'showRegisteredWorker'])->name('show-registered-worker');
    // Route::get('/registered-workers/{registered_worker}/edit', [WorkerController::class, 'editRegisteredWorker'])->name('edit-registered-worker');
    // Route::put('/registered-workers/{registered_worker}', [WorkerController::class, 'updateRegisteredWorker'])->name('update-registered-worker');
    Route::delete('/registered-workers/{registered_worker}', [WorkerController::class, 'destroyRegisteredWorker'])->name('destroy-registered-worker');

    // Add Family Flow
    // Route::get('/add-family-form', [WorkerController::class, 'addFamilyForm'])->name('add-family-form');
    Route::get('/add-family-form', function() {
        return 'kkkk';
    })->name('add-family-form');
});

Route::group(['middleware' => ['role:portal_admin|admin']], function () {
    // Code Directory and its tools routes
    Route::resource('code-directory', CodeDirectoryController::class);
    Route::resource('marital-status', MaritalStatusController::class);
    Route::resource('social-category', SocialCategoryController::class);
    Route::resource('gender', GenderController::class);
    Route::resource('worker-relationship', WorkerRelationshipController::class);
    Route::resource('worker-type', WorkerTypeController::class);
    Route::resource('disability', DisabilityController::class);
    Route::resource('education', EducationController::class);
    Route::resource('migration-reason', MigrationReasonController::class);
    Route::resource('address-type', AddressTypeController::class);

    // LGD Code
    Route::get('l-g-d-state', [LGDStateController::class, 'index'])->name('l-g-d-state.index');
    Route::get('l-g-d-district', [LGDDistrictController::class, 'index'])->name('l-g-d-district.index');

    // User Route
    Route::resource('users', UserController::class);
});

