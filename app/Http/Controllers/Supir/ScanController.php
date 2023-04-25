<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// use model
use App\Models\Relasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Gas;

use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relasi = Relasi::where('id', '!=', '1')->get();

        return view('supir.scan.index', [
            'title' => 'Scan',
            'relasi' => $relasi
        ]);
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
        $validator = Validator::make($request->all(), [
            'barcode.*' => 'required|distinct',
            'relasi'    => 'required',
            'status'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // database transaction
        DB::beginTransaction();
        try {

            // get kode transaksi
            $kode_transaksi = Kode_transaksi($request->status);

            Transaksi::create([
                'kode_transaksi'    => $kode_transaksi,
                'tanggal'           => now(),
                'id_supir'          => Auth::user()->id,
                'id_relasi'         => $request->relasi,
                'status'            => $request->status
            ]);

            if ($request->status == 'masuk') {
                $id_relasi = $request->relasi;

                // cek posisi barcode
                foreach ($request->barcode as $barcode) {
                    $cek = Gas::with('relasi')->where('barcode_id', $barcode)->first();

                    if ($cek) {

                        // validasi barcode yang bisa masuk hanya dari relasi gudang
                        if ($cek->posisi_gas != '1') {
                            return response()->json([
                                'validasi' => 'Gagal ! Barcode ' . $barcode . ' tidak berasal dari gudang',
                                'barcode'   => [ $barcode ]
                            ]);
                        }

                        // validasi agar tidak bisa masuk relasi yang sama
                        if ($cek->posisi_gas == $id_relasi) {
                            return response()->json([
                                'validasi'  => 'Gagal ! Barcode ' . $barcode . ' sudah berada di relasi ' . $cek->relasi->nama_relasi . '',
                                'barcode'   => [ $barcode ]
                            ]);
                        }
                    }
                }
            } else {
                // ketika status == keluar, set posisi gas menjadi 1 (kembali ke gudang)
                $id_relasi = '1';

                // cek posisi barcode
                foreach ($request->barcode as $barcode) {
                    $cek = Gas::with('relasi')->where('barcode_id', $barcode)->first();

                    if ($cek) {
                        if ($cek->posisi_gas != $request->relasi) {
                            return response()->json([
                                'validasi'  => 'Gagal ! Barcode ' . $barcode . ' tidak berada di relasi tersebut',
                                'barcode'   => [ $barcode ]
                            ]);
                        }
                    }

                    if ($cek) {
                        if ($cek->posisi_gas == '1') {
                            return response()->json([
                                'validasi'  => 'Gagal ! Barcode ' . $barcode . ' sudah berada di relasi ' . $cek->relasi->nama_relasi . '',
                                'barcode'   => [ $barcode ]
                            ]);
                        }
                    }
                }
            }

            foreach ($request->barcode as $barcode) {
                DetailTransaksi::create([
                    'kode_transaksi'    => $kode_transaksi,
                    'id_barcode'        => $barcode
                ]);

                // update posisi gas
                Gas::where('barcode_id', $barcode)->update([
                    'posisi_gas' => $id_relasi
                ]);
            }

            DB::commit();

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data   = Gas::where('barcode_id', $request->barcode)->first();
        if ($data) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['error' => true]);
        }
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
