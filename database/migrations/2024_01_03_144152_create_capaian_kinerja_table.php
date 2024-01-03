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
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('indikator_pkp_id');
            $table->unsignedBigInteger('indikator_pck_id');
            $table->string('periode_bulan');
            $table->string('periode_tahun');
            $table->string('kegiatan_tugas');
            $table->integer('target_output');
            $table->integer('target_mutu');
            $table->integer('realisasi_output');
            $table->integer('realisasi_mutu');
            $table->integer('nilai_capaian');
            $table->string('bukti_dukung');
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
