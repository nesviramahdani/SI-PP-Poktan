<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('id_anggota')->unique();
            $table->string('nik')->unique();
            $table->string('nama_anggota')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('jenis_lahan')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->foreignId('kelompok_tani_id')->constrained('kelompok_tanis')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('anggotas');
    }
}
