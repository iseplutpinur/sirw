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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable()->default(null);
            $table->bigInteger('rt_id', false, true)->nullable()->default(null);
            $table->bigInteger('tamu_ke_penduduk_id', false, true)->nullable()->default(null);
            $table->string('nama')->nullable()->default(null);
            $table->string('kota_lahir')->nullable()->default(null);
            $table->text('tanggal_lahir')->nullable()->default(null);
            $table->string('jenis_kelamin')->nullable()->default(null);

            $table->bigInteger('master_status_kawin_id', false, true)->nullable()->default(null);
            $table->bigInteger('master_status_penduduk_id', false, true)->nullable()->default(null);
            $table->bigInteger('status_tamu_id', false, true)->nullable()->default(null);

            $table->text('alamat_lengkap')->nullable()->default(null);
            $table->dateTime('datang')->nullable()->default(null);
            $table->dateTime('pergi')->nullable()->default(null);



            $table->foreign('rt_id')
                ->references('id')->on('master_rukun_tetangga')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('tamu_ke_penduduk_id')
                ->references('id')->on('penduduks')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('status_tamu_id')
                ->references('id')->on('master_status_tamu')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('master_status_kawin_id')
                ->references('id')->on('master_status_kawin')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('master_status_penduduk_id')
                ->references('id')->on('master_status_penduduk')
                ->nullOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('tamus');
    }
};
