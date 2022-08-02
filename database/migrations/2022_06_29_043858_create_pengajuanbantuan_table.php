<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanbantuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuanbantuan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengajuan')->unique();
            $table->string('proposal');
            $table->text('keterangan');
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('pengajuanbantuan');
    }
}
