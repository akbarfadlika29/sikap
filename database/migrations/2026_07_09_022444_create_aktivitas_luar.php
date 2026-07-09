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
        Schema::create('aktivitas_luar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jenis_aktivitas_luar')->nullable();
            $table->text('deskripsi_aktivitas_luar');
            $table->date('tanggal_keluar');
            $table->time('waktu_keluar');
            $table->date('tanggal_estimasi_kembali');
            $table->time('waktu_estimasi_kembali');
            $table->date('tanggal_kembali')->nullable();
            $table->time('waktu_kembali')->nullable();
            $table->boolean('posisi_di_kantor')->default(0);
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('status_verifikasi', ['Belum Diverifikasi', 'Sudah Diverifikasi'])->default('Belum Diverifikasi');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_jenis_aktivitas_luar')->references('id')->on('jenis_aktivitas_luar')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_luar');
    }
};
