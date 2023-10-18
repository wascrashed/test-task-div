<?php

use App\Http\Controllers\API\V1\Admin\AdminRequestController;
use App\Http\Controllers\API\V1\Admin\Auth\AdminAuthController;
use App\Http\Controllers\API\V1\User\Auth\ClientAuthController;
use App\Http\Controllers\API\V1\User\RequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1/client/')->group(function () {
    Route::post('register', [ClientAuthController::class, 'register'])->name('api.client.register');
    Route::post('login', [ClientAuthController::class, 'login'])->name('api.client.login');
});
Route::prefix('v1/admin/')->group(function () {
    Route::post('register', [AdminAuthController::class, 'register'])->name('api.admin.register');
    Route::post('login', [AdminAuthController::class, 'login'])->name('api.admin.login');
});
Route::prefix('v1/client/')->group(function () {
    Route::post('requests', [RequestController::class, 'store'])->name('api.request.create');
    Route::get('requests', [RequestController::class, 'index'])->name('api.request.index');
    Route::get('requests/{id}', [RequestController::class, 'show'])->name('api.request.show');
});

Route::prefix('v1/admin/')->middleware(['auth:sanctum', ' role:Admin'])->group(function () {
    Route::put('requests/{id}', [AdminRequestController::class, 'update'])->name('api.admin.request.edit');
    Route::delete('requests/{id}', [AdminRequestController::class, 'destroy'])->name('api.admin.request.delete');
});


