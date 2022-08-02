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
            $table->date('tanggal_terbentuk');
            $table->string('kelas_kelompok');
            $table->string('badan_hukum');
            $table->text('alamat_sekretariat');
            $table->foreignId('wkpp_id')->constrained('wkpp')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kelompoktani');
    }
}
