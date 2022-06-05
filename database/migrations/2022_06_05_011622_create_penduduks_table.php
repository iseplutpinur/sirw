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
            $table->string('nik', 16)->nullable()->default(null);

            // data master
            $table->bigInteger('agama_id', false, true)->nullable()->default(null);
            $table->bigInteger('pendidikan_id', false, true)->nullable()->default(null);
            $table->bigInteger('pekerjaan_id', false, true)->nullable()->default(null);
            $table->bigInteger('status_kawin_id', false, true)->nullable()->default(null);
            $table->bigInteger('status_penduduk_id', false, true)->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);

            $table->string('nama')->nullable()->default(null);
            $table->string('kota_lahir')->nullable()->default(null);
            $table->string('jenis_kelamin')->nullable()->default(null);
            $table->boolean('ada_ktp')->nullable()->default(null);
            $table->boolean('ada_akte')->nullable()->default(null);
            $table->string('file_ktp')->nullable()->default(null);
            $table->string('file_akte')->nullable()->default(null);
            $table->text('alamat_lengkap')->nullable()->default(null);

            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->date('tanggal_mati')->nullable()->default(null);
            $table->date('tanggal_pindah')->nullable()->default(null);
            $table->date('tanggal_datang')->nullable()->default(null);

            $table->boolean('status_tinggal')->nullable()->default(1)->comment('1 lahir, 2 mati, 3 pindah, 4 datang');
            $table->boolean('status')->nullable()->default(1)->comment('0 bukan penduduk setempat, 1 penduduk setempat');

            $table->boolean('penduduk_negara')->nullable()->default(1)->comment('0 wna, 1 wni');
            $table->string('negara_asal')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('agama_id')
                ->references('id')->on('agamas')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('pendidikan_id')
                ->references('id')->on('pendidikans')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('pekerjaan_id')
                ->references('id')->on('pekerjaans')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('status_kawin_id')
                ->references('id')->on('status_kawins')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('status_penduduk_id')
                ->references('id')->on('status_penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rt_id')
                ->references('id')->on('rukun_tetanggas')
                ->nullOnDelete()
                ->cascadeOnUpdate();
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
