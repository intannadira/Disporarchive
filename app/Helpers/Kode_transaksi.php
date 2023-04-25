<?php

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

function Kode_transaksi($status){

    date_default_timezone_set('Asia/Jakarta');

    if($status == 'masuk'){
        $keterangan = 'IN';
    }else if($status == 'keluar'){
        $keterangan = 'OUT';
    }else{
        $keterangan = 'ERR';
    }
    
    $tanggal    = date('Ymd');
    $id_user    = '1';
    $kode_transaksi = $tanggal.'-'.$keterangan;

    $cek_kode_transaksi = Transaksi::where('status', $status)
                            ->where('tanggal', 'like', '%'.date('Y-m-d').'%')
                            ->count();

    if($cek_kode_transaksi > 0){
        $newKode = $kode_transaksi.'-'.$cek_kode_transaksi + 1;
    }else{
        $newKode = $kode_transaksi.'-1';
    }
    
   return $newKode;
}