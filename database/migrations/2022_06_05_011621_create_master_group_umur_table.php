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
        Schema::create('master_group_umur', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable()->default(1)->comment('0 tidak dipakai, 1 dipakai');
            $table->string('nama')->nullable()->default(null);
            $table->text('deskripsi')->nullable()->default(null);
            $table->integer('dari')->nullable()->default(null);
            $table->integer('sampai')->nullable()->default(null);
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
        Schema::dropIfExists('master_group_umur');
    }
};
