<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWkppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wkpps', function (Blueprint $table) {
            $table->id();
            $table->string('id_wkpp')->unique();
            $table->string('nama_wkpp')->nullable();
            $table->foreignId('penyuluh_id')->constrained('penyuluhs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('wkpps');
    }
}
