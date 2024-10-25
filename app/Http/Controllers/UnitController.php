<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;

use Datatables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            //return datatables()->of(unit::select('*'))
            return datatables()->of(unit::select('id', 'nama_unit', 'code_unit'))
                ->addColumn('action', 'content.unit.unit-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.unit.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unitId = $request->id;

        $request->validate([
            'nama_unit' => 'required',
            'code_unit' => 'required'
        ]);

        $unit = unit::updateOrCreate(
            [
                'id' => $unitId
            ],
            [
                'nama_unit' => $request->nama_unit,
                'code_unit' => $request->code_unit
            ]
        );

        return Response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $unit  = unit::where($where)->first();

        return Response()->json($unit);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $unit = unit::where('id', $request->id)->delete();

        return Response()->json($unit);
    }
}
