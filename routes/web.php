<?php

// ====================================================================================================================
use App\Models\User;

// ====================================================================================================================
// utility ============================================================================================================
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Controller =========================================================================================================
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LoaderController;

// ====================================================================================================================
// Admin ==============================================================================================================
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Data Master
use App\Http\Controllers\Admin\DataMaster\AgamaController;
use App\Http\Controllers\Admin\DataMaster\HubunganDenganKKController;
use App\Http\Controllers\Admin\DataMaster\PekerjaanController;
use App\Http\Controllers\Admin\DataMaster\PendidikanController;
use App\Http\Controllers\Admin\DataMaster\RukunTetanggaController;
use App\Http\Controllers\Admin\DataMaster\StatusKawinController;
use App\Http\Controllers\Admin\DataMaster\StatusPendudukController;
use App\Http\Controllers\Admin\DataMaster\StatusTamuController;

// kependudukan
use App\Http\Controllers\Admin\Kependudukan\KartuKeluargaController;
use App\Http\Controllers\Admin\Kependudukan\PendudukController;




// ====================================================================================================================
// Frontend ===========================================================================================================
use App\Http\Controllers\Frontend\HomeController;

// home default =======================================================================================================
Route::controller(HomeController::class)->group(function () {
    Route::get('/2', 'index')->name('home2');
    Route::get('/', 'index2')->name('home');
});
// ====================================================================================================================


// auth ===============================================================================================================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'check_login')->name('login.check_login');
    Route::get('/logout', 'logout')->name('login.logout');
});
// ====================================================================================================================


// dashboard ==========================================================================================================
Route::get('/dashboard', function () {
    $user = Auth::user();
    $role = isset($user->role) ? $user->role : null;
    switch ($role) {
        case User::ROLE_ADMINISTRATOR:
            return Redirect::route('admin.dashboard');
            break;

        default:
            return view('auth.login');
            break;
    }
})->name('dashboard');
// ====================================================================================================================





// Admin route ========================================================================================================
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'verified', 'admin']], function () {
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
    Route::prefix('data_master')->group(function () {
        // agama
        Route::controller(AgamaController::class)->prefix('agama')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.agama'); // page
            Route::post('/',  'insert')->name('admin.data_master.agama.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.agama.delete');
            Route::post('/update',  'update')->name('admin.data_master.agama.update');
            Route::get('/select2',  'select2')->name('admin.data_master.agama.select2');
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


    // data Kependudukan
    Route::prefix('kependudukan')->group(function () {
        // penduduk
        Route::controller(PendudukController::class)->prefix('penduduk')->group(function () {
            Route::get('/',  'index')->name('admin.kependudukan.penduduk'); // page
            Route::post('/',  'insert')->name('admin.kependudukan.penduduk.insert'); // insert
            Route::get('/detail/{model}',  'detail')->name('admin.kependudukan.penduduk.detail'); // page

            // detail
            Route::get('/find/{model}',  'getById')->name('admin.kependudukan.penduduk.find');
            Route::delete('/{model}',  'delete')->name('admin.kependudukan.penduduk.delete');
            Route::post('/update',  'update')->name('admin.kependudukan.penduduk.update');
            Route::get('/select2',  'select2')->name('admin.kependudukan.penduduk.select2');
        });
        Route::controller(KartuKeluargaController::class)->prefix('kk')->group(function () {
            Route::get('/',  'index')->name('admin.kependudukan.kk'); // page
            Route::post('/',  'insert')->name('admin.kependudukan.kk.insert');
            Route::delete('/{model}',  'delete')->name('admin.kependudukan.kk.delete');
            Route::post('/update',  'update')->name('admin.kependudukan.kk.update');
            Route::get('/find/{model}',  'getById')->name('admin.kependudukan.kk.find');

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




Route::controller(UserController::class)->prefix('password')->group(function () {
    Route::get('/',  'change_password')->name('member.password'); // page
    Route::post('/save',  'save_password')->name('member.password.save');
});
// ====================================================================================================================




// Utility ============================================================================================================
Route::controller(LoaderController::class)->prefix('loader')->group(function () {
    Route::prefix('js')->group(function () {
        Route::get('/{file}.js', 'js')->name('load_js');
        Route::get('/{f}/{file}.js', 'js_f')->name('load_js_a');
        Route::get('/{f}/{f_a}/{file}.js', 'js_a')->name('load_js_b');
        Route::get('/{f}/{f_a}/{f_b}/{file}.js', 'js_b')->name('load_js_b');
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{file}.js', 'js_c')->name('load_js_c');
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{f_d}/{file}.js', 'js_d')->name('load_js_d');
    });
});
// ====================================================================================================================




// laboartorium =======================================================================================================
Route::controller(LabController::class)->prefix('lab')->group(function () {
    Route::get('/phpspreadsheet', 'phpspreadsheet')->name('lab.phpspreadsheet');
    Route::get('/javascript', 'javascript')->name('lab.javascript');
    Route::get('/jstes', 'jstes')->name('lab.jstes');
});
// ====================================================================================================================




// // profile username ===================================================================================================
// Route::get('/{model:username}', [MemberController::class, 'member'])->name('anggota.username');
