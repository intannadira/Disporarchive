<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Gas;
use App\Models\Relasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiRelasiAdminController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_relasi' => 'required',
        ],[
            'nama_relasi.required' => 'Nama Relasi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors' => $validator->errors(),
                'code'    => '400',
                'data'    => null
            ]); 
        }

        $data = Relasi::create([
                'nama_relasi' => $request->nama_relasi,
                'alamat'      => $request->alamat,
        ]);

        if($data == true){
            return response()->json([
                'status'  => true,
                'message' => 'Sukses',
                'code'    => '200',
                'data'    => $request->all()
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Gagal',
                'code'    => '400',
            ]);
        }

    }
    public function create(Request $request, $id)
    {
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

        
        if($result == null){
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
                'code'    => '404',
            ]);
        }else{
            return response()->json([
                'status'  => true,
                'message' => 'Sukses',
                'code'    => '200',
                'data'    => $result,
            ]);
        }
    
    }

    public function update(Request $request,$id)
    {
        $relasi = Relasi::find($id);
        $relasi->update($request->all());

        if($relasi == true){
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil',
                'code'    => '200',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Gagal',
                'code'    => '400',
            ]);
        }
        // return $product;
    }

    public function edit($id, Request $request)
    {
        $data = Gas::with('tipegas')
        ->where('posisi_gas', $request->id)
        ->get();

        if($data->count() == 0){
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
                'data'      => $data,
            ]);
        }

    }

    public function destroy($id)
    {
        $gas = Relasi::find($id);
        $gas->delete();

        if($gas == true){
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil',
                'code'    => '200',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Gagal',
                'code'    => '400',
            ]);
        }
    }
}
