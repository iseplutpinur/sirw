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
        Schema::create('excel_penduduk_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('excel_id', false, true)->nullable()->default(null);
            $table->bigInteger('excel_detail_id', false, true)->nullable()->default(null);
            $table->bigInteger('penduduk_id', false, true)->nullable()->default(null);
            $table->boolean('status')->nullable()->default(1)->comment('0 failed, 1 success, 2 delete');
            $table->timestamps();

            $table->foreign('excel_id')
                ->references('id')->on('excels')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('excel_detail_id')
                ->references('id')->on('excel_details')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('penduduk_id')
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
        Schema::dropIfExists('excel_penduduk_lists');
    }
};
