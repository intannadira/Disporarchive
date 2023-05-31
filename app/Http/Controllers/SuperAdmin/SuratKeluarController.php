<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = SuratKeluar::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal_surat', function ($row) {
                    $tanggal_surat = date('d-m-Y', strtotime($row->tanggal_surat));
                    return $tanggal_surat;
                })
                ->addColumn('h_status', function ($data) {
                    if ($data->status == 'diajukan') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-primary">Menunggu</a>';
                    }
                    if ($data->status == 'ditolak') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-danger">Dilaksanakan</a>';
                    }
                    if ($data->status == 'diverifikasi-kasubag') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-warning">Diverfikasi Kasub</a>';
                    }
                    if ($data->status == 'diverifikasi-sekdin') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-secondary">Diverifikasi Sekdin</a>';
                    }
                    if ($data->status == 'selesai') {
                        $status     = '<a href="javascript:void(0)" class="badge badge-success">Selesai</a>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 'diajukan'){
                        $actionBtn = '
                            <center>
                            <a href="surat-keluar/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    }else{
                        $actionBtn = '
                            <center>
                            <a href="surat-keluar/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'tanggal_surat', 'h_status'])
                ->make(true);
        }

        $jabatan = JabatanBidang::select('id', 'nama_jabatan_bidang')->get();

        return view('superadmin.suratkeluar.index', [
            'title'     => 'Surat Keluar',
            'jabatan'   => $jabatan
        ]);
    }

    function detail_surat(Request $request)
    {
        $kode = $request->get('kode');
        $surat = SuratKeluar::where('id', $kode)->first();

        return view('superadmin.suratkeluar.detail', [
            'title' => 'Detail Surat Keluar',
            'surat' => $surat
        ]);
    }

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
            'perihal'             => 'required',
            'tanggal_surat'       => 'required',
            'tujuan_surat'        => 'required',
            'tipe_surat'          => 'required',
            'deskripsi'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        //upload file
        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $file_name = time()."_".$file->getClientOriginalName();
            $file->move('lampiran',$file_name);
        }else{
            $file_name = null;
        }

        if ($request->id) {

            SuratKeluar::find($request->id)->update(
                [
                    'no_surat'                => $request->no_surat,
                    'perihal'                 => $request->perihal,
                    'tanggal_surat'           => $request->tanggal_surat,
                    'tujuan_surat'            => $request->tujuan_surat,
                    'tipe_surat'              => $request->tipe_surat,
                    'lampiran'                => $file_name,
                    'deskripsi'               => $request->deskripsi,
                ]
            );
        } else {

            SuratKeluar::Create(
                [
                    'perihal'                 => $request->perihal,
                    'tanggal_surat'           => $request->tanggal_surat,
                    'tujuan_surat'            => $request->tujuan_surat,
                    'tipe_surat'              => $request->tipe_surat,
                    'lampiran'                => $file_name,
                    'deskripsi'               => $request->deskripsi,
                    'status'                  => 'diajukan'
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
        $data = SuratKeluar::find($id);
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
        $data = SuratKeluar::find($id);
        $data->delete();
        return response()->json(['status' => true]);
    }
}
