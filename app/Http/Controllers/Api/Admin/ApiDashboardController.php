<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalsopir                 = $this->totalsopir();
        $totalrelasi                = $this->totalrelasi();
        $totalstok                  = $this->totalstok();

        $array = [
            'totalsopir'     => $totalsopir,
            'totalrelasi'    => $totalrelasi,
            'totalstok'      => $totalstok,
        ];

        $result[] = $array;

        return response()->json([
            'status'  => true,
            'message' => 'Sukses',
            'code'    => '200',
            'data'    => $result
        ]);
    }

    function totalstok(){

        $stok = DB::table('gas')
        ->where('posisi_gas', '=', '1')
        ->count('id');

        if($stok){
            return $stok;
        }else{
            return 0;
        }
        
    }

    function totalsopir(){

        $sopir = DB::table('sopir')
        ->count();
        
        return $sopir;
    }

    function totalrelasi(){

        $relasi = DB::table('relasi')
        ->count();
        
        return $relasi;
    }
}
