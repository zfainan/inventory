<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CetakIsiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailNotaPerbaikanController;
use App\Http\Controllers\DetailReturController;
use App\Http\Controllers\DetailSuratJalanController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\FinishedGoodController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\GrammaturController;
use App\Http\Controllers\InventoryGudangHasilController;
use App\Http\Controllers\InventoryGudangReturController;
use App\Http\Controllers\KertasIsiController;
use App\Http\Controllers\NotaPerbaikanController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenguranganStokGudangHasilController;
use App\Http\Controllers\PenguranganStokGudangReturController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\UkuranBukuController;
use App\Http\Controllers\UkuranKertasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Petugas Gudang Hasil
    Route::resource('spk', SpkController::class);

    Route::resource('surat-jalan', SuratJalanController::class);

    Route::resource('surat-jalan.detail', DetailSuratJalanController::class);

    Route::resource('buku', BukuController::class);

    Route::resource('penerbit', PenerbitController::class);

    Route::resource('distributor', DistributorController::class);

    Route::resource('finished-goods', FinishedGoodController::class)
        ->except(['show']);

    Route::get('finished-goods/{buku}', [FinishedGoodController::class, 'show'])
        ->name('finished-goods.show');

    Route::resource('ukuran-buku', UkuranBukuController::class);

    Route::resource('grammatur', GrammaturController::class);

    Route::resource('cetak-isi', CetakIsiController::class);

    Route::resource('kertas-isi', KertasIsiController::class);

    Route::resource('finishing', FinishingController::class);

    Route::resource('ukuran-kertas', UkuranKertasController::class)
        ->parameters([
            'ukuran-kertas' => 'ukuran_kertas',
        ]);

    Route::resource('inventory-hasil', InventoryGudangHasilController::class);

    Route::post('inventory-hasil/stock-decrease', PenguranganStokGudangHasilController::class)
        ->name('inventory-hasil.stock-decrease.store');

    // Petugas Gudang Retur
    Route::resource('retur', ReturController::class);

    Route::resource('retur.detail', DetailReturController::class);

    Route::resource('nota-perbaikan', NotaPerbaikanController::class);

    Route::resource('nota-perbaikan.detail', DetailNotaPerbaikanController::class);

    Route::resource('inventory-retur', InventoryGudangReturController::class);

    Route::post('inventory-retur/stock-decrease', PenguranganStokGudangReturController::class)
        ->name('inventory-retur.stock-decrease.store');

    // Manager
    Route::resource('users', UserController::class);

    // Print
    Route::get('print/surat-jalan/{surat_jalan}', [PrintController::class, 'suratJalan'])
        ->name('print.surat-jalan');

    Route::get('print/finished-goods/{detail_spk}', [PrintController::class, 'finishedGoods'])
        ->name('print.finished-goods');

    Route::get('print/retur/{retur}', [PrintController::class, 'retur'])
        ->name('print.retur');

    Route::get('print/nota-perbaikan/{nota_perbaikan}', [PrintController::class, 'notaPerbaikan'])
        ->name('print.nota-perbaikan');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
]);
