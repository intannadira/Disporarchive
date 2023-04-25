<?php

namespace App\Http\Controllers\Api\Supir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// use model
use App\Models\Relasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Gas;

use Illuminate\Support\Facades\DB;

class ApiScanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode.*' => 'required|distinct',
            // 'relasi'    => 'required',
            'status'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // database transaction
        // DB::beginTransaction();
        // try {

            // get kode transaksi
            $kode_transaksi = Kode_transaksi($request->status);

            $data = $request->barcode;
            
            // add new key to array
            $data = array_map(function($item) use ($kode_transaksi) {
                return array_merge($item, ['kode_transaksi' => $kode_transaksi]);
            }, $data);

            $cek = Gas::with('relasi')->whereIn('barcode_id', array_column($data, 'id_barcode'))->get();

            $id_relasi = $request->id_relasi;
            
            // validasi data
            if(count($cek)){

                if ($request->status == 'masuk') {

                    if(in_array($id_relasi, array_column($cek->toArray(), 'posisi_gas'))){
                        // cek posisi relasi gas
                        $relasi = Relasi::whereIn('id', array_column($cek->toArray(), 'posisi_gas'))->first();
                        //cek barcode 
                        // $barcode = Gas::whereIn('posisi_gas', array_column($cek->toArray(), 'posisi_gas'))->get();
                        // //cari barode yg sudah ada di relasi
                        // $datas = $barcode->where('posisi_gas', $id_relasi)->first();

                        $validasi_posisi_gas = Gas::whereIn('barcode_id', array_column($cek->toArray(), 'barcode_id'))
                        ->where('posisi_gas', '=' , $id_relasi)
                        ->first();

                        if($validasi_posisi_gas){
                            return response()->json([
                                'status'    => false,
                                'validasi'  => 'Gagal ! Barcode '.$validasi_posisi_gas->barcode_id.' sudah berada di relasi ' . $relasi->nama_relasi . '',
                                'code'      => '400',
                                // 'id_relasi' => $relasi,
                                // 'data'      => array_column($cek->toArray(), 'posisi_gas'),
                                // 'barcode'  => $datas
                            ]);
                        }
                    }

                    // if(!in_array('1', array_column($cek->toArray(), 'posisi_gas'))){
                    //     //cek barcode 
                    //     $barcode = Gas::whereIn('posisi_gas', array_column($cek->toArray(), 'posisi_gas'))->get();
                    //     //cari barode yg sudah ada di relasi
                    //     $datas = $barcode->where('posisi_gas', $id_relasi)->first();

                    $validasi_posisi_gas = Gas::whereIn('barcode_id', array_column($cek->toArray(), 'barcode_id'))
                    ->where('posisi_gas', '!=' , '1')
                    ->first();

                        if($validasi_posisi_gas){
                            return response()->json([
                                'status'    => false,
                                'message' => 'Gagal ! Barcode '.$validasi_posisi_gas->barcode_id.' tidak berasal dari Gudang',
                                'code'    => '400',
                            ]);
                        }
                    // }

                }else{
                    $id_relasi = '1';
                     // cek posisi relasi gas
                    $relasi = Relasi::whereIn('id', array_column($cek->toArray(), 'posisi_gas'))->first();
                    $a = $request->id_relasi;

                    if (!in_array($request->id_relasi, array_column($cek->toArray(), 'posisi_gas'))){
                        //cek barcode
                        $barcode = Gas::whereIn('barcode_id', array_column($cek->toArray(), 'barcode_id'))->get();
                        //cari barode yg sudah ada di relasi
                        $datas = $barcode->where('posisi_gas', $a)->first();

                        return response()->json([
                            'status'    => false,
                            'message'  => 'Gagal ! Barcode '.$barcode[0]['barcode_id'].' tidak berada di relasi tersebut',
                            'code'      => '400',
                            // 'data'      => array_column($cek->toArray(), 'barcode_id'),
                            // 'barcode'   => $barcode[0]['barcode_id'],
                            // 'datas'     => $datas,
                            // 'validasi'  => $validasi_posisi_gas,
                            // 'a'         => $a,
                        ]);
                    }

                    if (in_array('1', array_column($cek->toArray(), 'posisi_gas'))){
                        return response()->json([
                            'status'    => false,
                            'validasi'  => 'Gagal ! Barcode sudah berada di relasi ' . $relasi->nama_relasi . '',
                            'code'      => '400',
                        ]);
                    }
                }
                
            }


            // return response()->json([
            //     'status'  => true,
            //     'message' => $cek
            // ]);

            Transaksi::create([
                'kode_transaksi'    => $kode_transaksi,
                'tanggal'           => now(),
                'id_supir'          => $request->id_supir,
                'id_relasi'         => $request->id_relasi,
                'status'            => $request->status
            ]);
            
            DetailTransaksi::insert($data);

            Gas::whereIn('barcode_id', array_column($data, 'id_barcode'))->update([
                'posisi_gas' => $id_relasi,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil !',
                'code' => '200',
                'data' => $request->all()
            ]);

            // DB::commit();

            
        // } catch (\Exception $e) {
        //     DB::rollback();

        //     return response()->json(['error' => $e->getMessage()]);
        // }
    }
}
