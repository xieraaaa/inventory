<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

use Datatables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            //return datatables()->of(kategori::select('*'))
            return datatables()->of(kategori::select('id', 'nama_kategori', 'code_kategori'))
                ->addColumn('action', 'content.kategori.kategori-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('content.kategori.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategoriId = $request->id;

        $request->validate([
            'nama_kategori' => 'required',
            'code_kategori' => 'required'
        ]);

        $kategori = kategori::updateOrCreate(
            [
                'id' => $kategoriId
            ],
            [
                'nama_kategori' => $request->nama_kategori,
                'code_kategori' => $request->code_kategori
            ]
        );

        return Response()->json($kategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $kategori  = kategori::where($where)->first();

        return Response()->json($kategori);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kategori = kategori::where('id', $request->id)->delete();

        return Response()->json($kategori);
    }
}
