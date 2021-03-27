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
use App\Http\Controllers\SilabusController;

Route::get('/', [AuthController::class, 'viewLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('rps')->group(function () {
        Route::prefix('cplcpmk')->group(function () {
            Route::post('/peta/{id}', [CplCpmkController::class, 'insertOrUpdatePeta']);
            Route::post('/{id}', [CplCpmkController::class, 'insertOrUpdate']);
        });

        Route::prefix('matakuliah')->group(function () {
            Route::get('/', [MataKuliahController::class, 'viewCreate']);
            Route::post('/edit/{id}', [MataKuliahController::class, 'update']);
            Route::post('/create', [MataKuliahController::class, 'create']);
        });

        Route::prefix('silabus')->group(function () {
            Route::get('/create/{id}', [SilabusController::class, 'viewCreate']);
            Route::post('/create/{id}', [SilabusController::class, 'create']);
            Route::post('/delete/{id}', [SilabusController::class, 'delete']);
            Route::get('/{id}', [SilabusController::class, 'viewEdit']);
            Route::post('/{id}', [SilabusController::class, 'update']);
        });

        // get dropdown list
        Route::prefix('dropdownlist')->group(function () {
            Route::get('/getjurusan/{id}', [JurusanController::class, 'getSubJurusan']);
            Route::get('/getrmk/{id}', [RmkController::class, 'getSubRmk']);
            Route::get('/getmatakuliah/{id}', [MataKuliahController::class, 'getSubMataKuliah']);
            Route::get('/getdosen/{id}', [DosenController::class, 'getSubDosen']);
        });

        Route::get('/cetakRPS/{id}', [RpsController::class, 'cetakPDF']);
        Route::post('/delete/{id}', [RpsController::class, 'delete']);
        Route::get('/{id}', [RpsController::class, 'getRpsById']);
    });
});
