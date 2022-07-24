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
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('no', 16)->nullable()->default(null);
            $table->text('alamat_lengkap')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);

            $table->date('tanggal_dibuat')->nullable()->default(null);
            $table->date('tanggal_hapus')->nullable()->default(null);

            // $table->boolean('status')->nullable()->default(1)->comment('0 Tidak ada di lingkungan rw, 1 ada di lingkungan rw');
            $table->boolean('asal_data')->nullable()->default(0)->comment('0 dibuat disini, 1 kedatangan');
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
        Schema::dropIfExists('kartu_keluargas');
    }
};
