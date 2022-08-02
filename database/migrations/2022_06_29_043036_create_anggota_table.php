<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('id_anggota')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama_anggota')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nohp')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->foreignId('kelompoktani_id')->constrained('kelompoktani')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('anggota');
    }
}
