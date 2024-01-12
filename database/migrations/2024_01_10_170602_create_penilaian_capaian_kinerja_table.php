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
        Schema::create('penilaian_capaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_kinerja_id');
            $table->unsignedBigInteger('periode_pck_id');
            $table->integer('total_capaian')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('penilaian_capaian_kinerja');
    }
};
