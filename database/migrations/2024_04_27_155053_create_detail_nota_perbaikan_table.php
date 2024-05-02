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
        Schema::create('detail_nota_perbaikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('id_detail_retur');
            $table->unsignedBigInteger('id_nota_perbaikan');
            $table->string('status');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_petugas')->references('id')->on('petugas');
            $table->foreign('id_detail_retur')->references('id')->on('detail_retur');
            $table->foreign('id_nota_perbaikan')->references('id')->on('nota_perbaikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_nota_perbaikan');
    }
};
