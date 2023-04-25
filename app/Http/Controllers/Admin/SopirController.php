<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sopir;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SopirController extends Controller
{
    public function index()
    {

        //datatable
        if (request()->ajax()) {
            $data = Sopir::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.sopir.index', [
            'title'     => 'Sopir',
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
            'nama'       => 'required',
            'alamat'     => 'required',
            'nik'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            Sopir::find($request->id)->update(
                [
                    'nama'      => $request->nama,
                    'alamat'    => $request->alamat,
                    'nik'       => $request->nik,
                ]
            );
        } else {

            Sopir::Create(
                [
                    'nama'      => $request->nama,
                    'alamat'    => $request->alamat,
                    'nik'       => $request->nik,
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
        $data = Sopir::find($id);
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
        $sopir = Sopir::find($id);
        $sopir->delete();
        return response()->json(['status' => true]);
    }

}
