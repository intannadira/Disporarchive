<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TipeGas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ApiTipeGasControlller extends Controller
{
    public function index(Request $request)
    {
        //hitung count jumlah gas 
        $query = TipeGas::withCount('gas')
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

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe' => 'required|unique:App\Models\TipeGas,nama_tipe',
        ],[
            'nama_tipe.required' => 'Nama Tipe tidak boleh kosong',
            'nama_tipe.unique' => 'Nama Tipe sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors' => $validator->errors(),
                'code'    => '400',
                'data'    => null
            ]);
        }

        $data = TipeGas::create([
            'nama_tipe' => $request->nama_tipe,
        ]);

        if($data){
            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil ditambahkan',
                'code'    => '200',
                'data'    => $data
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Data gagal ditambahkan',
                'code'    => '400',
                'data'    => null
            ]);
        }
    }

    public function update (Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe' => 'required|unique:App\Models\TipeGas,nama_tipe,'.$id,
        ],[
            'nama_tipe.required' => 'Nama Tipe tidak boleh kosong',
            'nama_tipe.unique' => 'Nama Tipe sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors' => $validator->errors(),
                'code'    => '400',
                'data'    => null
            ]);
        }

        $data = TipeGas::find($id);
        $data->nama_tipe = $request->nama_tipe;
        $data->save();

        if($data){
            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil diubah',
                'code'    => '200',
                'data'    => $data
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Data gagal diubah',
                'code'    => '400',
                'data'    => null
            ]);
        }
    }

    public function destroy($id)
    {
        $data = TipeGas::find($id);
        $data->delete();

        if($data){
            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil dihapus',
                'code'    => '200',
                'data'    => $data
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Data gagal dihapus',
                'code'    => '400',
                'data'    => null
            ]);
        }
    }
}
