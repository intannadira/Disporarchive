<?php

namespace App\Http\Controllers\User3;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeUser3Controller extends Controller
{
    
    public function index(Request $request)
    {
        $total_surat_didisposisi    = $this->total_surat_didisposisi();
        $total_surat_selesai        = $this->total_surat_selesai();

        return view('user3.dashboard', [
            'title'                       => 'Dashboard',
            'total_surat_didisposisi'     => $total_surat_didisposisi,
            'total_surat_selesai'         => $total_surat_selesai,
        ]);
    }

    //total_surat_didisposisi
    function total_surat_didisposisi(){
        $surat_didisposisi = DB::table('surat_masuk')
        ->where('status', 'didisposisi')
        ->where('jabatan_bidang_id', 6)
        ->count();
        
        if($surat_didisposisi){
            return $surat_didisposisi;
        }else{
            return 0;
        }
    }

    //total_surat_selesai
    function total_surat_selesai(){
        $surat_selesai = DB::table('surat_masuk')
        ->where('status', 'selesai')
        ->count();
        
        if($surat_selesai){
            return $surat_selesai;
        }else{
            return 0;
        }
    }

}
