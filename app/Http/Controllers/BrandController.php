<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;

use Datatables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            //return datatables()->of(brand::select('*'))
            return datatables()->of(brand::select('id', 'nama_brand', 'code_brand'))
                ->addColumn('action', 'content.brand.brand-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.brand.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brandId = $request->id;

        $request->validate([
            'nama_brand' => 'required',
            'code_brand' => 'required'
        ]);

        $brand = brand::updateOrCreate(
            [
                'id' => $brandId
            ],
            [
                'nama_brand' => $request->nama_brand,
                'code_brand' => $request->code_brand
            ]
        );

        return Response()->json($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $brand  = brand::where($where)->first();

        return Response()->json($brand);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = brand::where('id', $request->id)->delete();

        return Response()->json($brand);
    }
}
