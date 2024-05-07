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
        Schema::create('detail_surat_jalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_jalan');
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_distributor');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_surat_jalan')->references('id')->on('surat_jalan');
            $table->foreign('id_buku')->references('id')->on('buku');
            $table->foreign('id_distributor')->references('id')->on('distributor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surat_jalan');
    }
};
