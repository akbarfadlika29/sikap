<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('izins', function (Blueprint $table) {
            // Menambahkan kolom jam keluar dan jam kembali bertipe 'time'
            $table->time('jam_keluar')->nullable()->after('tanggal_mulai');
            $table->time('jam_kembali')->nullable()->after('tanggal_selesai');
        });
    }

    public function down()
    {
        Schema::table('izins', function (Blueprint $table) {
            $table->dropColumn(['jam_keluar', 'jam_kembali']);
        });
    }
};