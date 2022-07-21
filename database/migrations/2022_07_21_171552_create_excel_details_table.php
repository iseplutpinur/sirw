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
        Schema::create('excel_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('excel_id', false, true)->nullable()->default(null);
            $table->boolean('status')->nullable()->default(1)->comment('0 failed, 1 success, 2 delete');
            $table->text('data')->nullable()->default(null);
            $table->text('catatan')->nullable()->default(null);
            $table->text('history')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('excel_id')
                ->references('id')->on('excels')
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
        Schema::dropIfExists('excel_details');
    }
};
