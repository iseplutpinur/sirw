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
        Schema::create('penduduk_ktp', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->boolean('status')->nullable()->default(1)->comment('0 tidak ada, 1 ada');
            $table->string('foto')->nullable()->default(null);
            $table->date('dari')->nullable()->default(null);
            $table->date('sampai')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('penduduk_id')
                ->references('id')->on('penduduks')
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
        Schema::dropIfExists('penduduk_ktp');
    }
};
