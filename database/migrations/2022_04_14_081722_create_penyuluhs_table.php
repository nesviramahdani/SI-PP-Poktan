<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyuluhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyuluhs', function (Blueprint $table) {
            $table->id();
            $table->string('id_penyuluh')->unique();
            $table->string('nip')->unique();
            $table->string('nama_penyuluh')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('jabatan')->nullable();
            $table->foreignId('bpp_id')->constrained('bpps')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('penyuluhs');
    }
}
