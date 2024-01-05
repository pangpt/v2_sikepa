<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjanjian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_kinerja_id');
            $table->string('sasaran_kegiatan');
            $table->string('indikator');
            $table->string('satuan');
            $table->integer('target_kuantitas');
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
        Schema::dropIfExists('perjanjian_kinerja');
    }
};
