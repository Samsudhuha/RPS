<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'viewLogin']);
Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_user', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
