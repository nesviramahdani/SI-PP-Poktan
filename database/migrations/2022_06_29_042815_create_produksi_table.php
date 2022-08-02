<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_produksi')->unique();
            $table->string('jumlah_produksi')->nullable();
            $table->string('luas_tanam')->nullable();
            $table->date('tanggal_produksi')->nullable();
            $table->foreignId('kelompoktani_id')->constrained('kelompoktani')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('komoditas_id')->constrained('komoditas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('produksi');
    }
}
