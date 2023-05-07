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
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <center>
                            <a href="surat-keluar/detail?kode=' . $row->id . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Surat"><i class="ti-search"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'tanggal_surat'])
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
            'no_surat'            => 'required',
            'perihal'             => 'required',
            'tanggal_surat'       => 'required',
            'tujuan_surat'        => 'required',
            'deskripsi'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            SuratKeluar::find($request->id)->update(
                [
                    'no_surat'                => $request->no_surat,
                    'perihal'                 => $request->perihal,
                    'tanggal_surat'           => $request->tanggal_surat,
                    'tujuan_surat'            => $request->tujuan_surat,
                    'deskripsi'               => $request->deskripsi,
                ]
            );
        } else {

            SuratKeluar::Create(
                [
                    'no_surat'                => $request->no_surat,
                    'perihal'                 => $request->perihal,
                    'tanggal_surat'           => $request->tanggal_surat,
                    'tujuan_surat'            => $request->tujuan_surat,
                    'deskripsi'               => $request->deskripsi,
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
