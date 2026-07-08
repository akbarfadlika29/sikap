<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan perintah untuk membuat relasi fisik.
     */
    public function up()
    {
        Schema::table('izins', function (Blueprint $table) {
            // Memasang jembatan relasi fisik (Foreign Key) tanpa mengubah struktur kolom yang ada
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Jika akun user dihapus, data izinnya ikut terhapus otomatis agar database bersih
        });
    }

    /**
     * Membatalkan perintah jika terjadi sesuatu.
     */
    public function down()
    {
        Schema::table('izins', function (Blueprint $table) {
            // Menghapus jembatan relasi jika di-rollback
            $table->dropForeign(['user_id']);
        });
    }
};