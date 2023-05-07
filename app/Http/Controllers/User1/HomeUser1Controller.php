<?php

namespace App\Http\Controllers\User1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeUser1Controller extends Controller
{
    public function index(Request $request)
    {
        $total_surat_didisposisi    = $this->total_surat_didisposisi();
        $total_surat_selesai        = $this->total_surat_selesai();

        return view('user1.dashboard', [
            'title'                       => 'Dashboard',
            'total_surat_didisposisi'     => $total_surat_didisposisi,
            'total_surat_selesai'         => $total_surat_selesai,
        ]);
    }

    //total_surat_didisposisi
    function total_surat_didisposisi(){
        $surat_didisposisi = DB::table('surat_masuk')
        ->where('status', 'didisposisi')
        ->where('jabatan_bidang_id', 4)
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
