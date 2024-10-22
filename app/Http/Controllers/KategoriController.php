<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = kategori::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-bs-toggle="modal" data-bs-target="#editModal" class="btn-edit btn btn-info btn-sm" value="' . $row->id . '"><i class="fa fa-edit"></i></button> ';
                    $btn .= '<button data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-delete btn btn-danger btn-sm" value="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required'],
            'code_kategori' => ['required']
        ]);

        kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'code_kategori' => $request->code_kategori,
        ]);

        return response()->json([
            "status" => "Product Saved Successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json(['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => ['required'],
            'code_kategori' => ['required']
        ]);

        $kategori = kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->code_kategori = $request->code_kategori;
        

        $kategori->update();

        return response()->json([
            "status" => "KATEGORI Updated Successfully"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = kategori::find($id);
        $kategori->delete();

        if (!$kategori) {
            return response()->json([
                "status" => "failed",
                "msg" => "Something went wrong!"
            ], 210);
        } else {
            return response()->json([
                "status" => "success",
                "msg" => "Product Deleted Successfully"
            ], 201);
        }
    }
}
