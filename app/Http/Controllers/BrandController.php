<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = brand::latest()->get();
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
        return view('brand.manage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_brand' => ['required'],
            'code_brand' => ['required']
        ]);

        brand::create([
            'nama_brand' => $request->nama_brand,
            'code_brand' => $request->code_brand,
        ]);

        return response()->json([
            "status" => "brand Saved Successfully"
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
        $brand = brand::findOrFail($id);
        return response()->json(['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_brand' => ['required'],
            'code_brand' => ['required']
        ]);

        $brand = brand::find($id);
        $brand->nama_brand = $request->nama_brand;
        $brand->code_brand = $request->code_brand;
        

        $brand->update();

        return response()->json([
            "status" => "brand Updated Successfully"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = brand::find($id);
        $brand->delete();

        if (!$brand) {
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
