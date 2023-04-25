<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// use model
use App\Models\Relasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Gas;

use Illuminate\Support\Facades\DB;

class InputScanPertamaController extends Controller
{
    public function index()
    {
        $relasi = Relasi::all();

        return view('admin.scan.index',[
            'title' => 'Admin Scan',
            'relasi' => $relasi
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

        $validator = Validator::make($request->all(), [
            'barcode.*' => 'required|distinct',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // database transaction
        DB::beginTransaction();
        try{

            // get kode transaksi
            $kode_transaksi = Kode_transaksi('masuk');

            Transaksi::create([
                'kode_transaksi'    => $kode_transaksi,
                'tanggal'           => now(),
                'id_supir'          => '1',
                'id_relasi'         => $request->relasi,
                'status'            => 'masuk'
            ]);

            foreach($request->barcode as $barcode){
                DetailTransaksi::create([
                    'kode_transaksi'    => $kode_transaksi,
                    'id_barcode'        => $barcode
                ]);
            }

            // update stok relasi
            $relasi = Relasi::find($request->relasi);
            $relasi->stok = $relasi->stok + count($request->barcode);
            $relasi->save();

            DB::commit();

            return response()->json(['status' => true]);

        }catch(\Exception $e){
            DB::rollback();
    
            return response()->json(['error' => $e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data   = Gas::where('barcode_id', $request->barcode)->first();
        if($data){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['error' => true]);
        }
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
