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
use App\Http\Controllers\Admin\DataMaster\AgamaController;
// ====================================================================================================================
// Frontend ===========================================================================================================
use App\Http\Controllers\Frontend\HomeController;

// auth ===============================================================================================================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'check_login')->name('login.check_login');
    Route::get('/logout', 'logout')->name('login.logout');
});
// ====================================================================================================================

// home default =======================================================================================================
Route::controller(HomeController::class)->group(function () {
    // Route::get('/', 'index')->name('home');
    Route::get('/', 'index1')->name('home');
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
    // ====================================================================================================================
    Route::prefix('data_master')->group(function () {
        // agama
        Route::controller(AgamaController::class)->prefix('agama')->group(function () {
            Route::get('/',  'index')->name('admin.data_master.agama'); // page
            Route::post('/',  'insert')->name('admin.data_master.agama.insert');
            Route::delete('/{model}',  'delete')->name('admin.data_master.agama.delete');
            Route::post('/update',  'update')->name('admin.data_master.agama.update');
            Route::get('/select2',  'select2')->name('admin.data_master.agama.select2');
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
