<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('kategori_dokumen', function (Blueprint $table) {
        $table->id('kategori_id'); // ← PASTIKAN INI
        $table->string('nama');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

    public function down()
{
    Schema::dropIfExists('kategori_dokumen');
}
};
