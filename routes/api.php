<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Admin\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\Auth\ClientAuthController;
use App\Http\Controllers\API\V1\Admin\RequestController;

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



Route::prefix('v1/client')->group(function () {
    Route::post('client/register', [ClientAuthController::class, 'register'])->name('api.client.register');
    Route::post('client/login', [ClientAuthController::class, 'login'])->name('api.client.login');
});
Route::prefix('v1/admin')->group(function () {
    Route::post('admin/register', [AdminAuthController::class, 'register'])->name('api.admin.register');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('api.admin.login');
});
Route::post('/client/requests', [RequestController::class, 'store']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::put('/admin/requests/{id}', [RequestController::class, 'update']);
    Route::delete('/admin/requests/{id}', [RequestController::class, 'destroy']);
});



