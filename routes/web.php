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

// penduduk detail
use \App\Http\Controllers\Admin\Kependudukan\Detail\AgamaController as DetailAgamaController;
use \App\Http\Controllers\Admin\Kependudukan\Detail\PekerjaanController as DetailPekerjaanController;
use \App\Http\Controllers\Admin\Kependudukan\Detail\PendidikanController as DetailPendidikanController;
use \App\Http\Controllers\Admin\Kependudukan\Detail\StatusKawinController as DetailStatusKawinController;
use \App\Http\Controllers\Admin\Kependudukan\Detail\StatusPendudukController as DetailStatusPendudukController;



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
$name = 'admin';
Route::group(['prefix' => $name, 'middleware' => ['auth:sanctum', 'verified', 'admin']], function () use ($name) {
    Route::get('/', [AdminDashboardController::class, 'index'])->name("admin.dashboard");
    // user
    $prefix = 'user';
    Route::controller(UserController::class)->prefix($prefix)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix";
        Route::get('/', 'index')->name($name);
        Route::get('/excel', 'excel')->name("$name.excel");
        Route::post('/', 'store')->name("$name.store");
        Route::delete('/{id}', 'delete')->name("$name.delete");
        Route::post('/update', 'update')->name("$name.update");
    });

    // data master
    // ================================================================================================================
    $prefix = 'data_master';
    Route::prefix($prefix)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // admin.data_master
        foreach ([
            ['prefix' => 'agama', 'class' => AgamaController::class],
            ['prefix' => 'pekerjaan', 'class' => PekerjaanController::class],
            ['prefix' => 'pendidikan', 'class' => PendidikanController::class],
            ['prefix' => 'status_kawin', 'class' => StatusKawinController::class],
            ['prefix' => 'status_penduduk', 'class' => StatusPendudukController::class],
            ['prefix' => 'status_tamu', 'class' => StatusTamuController::class],
            ['prefix' => 'hubungan_dengan_kk', 'class' => HubunganDenganKKController::class],
            ['prefix' => 'rukun_tetangga', 'class' => RukunTetanggaController::class],
        ] as $master) {
            $prefix = $master['prefix'];
            Route::controller($master['class'])->prefix($prefix)->group(function () use ($name, $prefix) {
                $name = "$name.$prefix"; // admin.data_master.agama
                Route::get('/',  'index')->name($name); // page
                Route::post('/',  'insert')->name("$name.insert");
                Route::delete('/{model}',  'delete')->name("$name.delete");
                Route::post('/update',  'update')->name("$name.update");
                Route::get('/select2',  'select2')->name("$name.select2");
            });
        }
    });
    // ================================================================================================================


    // data Kependudukan
    $prefix = 'kependudukan';
    Route::prefix($prefix)->group(function () use ($name, $prefix) {
        $name = "$name.$prefix"; // admin.kependudukan

        // penduduk
        $prefix = 'penduduk';
        Route::controller(PendudukController::class)->prefix($prefix)->group(function () use ($name, $prefix) {
            $name = "$name.$prefix"; // admin.kependudukan.penduduk

            Route::get('/',  'index')->name($name); // page
            Route::post('/',  'insert')->name("$name.insert"); // insert

            Route::get('/find/{model}',  'getById')->name("$name.find");
            Route::delete('/{model}',  'delete')->name("$name.delete");
            Route::post('/update',  'update')->name("$name.update");
            Route::get('/select2',  'select2')->name("$name.select2");


            // detail
            Route::get('/detail/{model}',  'detail')->name("$name.detail"); // page
            Route::post('/detail/update/{model}',  'update')->name("$name.detail.update"); // update
            // set data master
            $prefix = 'detail';
            Route::prefix($prefix)->group(function () use ($name, $prefix) {
                $name = "$name.$prefix"; // admin.kependudukan.penduduk.detail

                foreach ([
                    ['prefix' => 'agama', 'class' => DetailAgamaController::class],
                    ['prefix' => 'pekerjaan', 'class' => DetailPekerjaanController::class],
                    ['prefix' => 'pendidikan', 'class' => DetailPendidikanController::class],
                    ['prefix' => 'status_kawin', 'class' => DetailStatusKawinController::class],
                    ['prefix' => 'status_penduduk', 'class' => DetailStatusPendudukController::class],
                ] as $master) {
                    $prefix = $master['prefix'];
                    Route::controller($master['class'])->prefix($prefix)->group(function () use ($name, $prefix) {
                        $name = "$name.$prefix";
                        Route::get('/all', 'all')->name($name);
                        Route::get('/find', 'find')->name("$name.find");
                        Route::get('/refresh', 'refresh')->name("$name.refresh");
                        Route::post('/insert', 'insert')->name("$name.insert");
                        Route::post('/update', 'update')->name("$name.update");
                        Route::delete('/{model}', 'delete')->name("$name.update");
                    });
                }
            });
        });

        // kk
        $prefix = 'kk';
        Route::controller(KartuKeluargaController::class)->prefix($prefix)->group(function () use ($name, $prefix) {
            $name = "$name.$prefix"; // admin.kependudukan.kk

            Route::get('/',  'index')->name($name); // page
            Route::post('/',  'insert')->name("$name.insert");
            Route::delete('/{model}',  'delete')->name("$name.delete");
            Route::post('/update',  'update')->name("$name.update");
            Route::get('/find/{model}',  'getById')->name("$name.find");

            // kk anggota
            $prefix = 'anggota';
            Route::prefix('anggota')->group(function () use ($name, $prefix) {
                $name = "$name.$prefix"; // admin.kependudukan.kk.anggota

                Route::get('/select2',  'anggota_select2')->name("$name.select2");
                Route::post('/',  'anggota_insert')->name("$name.insert");
                Route::get('/list',  'anggota_list')->name("$name.list");
                Route::delete('/{model}',  'anggota_delete')->name("$name.delete");
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
