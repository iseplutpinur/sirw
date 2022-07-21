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
        Schema::create('penduduk_pindah_konfirmasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->bigInteger('dari_rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('ke_rt_id', false, true)->nullable()->default(null);
            $table->boolean('status')->nullable()->default(0)->comment('0 pengajuan, 1 setujui, 2 ditolak');
            $table->text('keterangan')->nullable()->default(null);
            $table->date('tanggal_pengajuan')->nullable()->default(null);
            $table->date('tanggal_konfirmasi')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('penduduk_id')
                ->references('id')->on('penduduks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('dari_rt_id')
                ->references('id')->on('master_rukun_tetangga')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('ke_rt_id')
                ->references('id')->on('master_rukun_tetangga')
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
        Schema::dropIfExists('penduduk_pindah_konfirmasi');
    }
};
