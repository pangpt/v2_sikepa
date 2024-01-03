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
        Schema::create('penilaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_pkp_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('satuan');
            $table->integer('target_kuantitas');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
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
        Schema::dropIfExists('penilaian_kinerja');
    }
};
