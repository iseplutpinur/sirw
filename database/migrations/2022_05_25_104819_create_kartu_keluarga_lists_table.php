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
            $table->integer('kk_id');
            $table->integer('warga_id');

            $table->string('status_hubungan');
            $table->string('ayah')->nullable()->default(null);
            $table->integer('ayah_id')->nullable()->default(null);
            $table->string('ibu')->nullable()->default(null);
            $table->integer('ibu_id')->nullable()->default(null);
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
        Schema::dropIfExists('kartu_keluarga_lists');
    }
};
