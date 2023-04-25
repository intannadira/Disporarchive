<?php

namespace App\Http\Controllers\Api\Supir;

use App\Models\Relasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiRelasiController extends Controller
{
    public function index(Request $request)
    {       
        $query = Relasi::withCount('gas')->orderBy('created_at', 'desc')->get();
        // $query = TipeGas::withCount('gas')
        // ->get();

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
}
