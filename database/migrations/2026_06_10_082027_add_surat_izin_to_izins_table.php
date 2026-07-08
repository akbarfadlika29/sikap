<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up()
       {
           Schema::table('izins', function (Blueprint $table) {
               // Menambahkan kolom surat_izin yang boleh kosong (nullable)
               $table->string('surat_izin')->nullable()->after('alasan'); 
           });
       }

       public function down()
       {
           Schema::table('izins', function (Blueprint $table) {
               $table->dropColumn('surat_izin');
           });
       }
   };