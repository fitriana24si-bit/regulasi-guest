<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id('dokumen_id');

            // PERBAIKI: Specify foreign key manual
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_dokumen')->onDelete('cascade');

            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_dokumen')->onDelete('cascade');

            $table->string('nomor');
            $table->string('judul');
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('dokumen_hukum', function (Blueprint $table) {
            $table->dropForeign(['id_jenis']);
            $table->dropForeign(['kategori_id']);
        });
        Schema::dropIfExists('dokumen_hukum');
    }
};
