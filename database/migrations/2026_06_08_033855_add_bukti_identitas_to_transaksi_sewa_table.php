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
        Schema::table('transaksi_sewa', function (Blueprint $table) {
            $table->string('bukti_ktp')->nullable()->after('bukti_pembayaran');
            $table->string('bukti_sim')->nullable()->after('bukti_ktp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_sewa', function (Blueprint $table) {
            $table->dropColumn(['bukti_ktp', 'bukti_sim']);
        });
    }
};
