<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CetakIsiController;
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
use App\Http\Controllers\PenguranganStokController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\UkuranBukuController;
use App\Http\Controllers\UkuranKertasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('spk', SpkController::class);

    Route::resource('buku', BukuController::class);

    Route::resource('penerbit', PenerbitController::class);

    Route::resource('distributor', DistributorController::class);

    Route::resource('finished-goods', FinishedGoodController::class)
        ->except(['show']);

    Route::resource('surat-jalan', SuratJalanController::class);

    Route::resource('surat-jalan.detail', DetailSuratJalanController::class);

    Route::resource('ukuran-buku', UkuranBukuController::class);

    Route::resource('grammatur', GrammaturController::class);

    Route::resource('cetak-isi', CetakIsiController::class);

    Route::resource('kertas-isi', KertasIsiController::class);

    Route::resource('finishing', FinishingController::class);

    Route::resource('ukuran-kertas', UkuranKertasController::class)
        ->parameters([
            'ukuran-kertas' => 'ukuran_kertas',
        ]);

    Route::get('finished-goods/{buku}', [FinishedGoodController::class, 'show'])
        ->name('finished-goods.show');

    Route::resource('retur', ReturController::class);

    Route::resource('retur.detail', DetailReturController::class);

    Route::resource('nota-perbaikan', NotaPerbaikanController::class);

    Route::resource('nota-perbaikan.detail', DetailNotaPerbaikanController::class);

    Route::resource('inventory-hasil', InventoryGudangHasilController::class);

    Route::resource('inventory-retur', InventoryGudangReturController::class);

    Route::post('stock-decrease', PenguranganStokController::class)
        ->name('stock-decrease.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
