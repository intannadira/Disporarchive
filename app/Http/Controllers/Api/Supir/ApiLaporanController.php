<?php

namespace App\Http\Controllers\Api\Supir;

use App\Models\Sopir;
use App\Models\Relasi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Http\Controllers\Controller;

class ApiLaporanController extends Controller
{
    public function index(Request $request)
    {       
        $query = Transaksi::with(['sopir','detail_transaksi.namagas.tipenama','relasi'])
        ->select('transaksi.*')
        ->orderBy('created_at', 'desc')
        ->where('created_at', '>=', date('Y-m-d', strtotime('-1 month')))
        ->get();

        if($query->count() == 0){
            return response()->json([
                'status'  =>  false,
                'message' => 'Data tidak ditemukan',
                'code'    => '404',
            ]);
        }else{
            return response()->json([
                'status'    =>  true,
                'message'   => 'Sukses',
                'code'      => '200',
                'data'      => $query,
            ]);
        }
                    
    }

    public function show($id)
    {

        $query = DetailTransaksi::with(['namagas.tipenama'])
        ->select('detail_transaksi.*')
        ->where('kode_transaksi', $id)
        ->get();

        //count total gas
        $total_gas = DetailTransaksi::where('kode_transaksi', $id)
                ->count('id');
            
        if($query->count() == 0){
            return response()->json([
                'status'  =>  false,
                'message' => 'Data tidak ditemukan',
                'code'    => '404',
            ]);
        }else{
            return response()->json([
                'status'    =>  true,
                'message'   => 'Sukses',
                'code'      => '200',
                'data'      => $query,
                'total_gas' => $total_gas
            ]);
        }
    }

    //function search barcode
    public function search($id)
    {
        $query = DetailTransaksi::with(['transaksi.sopir','transaksi.relasi'])
        ->select('detail_transaksi.*')
        ->where('id_barcode', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        if($query->count() == 0){
            return response()->json([
                'status'  =>  false,
                'message' => 'Data tidak ditemukan',
                'code'    => '404',
            ]);
        }else{
            return response()->json([
                'status'  =>  true,
                'message' => 'Sukses',
                'code'    => '200',
                'data'    => $query
            ]);
        }

    }

    //api filter laporan status, supir, relasi
    public function filter($tglawal, $tglakhir, $status, $relasi )
    {

        $query = Transaksi::with(['sopir','detail_transaksi.namagas.tipenama','relasi'])
        ->where('tanggal', '>=', $tglawal)
        ->where('tanggal', '<=', $tglakhir)
        ->where('status', $status)
        ->where('id_relasi', $relasi)
        ->orderBy('tanggal', 'desc')->get();

        if($query->count() == 0){
            return response()->json([
                'status'  =>  false,
                'message' => 'Data tidak ditemukan',
                'code'    => '404',
            ]);
        }else{
            return response()->json([
                'status'  =>  true,
                'message' => 'Sukses',
                'code'    => '200',
                'data'    => $query
            ]);
        }
    }
    
}
