<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('denda_log', function (Blueprint $table) {
            $table->id('id_denda');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('jumlah_denda')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_denda')->useCurrent();
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi_sewa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denda_log');
    }
};
