<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lampiran_dokumen', function (Blueprint $table) {
            $table->id('lampiran_id');

            // PERBAIKI: Gunakan 'dokumen_hukum' (tanpa s)
            $table->unsignedBigInteger('dokumen_id');
            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');

            $table->string('nama_file');
            $table->string('file_path');
            $table->string('tipe_file')->nullable();
            $table->integer('ukuran_file')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('lampiran_dokumen', function (Blueprint $table) {
            $table->dropForeign(['dokumen_id']);
        });
        Schema::dropIfExists('lampiran_dokumen');
    }
};
