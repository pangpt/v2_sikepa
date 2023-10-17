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
        Schema::create('activity_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performance_indicator_id');
            $table->string('kegiatan')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('angka_kredit_target')->nullable();
            $table->integer('kuant_target')->nullable();
            $table->string('satuan_target')->nullable();
            $table->integer('kual_target')->nullable();
            $table->integer('angka_kredit_realisasi')->nullable();
            $table->integer('kuant_realisasi')->nullable();
            $table->string('satuan_realisasi')->nullable();
            $table->integer('kual_realisasi')->nullable();
            $table->integer('nilai_capaian')->nullable();
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
        Schema::dropIfExists('activity_items');
    }
};
