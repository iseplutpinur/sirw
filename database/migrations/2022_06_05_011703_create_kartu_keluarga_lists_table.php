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
        Schema::create('kartu_keluarga_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('warga_id', false, true)->nullable()->default(null);
            $table->bigInteger('kartu_keluarga_id', false, true)->nullable()->default(null);
            $table->bigInteger('hubungan_dengan_kk_id', false, true)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('warga_id')
                ->references('id')->on('wargas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('kartu_keluarga_id')
                ->references('id')->on('kartu_keluargas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('hubungan_dengan_kk_id')
                ->references('id')->on('hubungan_dengan_k_k_s')
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
        Schema::dropIfExists('kartu_keluarga_lists');
    }
};
