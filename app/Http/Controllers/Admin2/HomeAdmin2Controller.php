<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeAdmin2Controller extends Controller
{
    public function index(Request $request)
    {
        $total_surat_belum_terkonfirmasi = $this->total_surat_belum_terkonfirmasi();
        $total_surat_diproses            = $this->total_surat_diproses();
        $total_surat_didisposisi         = $this->total_surat_didisposisi();
        $total_surat_selesai             = $this->total_surat_selesai();

        return view('admin2.dashboard', [
            'title'                 => 'Dashboard',
            'total_surat_belum_terkonfirmasi'     => $total_surat_belum_terkonfirmasi,
            'total_surat_diproses'                => $total_surat_diproses,
            'total_surat_didisposisi'             => $total_surat_didisposisi,
            'total_surat_selesai'                 => $total_surat_selesai,
        ]);
    }

    //total_surat_belum_terkonfirmasi
    function total_surat_belum_terkonfirmasi(){
        $surat_belum_terkonfirmasi = DB::table('surat_masuk')
        ->where('status', 'diverifikasi-kasubag')
        ->count();
        
        if($surat_belum_terkonfirmasi){
            return $surat_belum_terkonfirmasi;
        }else{
            return 0;
        }
    }


    function total_surat_diproses(){
        $surat_diproses = DB::table('surat_masuk')
        ->whereIn('status', ['diajukan', 'didisposisi', 'dilaksanakan', 'diverifikasi-kasubag', 'diverifikasi-sekdin'])
        ->count();
        
        if($surat_diproses){
            return $surat_diproses;
        }else{
            return 0;
        }
    }

    //total_surat_didisposisi
    function total_surat_didisposisi(){
        $surat_didisposisi = DB::table('surat_masuk')
        ->where('status', 'didisposisi')
        ->where('jabatan_bidang_id', 1)
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
