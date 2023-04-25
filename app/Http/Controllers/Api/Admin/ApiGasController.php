<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Gas;
use App\Models\TipeGas;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiGasController extends Controller
{
    public function index(Request $request)
    {       
        $query = Gas::with('tipegas')
            ->select('id','barcode_id', 'id_tipe_gas','posisi_gas')
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
                'status'    =>  true,
                'message'   => 'Sukses',
                'code'      => '200',
                'data'      => $query,
            ]);
        }
                    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode.*.barcode_id' => 'required|distinct|unique:App\Models\Gas,barcode_id',

        ],[
            'barcode.*.barcode_id.required' => 'Barcode tidak boleh kosong',
            'barcode.*.barcode_id.distinct' => 'Barcode tidak boleh sama',
            'barcode.*.barcode_id.unique' => 'Barcode sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors' => $validator->errors(),
                'code'    => '400',
                'data'    => null
            ]);
        }

        $data = Gas::insert($request->barcode);

        // foreach($request->barcode as $barcode){
        //     Gas::create([
        //         'barcode_id'  => $barcode['barcode_id'],
        //         'posisi_gas'  => '1',
        //         'id_tipe_gas' => $barcode['id_tipe_gas']
        //     ]);
        // }

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
                'data'    => $request->all()
            ]);
        }

    }

    public function destroy($id)
    {
        // $gas = Gas::find($id);
        // $gas->delete();

        // if($gas == true){
        //     return response()->json([
        //         'status'  => true,
        //         'message' => 'Berhasil',
        //         'code'    => '200',
        //     ]);
        // }else{
            return response()->json([
                'status'  => false,
                'message' => 'Gagal',
                'code'    => '400',
            ]);
        // }
    }
}
