<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_spk');
            $table->unsignedBigInteger('id_ukuran_kertas');
            $table->unsignedBigInteger('id_cetak_isi');
            $table->unsignedBigInteger('id_ukuran_buku');
            $table->unsignedBigInteger('id_finishing');
            $table->timestamps();

            $table->foreign('id_spk')->references('id')->on('spk');
            $table->foreign('id_ukuran_kertas')->references('id')->on('ukuran_kertas');
            $table->foreign('id_cetak_isi')->references('id')->on('cetak_isi');
            $table->foreign('id_ukuran_buku')->references('id')->on('ukuran_buku');
            $table->foreign('id_finishing')->references('id')->on('finishing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_material');
    }
};
