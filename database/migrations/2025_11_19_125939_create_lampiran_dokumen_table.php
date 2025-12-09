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
            $table->unsignedBigInteger('dokumen_id');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');
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
