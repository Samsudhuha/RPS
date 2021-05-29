<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CplCpmkController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\RmkController;
use App\Http\Controllers\RpsController;
use App\Http\Controllers\SilabusController;
use App\Http\Controllers\TaksonomiBloomController;

Route::get('/', [AuthController::class, 'viewLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('pt')->group(function () {
                Route::get('/', [PTController::class, 'adminPt']);
                Route::get('/create', [PTController::class, 'viewCreate']);
                Route::post('/store', [PTController::class, 'store']);
            });
            Route::prefix('taksonomi-bloom')->group(function () {
                Route::get('/', [TaksonomiBloomController::class, 'index']);
                Route::get('/create/{role}', [TaksonomiBloomController::class, 'viewCreate']);
                Route::post('/store', [TaksonomiBloomController::class, 'store']);
                Route::post('/delete/{id}', [TaksonomiBloomController::class, 'delete']);
            });
        });
    });

    Route::middleware(['dosen'])->group(function () {
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

            Route::prefix('dosen')->group(function () {
                Route::get('/', [DosenController::class, 'show']);
                Route::post('/updatePassword', [DosenController::class, 'editPassword']);
                Route::post('/updateDosen', [DosenController::class, 'editDosen']);
            });

            Route::get('/', [RpsController::class, 'index']);
            Route::get('/cetakRPS/{id}', [RpsController::class, 'cetakPDF']);
            Route::post('/delete/{id}', [RpsController::class, 'delete']);
            Route::get('/{id}', [RpsController::class, 'getRpsById']);
        });
    });

    Route::middleware(['pt'])->group(function () {
        Route::prefix('pt')->group(function () {
            Route::get('/', [PTController::class, 'index']);
            Route::post('/uploadFoto', [PTController::class, 'uploadFoto']);
            Route::post('/updatePassword', [PTController::class, 'updatePassword']);
        });

        Route::prefix('fakultas')->group(function () {
            Route::get('/', [FakultasController::class, 'getAll']);
            Route::get('/create', [FakultasController::class, 'viewCreate']);
            Route::post('/store', [FakultasController::class, 'store']);
            Route::post('/edit/{id}', [FakultasController::class, 'edit']);
            Route::post('/delete/{id}', [FakultasController::class, 'delete']);
            Route::get('/{id}', [FakultasController::class, 'show']);
        });

        Route::prefix('jurusan')->group(function () {
            Route::get('/', [JurusanController::class, 'getAll']);
            Route::get('/create', [JurusanController::class, 'viewCreate']);
            Route::post('/store', [JurusanController::class, 'store']);
            Route::post('/edit/{id}', [JurusanController::class, 'edit']);
            Route::post('/delete/{id}', [JurusanController::class, 'delete']);
            Route::get('/{id}', [JurusanController::class, 'show']);
        });

        Route::prefix('cpl')->group(function () {
            Route::post('/post/{id}', [CplCpmkController::class, 'store']);
            Route::get('/create/{id}', [CplCpmkController::class, 'viewCreate']);
            Route::post('/delete/{id}', [CplCpmkController::class, 'delete']);
            Route::post('/edit/{id}', [CplCpmkController::class, 'update']);
            Route::get('/edit/{id}', [CplCpmkController::class, 'show']);
            Route::get('/{id}', [CplCpmkController::class, 'getAll']);
        });

        Route::prefix('rmk')->group(function () {
            Route::get('/', [RmkController::class, 'getAll']);
            Route::get('/create', [RmkController::class, 'viewCreate']);
            Route::post('/store', [RmkController::class, 'store']);
            Route::post('/edit/{id}', [RmkController::class, 'edit']);
            Route::post('/delete/{id}', [RmkController::class, 'delete']);
            Route::get('/{id}', [RmkController::class, 'show']);
        });

        Route::prefix('matakuliah')->group(function () {
            Route::get('/', [MataKuliahController::class, 'getAll']);
            Route::get('/create', [MataKuliahController::class, 'viewCreate']);
            Route::post('/store', [MataKuliahController::class, 'store']);
            Route::post('/edit/{id}', [MataKuliahController::class, 'edit']);
            Route::post('/delete/{id}', [MataKuliahController::class, 'delete']);
            Route::get('/{id}', [MataKuliahController::class, 'show']);
        });

        Route::prefix('dosen')->group(function () {
            Route::get('/', [DosenController::class, 'getAll']);
            Route::get('/user/create', [DosenController::class, 'viewCreateUserDosen']);
            Route::post('/user/store', [DosenController::class, 'storeUserDosen']);
            Route::post('/user/delete/{id}', [DosenController::class, 'deleteUserDosen']);
            Route::post('/delete/{id}', [DosenController::class, 'deleteDosen']);
            Route::get('/create', [DosenController::class, 'viewCreateDosen']);
            Route::post('/store', [DosenController::class, 'storeDosen']);
        });

        Route::prefix('kalab')->group(function () {
            Route::get('/create', [DosenController::class, 'viewCreateKalab']);
            Route::post('/store', [DosenController::class, 'storeKalab']);
            Route::post('/delete/{id}', [DosenController::class, 'deleteKalab']);
        });

        Route::prefix('kaprodi')->group(function () {
            Route::get('/create', [DosenController::class, 'viewCreateKaprodi']);
            Route::post('/store', [DosenController::class, 'storeKaprodi']);
            Route::post('/delete/{id}', [DosenController::class, 'deleteKaprodi']);
        });
    });

    Route::prefix('dropdownlist')->group(function () {
        Route::get('/getfakultas/{id}', [FakultasController::class, 'getSubFakultas']);
        Route::get('/getjurusan/{id}', [JurusanController::class, 'getSubJurusan']);
        Route::get('/getrmk/{id}', [RmkController::class, 'getSubRmk']);
        Route::get('/getmatakuliah/{id}', [MataKuliahController::class, 'getSubMataKuliah']);
        Route::get('/getmatakuliahsyarat/{id}', [MataKuliahController::class, 'getSubMataKuliahSyarat']);
        Route::get('/getdosen/{id}', [DosenController::class, 'getSubDosen']);
        Route::get('/getdosenprogramstudiandjurusan/{jurusan_id}/{program_studi_id}', [DosenController::class, 'getSubDosenByProgramStudiAndJurusan']);
        Route::get('/getdosenfakultas/{id}', [DosenController::class, 'getSubDosenByFakultas']);
        Route::get('/getdosenrmk/{id}', [DosenController::class, 'getSubDosenByRmk']);
    });
});
