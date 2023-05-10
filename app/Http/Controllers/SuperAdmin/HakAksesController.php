<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JabatanBidang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HakAksesController extends Controller
{
    public function index()
    {
    
        //datatable
        if (request()->ajax()) {
            $data = User::with('jabatan')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row) {
                    $tanggal = date('d-m-Y H:i:s'
                    , strtotime($row->created_at));
                    return $tanggal;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'tanggal'])
                ->make(true);
        }

        $jabatan = Role::select('id', 'bagian')->get();

        return view('superadmin.hakakses.index', [
            'title'     => 'Pengguna',
            'jabatan'   => $jabatan
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
            'name'                => 'required',
            'email'               => 'required',
            'jabatan_id'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            User::find($request->id)->update(
                [
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'jabatan_id'   => $request->jabatan_id,
                ]
            );
        } else {

            User::Create(
                [
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'jabatan_id'   => $request->jabatan_id,
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
        $data = User::find($id);
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
        $data = User::find($id);
        $data->delete();
        return response()->json(['status' => true]);
    }
}
