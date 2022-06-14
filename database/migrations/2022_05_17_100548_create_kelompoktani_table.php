<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompoktaniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompoktani', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelompoktani');
            $table->string('nama_kelompoktani');
            $table->integer('jumlah_anggota');
            $table->string('luas_lahan');
            $table->foreignId('bpp_id')->constrained('bpp')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('wkpp_id')->constrained('wkpp')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('penyuluh_id')->constrained('penyuluh')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelompoktani');
    }
}
