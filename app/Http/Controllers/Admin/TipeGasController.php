<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeGas;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class TipeGasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
                
            $query = TipeGas::with('gas')->get();
                    
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('jumlah_gas', function ($data) {
                    return $data->gas->count();
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $data->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $data->id . ')"><i class="ti-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.tipe-gas.index',[
            'title' => 'Tipe Gas'
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
            'nama_tipe' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        TipeGas::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_tipe' => $request->nama_tipe,
            ]
        );

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
        $data = TipeGas::find($id);
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
        TipeGas::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
