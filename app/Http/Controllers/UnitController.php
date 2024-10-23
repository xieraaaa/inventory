<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = unit::latest()->get();
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
        return view('content.unit.manage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => ['required'],
            'code_unit' => ['required']
        ]);

        unit::create([
            'nama_unit' => $request->nama_unit,
            'code_unit' => $request->code_unit,
        ]);

        return response()->json([
            "status" => "unit Saved Successfully"
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
        $unit = unit::findOrFail($id);
        return response()->json(['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_unit' => ['required'],
            'code_unit' => ['required']
        ]);

        $unit = unit::find($id);
        $unit->nama_unit = $request->nama_unit;
        $unit->code_unit = $request->code_unit;
        

        $unit->update();

        return response()->json([
            "status" => "unit Updated Successfully"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = unit::find($id);
        $unit->delete();

        if (!$unit) {
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
