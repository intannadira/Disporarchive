<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gas;
use App\Models\TipeGas;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class GasController extends Controller
{
    public function index(Request $request)
    {

        if (request()->ajax()) {
                
            $query = Gas::with('tipegas')->select('id','barcode_id', 'id_tipe_gas','posisi_gas')->get();
                    
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <center>
                        <a href="javascript:void(0)" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $data->id . ')"><i class="ti-trash"></i></a>
                        </center>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $tipe_gas = TipeGas::all();

        return view('admin.gas.index',[
            'title'    => 'Daftar Gas',
            'tipe_gas'  => $tipe_gas
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
            'barcode_id.*'      => 'required|distinct|unique:App\Models\Gas,barcode',
            'tipegas'        => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        foreach($request->barcode as $barcode){
            Gas::create([
                'barcode_id'  => $barcode,
                'posisi_gas'  => '1',
                'id_tipe_gas' => $request->tipegas,
            ]);
        }

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data   = Gas::where('barcode_id', $request->barcode)->first();
        if(!$data){
            return response()->json(['status' => true]);
        }else{
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
        $gas = Gas::find($id);
        $gas->delete();
        return response()->json(['status' => true]);
    }
}
