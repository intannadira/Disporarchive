<?php

namespace App\Http\Controllers\Admin;

use App\Models\Relasi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Gas;

class RelasiController extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = Relasi::with(['gas','transaksi.detail_transaksi'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('stok', function ($data) {
                    return $data->gas->count();
                })

                ->addColumn('action', function ($row) {

                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Detail Stok Gas" onclick="detail_stok(' . $row->id . ')"><i class="ti-search"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Histori Stok" onclick="histori_stok(' . $row->id . ')"><i class="ti-receipt"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.relasi.index', [
            'title'     => 'Relasi',
        ]);
    }

    public function create(Request $request)
    {

        if (request()->ajax()) {
        $data = Relasi::with([
                    'gas',
                    'transaksi.hasOne_detail_transaksi' => function($query) {
                        $query->selectRaw('kode_transaksi, 
                                        COUNT(id_barcode) as total')
                                        ->groupBy('kode_transaksi');
                    },
                ])
                ->where('id', $request->id)
                ->first();

        // return $data;

        // Hitung stok
        $stok_awal  = 0;
        $stok_akhir = 0;

        //if data transaksi kosong
        if ($data) {
            foreach($data->transaksi as $transaksi) {

                if($transaksi->status == 'masuk') {
                    $stok_akhir += $transaksi->hasOne_detail_transaksi->total;
                } else {
                    $stok_akhir -= $transaksi->hasOne_detail_transaksi->total;
                }
    
                $array_stok = [
                    'tanggal'       => $transaksi->tanggal,
                    'nama_relasi'   => $data->nama_relasi,
                    'stok_awal'     => $stok_awal,
                    'stok_akhir'    => $stok_akhir,
                    'status'        => $transaksi->status,
                    'total'         => $transaksi->hasOne_detail_transaksi->total,
                ];
    
                $result[] = $array_stok;
    
                if($transaksi->status == 'masuk') {
                    $stok_awal += $transaksi->hasOne_detail_transaksi->total;
                } else {
                    $stok_awal -= $transaksi->hasOne_detail_transaksi->total;
                }
            }
    
            $array = [
                'id'            => $data->id,
                'nama_relasi'   => $data->nama_relasi,
                'alamat'        => $data->alamat,
                'gas'           => $data->gas,
                'stok'          => $result,
            ];
        } else {
            $result = [];
    
        }
       
        // return $array;   

            return Datatables::of($result)
            ->addIndexColumn()
            ->make(true);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_relasi' => 'required',
            'alamat'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Relasi::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_relasi' => $request->nama_relasi,
                'alamat'      => $request->alamat,
            ]
        );

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Relasi::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if (request()->ajax()) {
            $data = Gas::with('tipegas')->where('posisi_gas', $request->id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

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
        Relasi::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
