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
        Schema::create('hubungan_dengan_k_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable()->default(null);
            $table->string('singkatan')->nullable()->default(null);
            $table->string('keterangan')->nullable()->default(null);
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
        Schema::dropIfExists('hubungan_dengan_k_k_s');
    }
};
