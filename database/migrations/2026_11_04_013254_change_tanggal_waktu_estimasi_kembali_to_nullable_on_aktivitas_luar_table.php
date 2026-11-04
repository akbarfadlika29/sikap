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
        Schema::table('aktivitas_luar', function (Blueprint $table) {
            $table->date('tanggal_estimasi_kembali')->nullable()->change();
            $table->time('waktu_estimasi_kembali')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktivitas_luar', function (Blueprint $table) {
            $table->date('tanggal_estimasi_kembali')->nullable(false)->change();
            $table->time('waktu_estimasi_kembali')->nullable(false)->change();
        });
    }
};
