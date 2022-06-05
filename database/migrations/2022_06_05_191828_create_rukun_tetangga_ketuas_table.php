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
        Schema::create('rukun_tetangga_ketuas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('warga_id', false, true)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('rt_id')
                ->references('id')->on('rukun_tetanggas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('warga_id')
                ->references('id')->on('wargas')
                ->cascadeOnDelete()
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
        Schema::dropIfExists('rukun_tetangga_ketuas');
    }
};
