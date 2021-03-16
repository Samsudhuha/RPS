<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RpsController;

Route::get('/', [AuthController::class, 'viewLogin']);
Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_user', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('rps')->group(function () {
        Route::get('/cetakRPS', [RpsController::class, 'cetakPDF']);
        Route::get('/create', [RpsController::class, 'viewCreateRps']);
        Route::get('/{id}', [RpsController::class, 'getRpsById']);
    });
});
