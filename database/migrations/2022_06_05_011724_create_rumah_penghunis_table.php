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
        Schema::create('rumah_penghunis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('warga_id', false, true)->nullable()->default(null);
            $table->bigInteger('rumah_id', false, true)->nullable()->default(null);
            $table->timestamps();
            $table->foreign('warga_id')
                ->references('id')->on('wargas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('rumah_id')
                ->references('id')->on('rumahs')
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
        Schema::dropIfExists('rumah_penghunis');
    }
};
