<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailkegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailkegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('id_detailkegiatan')->nullable();
            $table->foreignId('kelompoktani_id')->constrained('kelompoktani')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status')->default('0');
            $table->string('peserta')->nullable();
            $table->text('hasil')->nullable();
            $table->string('dokumentasi')->nullable();
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
        Schema::dropIfExists('detailkegiatan');
    }
}
