<?php

use App\Http\Controllers\LaporanPemdesController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('update-notifikasi', [NotifikasiController::class, 'update']);

    Route::get('surat-print/{id}', [SuratController::class, 'print'])->name('printSurat');

    Route::get('laporan-pemdes-print/{id}', [LaporanPemdesController::class, 'print'])->name('printLaporanPemdes');

    Route::get('penduduk-print/{id}', [PendudukController::class, 'print'])->name('printPenduduk');
    Route::get('penduduk-print', [PendudukController::class, 'printAll'])->name('printAllPenduduk');
});
