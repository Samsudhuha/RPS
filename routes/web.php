<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CplCpmkController;
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
        Route::prefix('edit')->group(function () {
            Route::post('/matakuliah/{id}', [MataKuliahController::class, 'update']);
            Route::post('/cplcpmk/{id}', [CplCpmkController::class, 'insertOrUpdate']);
            Route::post('/petacplcpmk/{id}', [CplCpmkController::class, 'insertOrUpdatePeta']);
        });
        Route::get('/cetakRPS', [RpsController::class, 'cetakPDF']);
        Route::get('/{id}', [RpsController::class, 'getRpsById']);

        // get dropdown list
        Route::prefix('dropdownlist')->group(function () {
            Route::get('/getjurusan/{id}', [JurusanController::class, 'getSubJurusan']);
            Route::get('/getrmk/{id}', [RmkController::class, 'getSubRmk']);
            Route::get('/getmatakuliah/{id}', [MataKuliahController::class, 'getSubMataKuliah']);
            Route::get('/getdosen/{id}', [DosenController::class, 'getSubDosen']);
        });
    });
});
