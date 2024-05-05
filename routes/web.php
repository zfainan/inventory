<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CetakIsiController;
use App\Http\Controllers\DetailSuratJalanController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\FinishedGoodController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\GrammaturController;
use App\Http\Controllers\KertasIsiController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SuratJalanController;
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

    Route::resource('finished-goods', FinishedGoodController::class);

    Route::resource('surat-jalan', SuratJalanController::class);

    Route::resource('surat-jalan.detail', DetailSuratJalanController::class);

    Route::resource('grammatur', GrammaturController::class);

    Route::resource('cetak-isi', CetakIsiController::class);

    Route::resource('kertas-isi', KertasIsiController::class);

    Route::resource('finishing', FinishingController::class);

    Route::resource('ukuran-kertas', UkuranKertasController::class)
        ->parameters([
            'ukuran-kertas' => 'ukuran_kertas'
        ]);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
