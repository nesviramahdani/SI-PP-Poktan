<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nohp')->nullable();
            $table->string('proposal')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('bantuan_id')->constrained('bantuans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pengajuans');
    }
}
