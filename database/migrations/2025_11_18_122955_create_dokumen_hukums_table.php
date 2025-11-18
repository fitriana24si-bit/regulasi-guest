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
            $table->foreignId('id_jenis')->constrained('jenis_dokumen', 'id_jenis');
            $table->foreignId('kategori_id')->constrained('kategori_dokumen', 'kategori_id');
            $table->string('nomor')->unique();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
