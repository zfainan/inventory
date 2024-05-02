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
        Schema::create('ukuran_kertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_grammatur');
            $table->unsignedBigInteger('id_kertas_isi');
            $table->string('ukuran');
            $table->timestamps();


            $table->foreign('id_grammatur')->references('id')->on('grammatur');
            $table->foreign('id_kertas_isi')->references('id')->on('kertas_isi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukuran_kertas');
    }
};
