<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\DashboardController;

use App\Http\Controllers\User1\HomeUser1Controller;
use App\Http\Controllers\User2\HomeUser2Controller;
use App\Http\Controllers\User3\HomeUser3Controller;
use App\Http\Controllers\User4\HomeUser4Controller;
use App\Http\Controllers\User5\HomeUser5Controller;
use App\Http\Controllers\User6\HomeUser6Controller;
use App\Http\Controllers\User7\HomeUser7Controller;
use App\Http\Controllers\User8\HomeUser8Controller;
use App\Http\Controllers\User9\HomeUser9Controller;
use App\Http\Controllers\User10\HomeUser10Controller;
use App\Http\Controllers\User11\HomeUser11Controller;
use App\Http\Controllers\User12\HomeUser12Controller;
use App\Http\Controllers\User1\HistoriSuratUser1Controller;
use App\Http\Controllers\User1\DisposisiSayaUser1Controller;
use App\Http\Controllers\User2\DisposisiSayaUser2Controller;
use App\Http\Controllers\User3\DisposisiSayaUser3Controller;
use App\Http\Controllers\User4\DisposisiSayaUser4Controller;
use App\Http\Controllers\User5\DisposisiSayaUser5Controller;
use App\Http\Controllers\User6\DisposisiSayaUser6Controller;
use App\Http\Controllers\User7\DisposisiSayaUser7Controller;
use App\Http\Controllers\User8\DisposisiSayaUser8Controller;
use App\Http\Controllers\User9\DisposisiSayaUser9Controller;
use App\Http\Controllers\User10\DisposisiSayaUser10Controller;
use App\Http\Controllers\User11\DisposisiSayaUser11Controller;

use App\Http\Controllers\User2\SuratMasukUser2Controller;
use App\Http\Controllers\User3\SuratMasukUser3Controller;
use App\Http\Controllers\User4\SuratMasukUser4Controller;
use App\Http\Controllers\User5\SuratMasukUser5Controller;
use App\Http\Controllers\User6\SuratMasukUser6Controller;
use App\Http\Controllers\User7\SuratMasukUser7Controller;
use App\Http\Controllers\User8\SuratMasukUser8Controller;
use App\Http\Controllers\User9\SuratMasukUser9Controller;
use App\Http\Controllers\User10\SuratMasukUser10Controller;
use App\Http\Controllers\User11\SuratMasukUser11Controller;
use App\Http\Controllers\User12\SuratMasukUser12Controller;
use App\Http\Controllers\Admin1\SuratMasukAdmin1Controller;
use App\Http\Controllers\Admin2\SuratMasukAdmin2Controller;
use App\Http\Controllers\Admin3\SuratMasukAdmin3Controller;
use App\Http\Controllers\Admin1\HistoriSuratAdmin1Controller;
use App\Http\Controllers\Admin2\HistoriSuratAdmin2Controller;
use App\Http\Controllers\Admin3\HistoriSuratAdmin3Controller;
use App\Http\Controllers\Admin1\DisposisiSayaAdmin1Controller;
use App\Http\Controllers\Admin2\DisposisiSayaAdmin2Controller;
use App\Http\Controllers\Admin1\HomeAdmin1Controller;
use App\Http\Controllers\Admin2\HomeAdmin2Controller;
use App\Http\Controllers\Admin3\HomeAdmin3Controller;

use App\Http\Controllers\SuperAdmin\JabatanBidangController;
use App\Http\Controllers\SuperAdmin\HomeSuperAdminController;
use App\Http\Controllers\SuperAdmin\HistoriSuratController;
use App\Http\Controllers\SuperAdmin\SuratKeluarController;
use App\Http\Controllers\SuperAdmin\HakAksesController;
use App\Http\Controllers\SuperAdmin\KaryawanController;
use App\Http\Controllers\SuperAdmin\SuratMasukController;



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
            return redirect()->route('user4.home.index');
        }else if(auth()->user()->jabatan_id == '9'){
            return redirect()->route('user5.home.index');
        }else if(auth()->user()->jabatan_id == '10'){
            return redirect()->route('user6.home.index');
        }else if(auth()->user()->jabatan_id == '11'){
            return redirect()->route('user7.home.index');
        }else if(auth()->user()->jabatan_id == '12'){
            return redirect()->route('user8.home.index');
        }else if(auth()->user()->jabatan_id == '13'){
            return redirect()->route('user9.home.index');
        }else if(auth()->user()->jabatan_id == '14'){
            return redirect()->route('user10.home.index');
        }else if(auth()->user()->jabatan_id == '15'){
            return redirect()->route('user11.home.index');
        }else if(auth()->user()->jabatan_id == '16'){
            return redirect()->route('user12.home.index');
        }else {
            return redirect()->route('login');
        }
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
            Route::get('surat-keluar/detail', [SuratKeluarController::class, 'detail_surat'])->name('suratkeluar.detail');

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
            //DisposisiSayaUser1
            Route::resource('disposisisayauser1', DisposisiSayaUser1Controller::class);
            Route::get('disposisi-sayauser1/detail', [DisposisiSayaUser1Controller::class, 'detail_surat'])->name('disposisisayauser1.detail');
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
            //DisposisiSayaUser2
            Route::resource('disposisisayauser2', DisposisiSayaUser2Controller::class);
            Route::get('disposisi-sayauser2/detail', [DisposisiSayaUser2Controller::class, 'detail_surat'])->name('disposisisayauser2.detail');
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
            //DisposisiSayaUser3
            Route::resource('disposisisayauser3', DisposisiSayaUser3Controller::class);
            Route::get('disposisi-sayauser3/detail', [DisposisiSayaUser3Controller::class, 'detail_surat'])->name('disposisisayauser3.detail');
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
            //DisposisiSayaUser4
            Route::resource('disposisisayauser4', DisposisiSayaUser4Controller::class);
            Route::get('disposisi-sayauser4/detail', [DisposisiSayaUser4Controller::class, 'detail_surat'])->name('disposisisayauser4.detail');
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
            //DisposisiSayaUser5
            Route::resource('disposisisayauser5', DisposisiSayaUser5Controller::class);
            Route::get('disposisi-sayauser5/detail', [DisposisiSayaUser5Controller::class, 'detail_surat'])->name('disposisisayauser5.detail');
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
            //DisposisiSayaUser6
            Route::resource('disposisisayauser6', DisposisiSayaUser6Controller::class);
            Route::get('disposisi-sayauser6/detail', [DisposisiSayaUser6Controller::class, 'detail_surat'])->name('disposisisayauser6.detail');
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
            //DisposisiSayaUser7
            Route::resource('disposisisayauser7', DisposisiSayaUser7Controller::class);
            Route::get('disposisi-sayauser7/detail', [DisposisiSayaUser7Controller::class, 'detail_surat'])->name('disposisisayauser7.detail');
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
            //DisposisiSayaUser8
            Route::resource('disposisisayauser8', DisposisiSayaUser8Controller::class);
            Route::get('disposisi-sayauser8/detail', [DisposisiSayaUser8Controller::class, 'detail_surat'])->name('disposisisayauser8.detail');
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
            //DisposisiSayaUser9
            Route::resource('disposisisayauser9', DisposisiSayaUser9Controller::class);
            Route::get('disposisi-sayauser9/detail', [DisposisiSayaUser9Controller::class, 'detail_surat'])->name('disposisisayauser9.detail');
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
            //DisposisiSayaUser10
            Route::resource('disposisisayauser10', DisposisiSayaUser10Controller::class);
            Route::get('disposisi-sayauser10/detail', [DisposisiSayaUser10Controller::class, 'detail_surat'])->name('disposisisayauser10.detail');
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
            //DisposisiSayaUser11
            Route::resource('disposisisayauser11', DisposisiSayaUser11Controller::class);
            Route::get('disposisi-sayauser11/detail', [DisposisiSayaUser11Controller::class, 'detail_surat'])->name('disposisisayauser11.detail');
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

