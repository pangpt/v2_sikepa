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
        Schema::create('satker_information', function (Blueprint $table) {
            $table->id();
            $table->string('nama_satker');
            $table->string('alamat_satker')->nullable();
            $table->string('phone_satker')->nullable();
            $table->string('pimpinan_satker');
            $table->string('website_satker')->nullable();
            $table->string('wilayah_satker')->nullable();
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
      Schema::dropIfExists('satker_information');
    }
};
