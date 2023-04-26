<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {   
        $totalsopir                 = $this->totalsopir();
        $totalrelasi                = $this->totalrelasi();
        $totalstok                  = $this->totalstok();

        return view('admin.dashboard', [
            'title'          => 'Dashboard',
            'totalsopir'     => $totalsopir,
            'totalrelasi'    => $totalrelasi,
            'totalstok'      => $totalstok,
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
