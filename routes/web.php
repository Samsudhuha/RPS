<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\RmkController;
use App\Http\Controllers\RpsController;

Route::get('/', [AuthController::class, 'viewLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('rps')->group(function () {
        Route::prefix('create')->group(function () {
            Route::get('/', [RpsController::class, 'viewCreateRps']);
            Route::post('/matakuliah', [MataKuliahController::class, 'create']);
        });
        Route::get('/cetakRPS', [RpsController::class, 'cetakPDF']);
        Route::get('/{id}', [RpsController::class, 'getRpsById']);
        // get dropdown list
        Route::get('/dropdownlist/getjurusan/{id}', [JurusanController::class, 'getSubJurusan']);
        Route::get('/dropdownlist/getrmk/{id}', [RmkController::class, 'getSubRmk']);
        Route::get('/dropdownlist/getmatakuliah/{id}', [MataKuliahController::class, 'getSubMataKuliah']);
        Route::get('/dropdownlist/getdosen/{id}', [DosenController::class, 'getSubDosen']);
    });
});
