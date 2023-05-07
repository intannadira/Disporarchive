<?php

namespace App\Http\Controllers\User10;

use App\Models\Karyawan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class DisposisiSayaUser10Controller extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratMasuk::with('jabatan_bidang')
            ->where('jabatan_bidang_id', 13)
            ->where('status','didisposisi')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                //status
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diajukan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Menunggu</a>';
                    }
                    if ($data->status == 'didisposisi') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Disposisi</a>';
                    }
                    if ($data->status == 'dilaksanakan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-primary">Dilaksanakan</a>';
                    }
                    if ($data->status == 'diverifikasi-kasubag') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasubag</a>';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Diverifikasi Sekdin</a>';
                    }
                    if ($data->status == 'selesai') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>';
                    }
                    return $status;
                })
                ->addColumn('h_tanggal_terima', function ($data) {
                    $tanggal_terima = date('d-m-Y', strtotime($data->tanggal_terima));
                    return $tanggal_terima;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <center>
                            <a href="disposisi-sayauser10/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"> Detail</i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-check"> Konfirmasi</i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'h_status', 'h_tanggal_terima'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();
        $karyawan = Karyawan::select('id', 'nama')->get();

        return view('user10.disposisisaya.index', [
            'title'     => 'Disposisi Surat',
            'jabatan'   => $jabatan,
            'karyawan'  => $karyawan
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratMasuk::with(['jabatan_bidang', 'karyawan'])->where('id', $kode)->first();

        return view('user10.disposisisaya.detail', [
            'title' => 'Disposisi Surat',
            'surat' => $surat
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tindakan'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            //if request tindakan diajukan 
            if ($request->tindakan == 'selesai') {
                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'selesai',
                    ]
                );
            }else{
                SuratMasuk::find($request->id)->update(
                    [
                        'status'                      => 'didisposisi',
                    ]
                );
            }

            
        } else {

            SuratMasuk::Create(
                [
                    'no_urut'                     => $request->no_urut,
                    'dari_instansi'               => $request->dari_instansi,
                    'no_surat'                    => $request->no_surat,
                    'perihal'                     => $request->perihal,
                    'tanggal_surat'               => $request->tanggal_surat,
                    'tanggal_terima'              => $request->tanggal_terima,
                    'kepada'                      => $request->kepada,
                    'kategori_surat'              => $request->kategori_surat,
                    'status'                      => 'diajukan',
                    'lampiran'                    => $request->lampiran,
                ]
            );
        }

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SuratMasuk::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $data = SuratMasuk::find($id);
        $data->delete();
        return response()->json(['status' => true]);
    }
}
