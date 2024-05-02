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
        Schema::create('detail_spk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_spk');
            $table->unsignedBigInteger('id_buku');
            $table->integer('qty');
            $table->integer('stok');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_spk')->references('id')->on('spk');
            $table->foreign('id_buku')->references('id')->on('buku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_spk');
    }
};
