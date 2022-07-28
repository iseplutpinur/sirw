<?php

use App\Http\Controllers\API\Admin\Address\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

// ====================================================================================================================
// Admin ==============================================================================================================
use App\Http\Controllers\API\Admin\DashboardController as AdminDashboardController;

// Data Master
use App\Http\Controllers\API\Admin\DataMaster\AgamaController;
use App\Http\Controllers\API\Admin\DataMaster\HubunganDenganKKController;
use App\Http\Controllers\API\Admin\DataMaster\PekerjaanController;
use App\Http\Controllers\API\Admin\DataMaster\PendidikanController;
use App\Http\Controllers\API\Admin\DataMaster\RukunTetanggaController;
use App\Http\Controllers\API\Admin\DataMaster\StatusKawinController;
use App\Http\Controllers\API\Admin\DataMaster\StatusPendudukController;
use App\Http\Controllers\API\Admin\DataMaster\StatusTamuController;

// kependudukan
use App\Http\Controllers\API\Admin\Kependudukan\KartuKeluargaController;
use App\Http\Controllers\API\Admin\Kependudukan\PendudukController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('tes/user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['prefix' => 'public'], function () {
    Route::get('/province', [ProvinceController::class, 'get'])->name('api.public.province');
});


// Admin route ========================================================================================================
$name = 'admin';
$prefix = "api.$name"; // api.admin
Route::group(['prefix' => $name, 'middleware' => ['auth:sanctum', 'verified', 'admin']], function () use ($prefix) {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // user
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('admin.user');
        Route::get('/excel', 'excel')->name('admin.user.excel');
        Route::post('/', 'store')->name('admin.user.store');
        Route::delete('/{id}', 'delete')->name('admin.user.delete');
        Route::post('/update', 'update')->name('admin.user.update');
    });

    // data master
    // ================================================================================================================
    $name = 'data_master';
    $prefix = "$prefix.$name"; // admin.data_master
    Route::prefix($name)->group(function () use ($prefix) {
        $name = 'agama';
        $prefix = "$prefix.$name"; // admin.data_master.agama
        Route::controller(AgamaController::class)->prefix($name)->group(function () use ($prefix) {
            Route::get('/',  'index')->name($prefix); // page
            Route::post('/',  'insert')->name("$prefix.insert");
            Route::delete('/{model}',  'delete')->name("$prefix.delete");
            Route::post('/update',  'update')->name("$prefix.update");
            Route::get('/select2',  'select2')->name("$prefix.select2");
        });
        // pekerjaan
        Route::controller(PekerjaanController::class)->prefix('pekerjaan')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.pekerjaan'); // page
            Route::post('/',  'insert')->name('admin.data_master.pekerjaan.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.pekerjaan.delete');
            Route::post('/update',  'update')->name('admin.data_master.pekerjaan.update');
            Route::get('/select2',  'select2')->name('admin.data_master.pekerjaan.select2');
        });
        // pendidikan
        Route::controller(PendidikanController::class)->prefix('pendidikan')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.pendidikan'); // page
            Route::post('/',  'insert')->name('admin.data_master.pendidikan.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.pendidikan.delete');
            Route::post('/update',  'update')->name('admin.data_master.pendidikan.update');
            Route::get('/select2',  'select2')->name('admin.data_master.pendidikan.select2');
        });
        // status_kawin
        Route::controller(StatusKawinController::class)->prefix('status_kawin')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.status_kawin'); // page
            Route::post('/',  'insert')->name('admin.data_master.status_kawin.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.status_kawin.delete');
            Route::post('/update',  'update')->name('admin.data_master.status_kawin.update');
            Route::get('/select2',  'select2')->name('admin.data_master.status_kawin.select2');
        });
        // status_penduduk
        Route::controller(StatusPendudukController::class)->prefix('status_penduduk')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.status_penduduk'); // page
            Route::post('/',  'insert')->name('admin.data_master.status_penduduk.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.status_penduduk.delete');
            Route::post('/update',  'update')->name('admin.data_master.status_penduduk.update');
            Route::get('/select2',  'select2')->name('admin.data_master.status_penduduk.select2');
        });
        // status_tamu
        Route::controller(StatusTamuController::class)->prefix('status_tamu')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.status_tamu'); // page
            Route::post('/',  'insert')->name('admin.data_master.status_tamu.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.status_tamu.delete');
            Route::post('/update',  'update')->name('admin.data_master.status_tamu.update');
            Route::get('/select2',  'select2')->name('admin.data_master.status_tamu.select2');
        });
        // hubungan_dengan_kk
        Route::controller(HubunganDenganKKController::class)->prefix('hubungan_dengan_kk')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.hubungan_dengan_kk'); // page
            Route::post('/',  'insert')->name('admin.data_master.hubungan_dengan_kk.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.hubungan_dengan_kk.delete');
            Route::post('/update',  'update')->name('admin.data_master.hubungan_dengan_kk.update');
            Route::get('/select2',  'select2')->name('admin.data_master.hubungan_dengan_kk.select2');
        });
        // rukun_tetangga
        Route::controller(RukunTetanggaController::class)->prefix('rukun_tetangga')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.rukun_tetangga'); // page
            Route::post('/',  'insert')->name('admin.data_master.rukun_tetangga.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.rukun_tetangga.delete');
            Route::post('/update',  'update')->name('admin.data_master.rukun_tetangga.update');
            Route::get('/select2',  'select2')->name('admin.data_master.rukun_tetangga.select2');
        });
    });
    // ================================================================================================================


    $name = 'kependudukan';
    $prefix = "$prefix.$name"; // api.admin.kependudukan.kependudukan
    Route::prefix($name)->group(function () use ($prefix) {

        $name = 'penduduk';
        $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk
        Route::controller(PendudukController::class)->prefix($name)->group(function () use ($prefix) {
            Route::post('/',  'insert')->name("$prefix.insert");
            Route::post('/import',  'import_excel')->name("$prefix.import");
            Route::get('/datatable',  'datatable')->name("$prefix.datatable");

            $name = 'detail';
            $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail
            Route::prefix($name)->group(function () use ($prefix) {

                $name = 'agama';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.agama
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\AgamaController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'pendidikan';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.pendidikan
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\PendidikanController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'pekerjaan';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.pekerjaan
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\PekerjaanController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'status_kawin';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.status_kawin
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\StatusKawinController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'status_penduduk';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.status_penduduk
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\StatusPendudukController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'rt';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.rt
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\RtController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'ktp';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.ktp
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\KtpController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'akte';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.akte
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\AkteController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'negara';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.negara
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\NegaraController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::get('/refresh', 'refresh')->name("$prefix.refresh");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });

                $name = 'transaksi';
                $prefix = "$prefix.$name"; // api.admin.kependudukan.penduduk.detail.transaksi
                Route::controller(\App\Http\Controllers\API\Admin\Kependudukan\Detail\TransaksiController::class)->prefix($name)->group(function () use ($prefix) {
                    Route::get('/', 'index')->name($prefix);
                    Route::get('/find', 'find')->name("$prefix.find");
                    Route::post('/', 'insert')->name("$prefix.insert");
                    Route::post('/update', 'update')->name("$prefix.update");
                    Route::delete('/{model}', 'delete')->name("$prefix.update");
                });
            });
        });


        Route::controller(KartuKeluargaController::class)->prefix('kk')->group(function () {
            Route::post('/',  'insert')->name('admin.kependudukan.kk.insert');
            Route::get('/datatable',  'datatable')->name('admin.kependudukan.kk.datatable');

            // kk anggota
            Route::prefix('anggota')->group(function () {
                Route::get('/select2',  'anggota_select2')->name('admin.kependudukan.kk.anggota.select2');
                Route::post('/',  'anggota_insert')->name('admin.kependudukan.kk.anggota.insert');
                Route::get('/list',  'anggota_list')->name('admin.kependudukan.kk.anggota.list');
                Route::delete('/{model}',  'anggota_delete')->name('admin.kependudukan.kk.anggota.delete');
            });
        });
    });
    // ====================================================================================================================
});
// ====================================================================================================================
