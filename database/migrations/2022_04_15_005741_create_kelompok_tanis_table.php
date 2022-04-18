<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokTanisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelompok')->unique();
            $table->string('nama_kelompok')->nullable();
            $table->string('jumlah_anggota')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->string('kelas_kelompok')->nullable();
            $table->string('badan_hukum')->nullable();
            $table->date('tanggal_kelompok')->nullable();
            $table->string('alamat_sekretariat')->nullable();
            $table->foreignId('wkpp_id')->constrained('wkpps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kelompok_tanis');
    }
}
