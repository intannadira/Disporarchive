<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Relasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Sopir;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {

                if($request->status == 'all'){
                    $status = ['masuk','keluar'];
                }else{
                    $status = [$request->status];
                }

                if($request->relasi == 'all'){
                    $relasi = Relasi::pluck('id')->toArray();
                }else{
                    $relasi = [$request->relasi];
                }
               
                $query = Transaksi::with(['sopir','detail_transaksi.namagas.tipenama','relasi'])
                ->where('tanggal', '>=', $request->from)
                ->where('tanggal', '<=', $request->to)
                ->whereIn('status', $status)
                ->where('id_supir', Auth::user()->id)
                ->whereIn('id_relasi', $relasi)
                ->orderBy('tanggal', 'desc')->get();
               
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('tgl_transaksi', function ($data) {
                    return date('d/m/Y', strtotime($data->tanggal));
                })
                ->addColumn('total_gas', function ($data) {
                    return count($data->detail_transaksi);
                })
                ->addColumn('status_transaksi', function ($data) {
                    if ($data->status == "masuk") {
                        return '<span class="badge badge-info">Masuk</span>';
                    } else {
                        return '<span class="badge badge-success">Keluar</span>';
                    }
                })
                ->addColumn('kode_trx', function ($data) {
                    return '<a href="/supir/laporan/1?kode='.$data->kode_transaksi.'">'.$data->kode_transaksi.'</a>';
                })
                ->rawColumns(['status_transaksi','kode_trx'])
                ->make(true);
        }


        $relasi = Relasi::all();
        
        return view('supir.laporan.index',[
            'title'         => 'Laporan Transaksi',
            'relasi'        => $relasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $transaksi = Transaksi::with(['sopir','detail_transaksi','relasi'])->where('kode_transaksi',$request->kode)->first();

        return view('supir.laporan.detail',[
            'title'         => 'Laporan Transaksi',
            'transaksi'     => $transaksi,
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
