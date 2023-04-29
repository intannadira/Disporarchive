<?php

namespace App\Http\Controllers\User1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeUser1Controller extends Controller
{
    public function index(Request $request)
    {
        $total_surat_masuk          = $this->total_surat_masuk();
        $total_surat_keluar         = $this->total_surat_keluar();
        $total_surat_diproses       = $this->total_surat_diproses();
        $total_surat_selesai        = $this->total_surat_selesai();

        return view('user1.dashboard', [
            'title'                 => 'Dashboard',
            'total_surat_masuk'     => $total_surat_masuk,
            'total_surat_keluar'    => $total_surat_keluar,
            'total_surat_diproses'  => $total_surat_diproses,
            'total_surat_selesai'   => $total_surat_selesai,
        ]);
    }

    function total_surat_masuk(){
        $surat_masuk = DB::table('surat_masuk')
        ->count();
        
        if($surat_masuk){
            return $surat_masuk;
        }else{
            return 0;
        }
    }

    function total_surat_keluar(){
        $surat_keluar = DB::table('surat_keluar')
        ->count();
        
        if($surat_keluar){
            return $surat_keluar;
        }else{
            return 0;
        }
    }

    function total_surat_diproses(){
        $surat_diproses = DB::table('surat_masuk')
        ->where('status', '=', '1')
        ->count();
        
        if($surat_diproses){
            return $surat_diproses;
        }else{
            return 0;
        }
    }

    function total_surat_selesai(){
        $surat_selesai = DB::table('surat_masuk')
        ->where('status', '=', '2')
        ->count();
        
        if($surat_selesai){
            return $surat_selesai;
        }else{
            return 0;
        }
    }
}
