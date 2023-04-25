<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\User;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal = date('Y-m-d');

        // cek jadwal user hari ini
        $jadwal = Jadwal::where('user_id', 8)
            ->where('tanggal_mulai', '<=', $tanggal)
            ->where('tanggal_selesai', '>=', $tanggal)
            ->first();

        var_dump($jadwal);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'uid'   => 'required',
        ]);

        // pecah uid menjadi 2 karakter
        $uid = explode(' ', $request->uid);

        $reverseUid = "";
        for ($i = (count($uid) - 1); $i >= 0; $i--) {
            $reverseUid .= strtoupper($uid[$i]);
        }

        // tanggal sekarang
        $tanggal = date('Y-m-d');

        // waktu sekarang
        $waktu = date('H:i:s');

        // find user by uid
        $user = User::with('karyawan')->where('uid', $reverseUid)->first();

        if (!$user) {
            return response()->json([
                'status'        => 'Error',
                'karyawan'      => 'Belum Terdaftar',
                'message'       => 'Error',
                'uid'           => $reverseUid,
            ]);
        }

        // cek jadwal user hari ini
        $jadwal = Jadwal::where('user_id', $user->id)
            ->where('tanggal_mulai', '<=', $tanggal)
            ->where('tanggal_selesai', '>=', $tanggal)
            ->first();
        
        if (!$jadwal) {
            return response()->json([
                'status'        => 'Error',
                'karyawan'      => 'Tida Ada Jadwal',
                'message'       => 'Error',
                'uid'           => $reverseUid,
            ]);
        }

        // cek apakah user sudah absen hari ini
        $cek = Absensi::where('user_id', $user->id)
            ->where('tanggal', $tanggal)
            ->where('jam_masuk', '!=', null)
            ->first();

        // ketika sudah absen
        if ($cek) {

            // cek apakah sudah absen pulang
            $cekPulang = Absensi::where('id', $cek->id)
                ->where('jam_pulang', '!=', null)
                ->first();

            if ($cekPulang) {

                return response()->json([
                    'status'        => 'Error',
                    'karyawan'      => 'Sudah absen',
                    'message'       => '',
                    'uid'           => $reverseUid,
                ]);
            } else {

                Absensi::findOrFail($cek->id)->update([
                    'jam_pulang'    => $waktu,
                ]);

                $post_data="karyawan=".$user->karyawan->nama;
                $url="http://aplikasi.solonet.net.id:3000/";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_exec($ch);

                return response()->json([
                    'status'        => 'Goodbye',
                    'karyawan'      => $user->karyawan->nama,
                    'message'       => 'Berhasil absen',
                    'uid'           => $reverseUid,
                ]);
            }
        } else {

            Absensi::create([
                'user_id'       => $user->id,
                'tanggal'       => $tanggal,
                'jam_masuk'     => $waktu,
                'shift_id'      => $jadwal->shift_id,
            ]);

            $post_data="karyawan=".$user->karyawan->nama;
            $url="http://aplikasi.solonet.net.id:3000/";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_exec($ch);

            return response()->json([
                'status'    => 'Welcome',
                'karyawan'  => $user->karyawan->nama,
                'message'   => 'Berhasil absen',
                'uid'       => $reverseUid
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
