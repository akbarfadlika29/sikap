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
        Schema::create('penempatan_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_unit_kerja')->constrained('unit_kerja')->cascadeOnDelete();
            $table->foreignId('id_jabatan')->constrained('jabatan')->cascadeOnDelete();
            $table->enum('status_jabatan', ['definitif', 'pelaksana tugas/harian'])->default('definitif');
            $table->timestamps();

            $table->unique([
                'id_user',
                'id_unit_kerja',
                'id_jabatan'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_pegawai');
    }
};
