<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\Admin\GasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Supir\ScanController;
use App\Http\Controllers\Admin\SopirController;
use App\Http\Controllers\Admin\RelasiController;

use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TipeGasController;
use App\Http\Controllers\User1\HomeUser1Controller;
use App\Http\Controllers\User2\HomeUser2Controller;
use App\Http\Controllers\User3\HomeUser3Controller;
use App\Http\Controllers\Admin1\HomeAdmin1Controller;
use App\Http\Controllers\Admin2\HomeAdmin2Controller;
use App\Http\Controllers\Admin3\HomeAdmin3Controller;
use App\Http\Controllers\Admin\SearchBarcodeController;
use App\Http\Controllers\SuperAdmin\HakAksesController;
use App\Http\Controllers\SuperAdmin\KaryawanController;
use App\Http\Controllers\SuperAdmin\SuratMasukController;
use App\Http\Controllers\User2\SuratMasukUser2Controller;
use App\Http\Controllers\User3\SuratMasukUser3Controller;
use App\Http\Controllers\SuperAdmin\SuratKeluarController;
use App\Http\Controllers\Admin1\SuratMasukAdmin1Controller;
use App\Http\Controllers\Admin2\SuratMasukAdmin2Controller;
use App\Http\Controllers\Admin3\SuratMasukAdmin3Controller;
use App\Http\Controllers\SuperAdmin\HistoriSuratController;
use App\Http\Controllers\User1\HistoriSuratUser1Controller;
use App\Http\Controllers\SuperAdmin\JabatanBidangController;
use App\Http\Controllers\Admin1\HistoriSuratAdmin1Controller;
use App\Http\Controllers\Admin2\HistoriSuratAdmin2Controller;
use App\Http\Controllers\Admin3\HistoriSuratAdmin3Controller;
use App\Http\Controllers\SuperAdmin\HomeSuperAdminController;
use App\Http\Controllers\Admin1\DisposisiSayaAdmin1Controller;
use App\Http\Controllers\Admin2\DisposisiSayaAdmin2Controller;
use App\Http\Controllers\Supir\LaporanController as LaporanSupirController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('superadmin.home.index');
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('authlogin', function () {

        if(auth()->user()->jabatan_id == '1'){
            return redirect()->route('superadmin.home.index');
        }else if(auth()->user()->jabatan_id == '2'){
            return redirect()->route('admin1.home.index');
        }else if(auth()->user()->jabatan_id == '3'){
            return redirect()->route('admin2.home.index');
        }else if(auth()->user()->jabatan_id == '4'){
            return redirect()->route('admin3.home.index');
        }else if(auth()->user()->jabatan_id == '5'){
            return redirect()->route('user1.home.index');
        }else if(auth()->user()->jabatan_id == '6'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '7'){
            return redirect()->route('user3.home.index');
        }else if(auth()->user()->jabatan_id == '8'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '9'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '10'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '11'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '12'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '13'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '14'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '15'){
            return redirect()->route('user2.home.index');
        }else if(auth()->user()->jabatan_id == '16'){
            return redirect()->route('user2.home.index');
        }else {
            return redirect()->route('login');
        }
    });

    Route::group([
        'middleware' => 'role.admin'
    ], function () {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

            Route::resource('sopir', SopirController::class);
            Route::resource('gas', GasController::class);
            Route::resource('tipe-gas', TipeGasController::class);
            Route::resource('relasi', RelasiController::class);
            Route::resource('laporan', LaporanController::class);
            Route::resource('dashboard', DashboardController::class);
            Route::resource('searchbarcode', SearchBarcodeController::class);

        });

    });

    Route::group([
        'middleware' => 'role.supir'
    ], function () {

        Route::group(['prefix' => 'supir', 'as' => 'supir.'], function () {
            
            Route::resource('scan', ScanController::class);
            Route::resource('laporan', LaporanSupirController::class);
        });

    });

    //role superadmin
    Route::group([
        'middleware' => 'role.superadmin'
    ], function () {

        Route::group(['prefix' => 'superadmin', 'as' => 'superadmin.'], function () {
            
            Route::resource('home', HomeSuperAdminController::class);
            //hakakses
            Route::resource('hakakses', HakAksesController::class);
            //jabatanbidang
            Route::resource('jabatan', JabatanBidangController::class);
            //karyawan
            Route::resource('karyawan', KaryawanController::class);
            //suratmasuk
            Route::resource('suratmasuk', SuratMasukController::class);
            //suratkeluar
            Route::resource('suratkeluar', SuratKeluarController::class);
            Route::get('surat-masuk/detail', [SuratMasukController::class, 'detail_surat'])->name('suratmasuk.detail');
            //Histori Surat
            Route::resource('historisurat', HistoriSuratController::class);
            Route::get('histori-surat/detail', [HistoriSuratController::class, 'detail_surat'])->name('historisurat.detail');
           

        });

    });

    //role admin1
    Route::group([
        'middleware' => 'role.admin1'
    ], function () {

        Route::group(['prefix' => 'admin1', 'as' => 'admin1.'], function () {
            
            Route::resource('home', HomeAdmin1Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin1', SuratMasukAdmin1Controller::class);
            //HistoriSuratMasukAdmin3
            Route::resource('historisuratadmin1', HistoriSuratAdmin1Controller::class);
            Route::get('histori-suratadmin1/detail', [HistoriSuratAdmin1Controller::class, 'detail_surat'])->name('historisuratadmin1.detail');
            //DisposisiSayaadmin1
            Route::resource('disposisisayaadmin1', DisposisiSayaAdmin1Controller::class);
            Route::get('disposisi-sayaadmin1/detail', [DisposisiSayaAdmin1Controller::class, 'detail_surat'])->name('disposisisayaadmin1.detail');

        });

    });

    //role admin2
    Route::group([
        'middleware' => 'role.admin2'
    ], function () {

        Route::group(['prefix' => 'admin2', 'as' => 'admin2.'], function () {
            
            Route::resource('home', HomeAdmin2Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin2', SuratMasukAdmin2Controller::class);
            //HistoriSuratMasukAdmin3
            Route::resource('historisuratadmin2', HistoriSuratAdmin2Controller::class);
            Route::get('histori-suratadmin2/detail', [HistoriSuratAdmin2Controller::class, 'detail_surat'])->name('historisuratadmin2.detail');
            //DisposisiSayaadmin2
            Route::resource('disposisisayaadmin2', DisposisiSayaAdmin2Controller::class);
            Route::get('disposisi-sayaadmin2/detail', [DisposisiSayaAdmin2Controller::class, 'detail_surat'])->name('disposisisayaadmin2.detail');
        });

    });

    //role admin3
    Route::group([
        'middleware' => 'role.admin3'
    ], function () {

        Route::group(['prefix' => 'admin3', 'as' => 'admin3.'], function () {
            
            Route::resource('home', HomeAdmin3Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin3', SuratMasukAdmin3Controller::class);
            //HistoriSuratMasukAdmin3
            Route::resource('historisuratadmin3', HistoriSuratAdmin3Controller::class);
            Route::get('histori-suratadmin3/detail', [HistoriSuratAdmin3Controller::class, 'detail_surat'])->name('historisuratadmin3.detail');
        });

    });

    //role user1
    Route::group([
        'middleware' => 'role.user1'
    ], function () {

        Route::group(['prefix' => 'user1', 'as' => 'user1.'], function () {
            
            Route::resource('home', HomeUser1Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('historisuratuser1', HistoriSuratUser1Controller::class);
            Route::get('histori-suratuser1/detail', [HistoriSuratUser1Controller::class, 'detail_surat'])->name('historisuratuser1.detail');

        });

    });

    //role user2
    Route::group([
        'middleware' => 'role.user2'
    ], function () {

        Route::group(['prefix' => 'user2', 'as' => 'user2.'], function () {
            
            Route::resource('home', HomeUser2Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser2', SuratMasukUser2Controller::class);
            Route::get('surat-masukuser2/detail', [SuratMasukUser2Controller::class, 'detail_surat'])->name('suratmasukuser2.detail');
        });

    });

    //role user3
    Route::group([
        'middleware' => 'role.user3'
    ], function () {

        Route::group(['prefix' => 'user3', 'as' => 'user3.'], function () {
            
            Route::resource('home', HomeUser3Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser3', SuratMasukUser3Controller::class);
            Route::get('surat-masukuser3/detail', [SuratMasukUser3Controller::class, 'detail_surat'])->name('suratmasukuser3.detail');
        });

    });

    //role user4
    Route::group([
        'middleware' => 'role.user4'
    ], function () {

        Route::group(['prefix' => 'user4', 'as' => 'user4.'], function () {
            
            Route::resource('home', HomeUser4Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser4', SuratMasukUser4Controller::class);
            Route::get('surat-masukuser4/detail', [SuratMasukUser4Controller::class, 'detail_surat'])->name('suratmasukuser4.detail');
        });

    });

    //role user5
    Route::group([
        'middleware' => 'role.user5'
    ], function () {

        Route::group(['prefix' => 'user5', 'as' => 'user5.'], function () {
            
            Route::resource('home', HomeUser5Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser5', SuratMasukUser5Controller::class);
            Route::get('surat-masukuser5/detail', [SuratMasukUser5Controller::class, 'detail_surat'])->name('suratmasukuser5.detail');
        });

    });

    //role user6
    Route::group([
        'middleware' => 'role.user6'
    ], function () {

        Route::group(['prefix' => 'user6', 'as' => 'user6.'], function () {
            
            Route::resource('home', HomeUser6Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser6', SuratMasukUser6Controller::class);
            Route::get('surat-masukuser6/detail', [SuratMasukUser6Controller::class, 'detail_surat'])->name('suratmasukuser6.detail');
        });

    });

    //role user7
    Route::group([
        'middleware' => 'role.user7'
    ], function () {

        Route::group(['prefix' => 'user7', 'as' => 'user7.'], function () {
            
            Route::resource('home', HomeUser7Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser7', SuratMasukUser7Controller::class);
            Route::get('surat-masukuser7/detail', [SuratMasukUser7Controller::class, 'detail_surat'])->name('suratmasukuser7.detail');
        });

    });

    //role user8
    Route::group([
        'middleware' => 'role.user8'
    ], function () {

        Route::group(['prefix' => 'user8', 'as' => 'user8.'], function () {
            
            Route::resource('home', HomeUser8Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser8', SuratMasukUser8Controller::class);
            Route::get('surat-masukuser8/detail', [SuratMasukUser8Controller::class, 'detail_surat'])->name('suratmasukuser8.detail');
        });

    });

    //role user9
    Route::group([
        'middleware' => 'role.user9'
    ], function () {

        Route::group(['prefix' => 'user9', 'as' => 'user9.'], function () {
            
            Route::resource('home', HomeUser9Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser9', SuratMasukUser9Controller::class);
            Route::get('surat-masukuser9/detail', [SuratMasukUser9Controller::class, 'detail_surat'])->name('suratmasukuser9.detail');
        });

    });

    //role user10
    Route::group([
        'middleware' => 'role.user10'
    ], function () {

        Route::group(['prefix' => 'user10', 'as' => 'user10.'], function () {
            
            Route::resource('home', HomeUser10Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser10', SuratMasukUser10Controller::class);
            Route::get('surat-masukuser10/detail', [SuratMasukUser10Controller::class, 'detail_surat'])->name('suratmasukuser10.detail');
        });

    });

    //role user11
    Route::group([
        'middleware' => 'role.user11'
    ], function () {

        Route::group(['prefix' => 'user11', 'as' => 'user11.'], function () {
            
            Route::resource('home', HomeUser11Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser11', SuratMasukUser11Controller::class);
            Route::get('surat-masukuser11/detail', [SuratMasukUser11Controller::class, 'detail_surat'])->name('suratmasukuser11.detail');
        });

    });

    //role user12
    Route::group([
        'middleware' => 'role.user12'
    ], function () {

        Route::group(['prefix' => 'user12', 'as' => 'user12.'], function () {
            
            Route::resource('home', HomeUser12Controller::class);
            //HistoriSuratUser1Controller
            Route::resource('suratmasukuser12', SuratMasukUser12Controller::class);
            Route::get('surat-masukuser12/detail', [SuratMasukUser12Controller::class, 'detail_surat'])->name('suratmasukuser12.detail');
        });

    });


});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/totalstok', [DashboardController::class, 'totalstok'])->name('/totalstok');

