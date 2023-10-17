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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('atasan_id');
            $table->string('jenis_cuti');
            $table->text('alasan');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->integer('jumlah_hari');
            $table->text('alamat_cuti');
            $table->string('phone_cuti');
            $table->string('pimpinan');
            $table->string('lampiran')->nullable();
            $table->integer('status_permohonan')->nullable();
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
      Schema::dropIfExists('leaves');
    }
};
