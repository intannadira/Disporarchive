<?php

namespace App\Http\Controllers\Api;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    public function getJabatan()
    {
        $jabatan = JabatanBidang::select('id', 'nama_jabatan')->get();
        return response()->json($jabatan);
    }

    public function getKaryawan(Request $request)
    {
        $karyawan = Karyawan::where('jabatan_bidang_id', $request->jabatan_bidang_id)->get();
        return response()->json($karyawan);
    }
}
