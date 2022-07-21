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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable()->default(null);
            $table->string('nik', 16)->nullable()->default(null);
            $table->string('kota_lahir')->nullable()->default(null);
            $table->string('jenis_kelamin')->nullable()->default(null);
            $table->string('no_hp')->nullable()->default(null);
            $table->text('alamat_lengkap')->nullable()->default(null);

            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->date('tanggal_mati')->nullable()->default(null);

            // $table->boolean('status')->nullable()->default(1)->comment('0 Tidak ada di lingkungan rw, 1 ada di lingkungan rw');
            $table->boolean('asal_data')->nullable()->default(0)->comment('0 kelahiran, 1 kedatangan');
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
        Schema::dropIfExists('penduduks');
    }
};
