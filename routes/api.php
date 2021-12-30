<?php

use App\Http\Controllers\api\BeritaDesaController;
use App\Http\Controllers\api\DesaController;
use App\Http\Controllers\api\InfoDesaController;
use App\Http\Controllers\api\KomentarController;
use App\Http\Controllers\api\LaporanPemdesController;
use App\Http\Controllers\api\NotifikasiController;
use App\Http\Controllers\api\PendudukController;
use App\Http\Controllers\api\StatistikController;
use App\Http\Controllers\api\SuratController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [PendudukController::class, 'logout']);

    Route::get('desa/{id}', [DesaController::class, 'show']);

    Route::get('berita-desa', [BeritaDesaController::class, 'index']);
    Route::get('berita-desa/{id}', [BeritaDesaController::class, 'show']);

    Route::get('info-desa', [InfoDesaController::class, 'index']);
    Route::get('info-desa/{id}', [InfoDesaController::class, 'show']);

    Route::post('komentar', [KomentarController::class, 'store']);

    Route::get('laporan-pemdes', [LaporanPemdesController::class, 'index']);
    Route::get('laporan-pemdes/{id}', [LaporanPemdesController::class, 'show']);
    Route::post('laporan-pemdes', [LaporanPemdesController::class, 'store']);
    Route::patch('laporan-pemdes/{id}', [LaporanPemdesController::class, 'update']);

    Route::get('surat', [SuratController::class, 'index']);
    Route::get('surat/{id}', [SuratController::class, 'show']);
    Route::post('surat', [SuratController::class, 'store']);
    Route::patch('surat/{id}', [SuratController::class, 'update']);

    Route::get('notifikasi', [NotifikasiController::class, 'index']);
    Route::patch('notifikasi/{id}', [NotifikasiController::class, 'update']);

    Route::get('statistik', [StatistikController::class, 'index']);
});

Route::post('login', [PendudukController::class, 'login']);
