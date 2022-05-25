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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 6)->nullable()->default(null);
            $table->date('tggl_lahir')->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->text('alamat_lengkap')->nullable()->default(null);
            $table->integer('rt_id')->nullable()->default(null);
            $table->string('agama')->nullable()->default(null);
            $table->boolean('status_perkawinan')->nullable()->default(null);
            $table->string('pendidikan')->nullable()->default(null);
            $table->string('pekerjaan')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);
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
        Schema::dropIfExists('wargas');
    }
};
