<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DetailSuratJalanController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\FinishedGoodController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SuratJalanController;
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
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
