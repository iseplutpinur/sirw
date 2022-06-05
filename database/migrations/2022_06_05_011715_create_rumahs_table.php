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
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pemilik_id', false, true)->nullable()->default(null);
            $table->string('no_rumah')->nullable()->default(null);
            $table->integer('jumlah_jamban')->nullable()->default(null);
            $table->text('alamat_lengkap')->nullable()->default(null);
            $table->text('alamat_singkat')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('pemilik_id')
                ->references('id')->on('penduduks')
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
        Schema::dropIfExists('rumahs');
    }
};
