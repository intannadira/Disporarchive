<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sopir;
use App\Models\Relasi;
use App\Models\TipeGas;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;


class SearchBarcodeController extends Controller
{
    public function index(Request $request)
    {

        if (request()->ajax()) {
           
            $query = DetailTransaksi::with(['transaksi.sopir','transaksi.relasi'])
            ->orderBy('created_at', 'desc');
           
        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('tgl_transaksi', function ($data) {
                return date('d/m/Y', strtotime($data->transaksi->tanggal));
            })
            ->addColumn('status_transaksi', function ($data) {
                if ($data->transaksi->status == "masuk") {
                    return '<span class="badge badge-info">Masuk</span>';
                } else {
                    return '<span class="badge badge-success">Keluar</span>';
                }
            })
            ->rawColumns(['status_transaksi'])
            ->make(true);
    }
        
        return view('admin.searchbarcode.index',[
            'title'         => 'Search Barcode',
        ]);
    }
}
