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
        Schema::create('capaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_kinerja_id');
            $table->unsignedBigInteger('perjanjian_kinerja_id');
            $table->unsignedBigInteger('indikator_pkp_id');
            $table->unsignedBigInteger('indikator_pck_id');
            $table->string('periode_pck_id');
            $table->integer('target_output');
            $table->integer('target_mutu');
            $table->integer('realisasi_output');
            $table->integer('realisasi_mutu');
            $table->integer('nilai_capaian');
            $table->string('bukti_dukung');
            $table->integer('status_pck');
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
        Schema::dropIfExists('capaian_kinerja');
    }
};
