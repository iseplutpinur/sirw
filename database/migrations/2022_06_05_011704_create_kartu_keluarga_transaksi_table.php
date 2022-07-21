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
        Schema::create('kartu_keluarga_transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kartu_keluarga_id', false, true)->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->text('keterangan')->nullable()->default(null);
            $table->date('tanggal')->nullable()->default(null);
            $table->boolean('jenis')->nullable()->default(0)->comment('1 pindah, 2 datang');
            $table->timestamps();

            $table->foreign('kartu_keluarga_id')
                ->references('id')->on('kartu_keluargas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rt_id')
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
        Schema::dropIfExists('kartu_keluarga_transaksi');
    }
};
