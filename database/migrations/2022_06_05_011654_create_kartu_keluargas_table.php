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
            $table->integer('no')->nullable()->default(null);
            $table->text('alamat')->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('kepala_keluarga', false, true)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('kepala_keluarga')
                ->references('id')->on('wargas')
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
        Schema::dropIfExists('kartu_keluargas');
    }
};
