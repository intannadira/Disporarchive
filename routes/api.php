<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\Admin\ApiGasController;
use App\Http\Controllers\Api\Supir\ApiScanController;
use App\Http\Controllers\Api\Admin\ApiLoginController;
use App\Http\Controllers\Api\Supir\ApiRelasiController;
use App\Http\Controllers\Api\Supir\ApiLaporanController;
use App\Http\Controllers\Api\Admin\ApiTipeGasControlller;
use App\Http\Controllers\Api\Admin\ApiDashboardController;
use App\Http\Controllers\Api\Admin\ApiRelasiAdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route resource untuk Absensi
Route::resource('absensi', AbsensiController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route ApiScanController
Route::post('scan', [ApiScanController::class, 'store']);
//route ApiGasController
Route::post('gas', [ApiGasController::class, 'store']);
Route::get('getgas', [ApiGasController::class, 'index']);
//hapus gas
Route::delete('delgas/{id}', [ApiGasController::class, 'destroy']);

//route ApiGasController
Route::get('laporan', [ApiLaporanController::class, 'index']);
Route::get('laporan/{id}', [ApiLaporanController::class, 'show']);
Route::get('search/{id}', [ApiLaporanController::class, 'search']);
//filter laporan
Route::get('filter/{tglawal}/{tglakhir}/{status}/{relasi}', [ApiLaporanController::class, 'filter']);


//login
Route::post('login', [ApiLoginController::class, 'login']);

//relasi 
Route::get('relasi', [ApiRelasiController::class, 'index']);
//route Relasi
Route::post('addrelasi', [ApiRelasiAdminController::class, 'store']);
//hapus relasi
Route::delete('delrelasi/{id}', [ApiRelasiAdminController::class, 'destroy']);
//edit relasi
Route::put('editrelasi/{id}', [ApiRelasiAdminController::class, 'update']);
//search relasi
Route::get('detailrelasi/{id}', [ApiRelasiAdminController::class, 'edit']);
//stok relasi
Route::get('historistok/{id}', [ApiRelasiAdminController::class, 'create']);

//getapidashboard
Route::get('dashboard', [ApiDashboardController::class, 'index']);

//tipegas
Route::get('tipegas', [ApiTipeGasControlller::class, 'index']);
//tambah tipe gas
Route::post('addtipegas', [ApiTipeGasControlller::class, 'store']);
//hapus tipe gas
Route::delete('deltipegas/{id}', [ApiTipeGasControlller::class, 'destroy']);
//edit tipe gas
Route::put('edittipegas/{id}', [ApiTipeGasControlller::class, 'update']);