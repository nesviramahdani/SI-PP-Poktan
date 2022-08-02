<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyuluhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyuluh', function (Blueprint $table) {
            $table->id();
            $table->string('id_penyuluh');
            $table->string('nama_penyuluh');
            $table->string('nip');
            $table->string('jabatan');
            $table->foreignId('bpp_id')->constrained('bpp')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('penyuluh');
    }
}
