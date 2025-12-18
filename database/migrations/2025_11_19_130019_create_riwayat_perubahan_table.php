<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_perubahan', function (Blueprint $table) {
            $table->id('riwayat_id');

            // PERBAIKI: Gunakan 'dokumen_hukum' (tanpa s)
            $table->unsignedBigInteger('dokumen_id');
            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');

            $table->text('deskripsi_perubahan');
            $table->string('versi');
            $table->timestamp('tanggal_perubahan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('riwayat_perubahan', function (Blueprint $table) {
            $table->dropForeign(['dokumen_id']);
        });
        Schema::dropIfExists('riwayat_perubahan');
    }
};
