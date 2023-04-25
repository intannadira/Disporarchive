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
use App\Http\Controllers\Admin\SearchBarcodeController;
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
    return redirect()->route('admin.dashboard.index');
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('authlogin', function () {

        if(auth()->user()->jabatan_id == '1'){
            return redirect()->route('admin.dashboard.index');
        }else{
            return redirect()->route('supir.scan.index');
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

