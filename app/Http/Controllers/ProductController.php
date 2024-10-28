<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\kategori;
use App\Models\unit;
use App\Models\brand;
use Illuminate\Http\Request;

use Datatables;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            //return datatables()->of(product::select('*'))
            return datatables()->of(product::select('id', 'nama_product', 'slug','secondary_name','weight', 'barcode', 'id_brand','id_kategori','id_unit','price','image'))
                ->addColumn('image', function ($product) {
                return '<img src="' . asset('storage/' . $product->image) . '" style="max-width: 50px;"/>'; })    
                ->addColumn('action', 'content.product.product-action')
                ->rawColumns(['image', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        $kategoris = Kategori::all();
        $brands = Brand::all(); 
        $units = Unit::all(); 
        return view('content.product.manage', compact('kategoris', 'brands', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->id;

        $request->validate([
            'nama_product' => 'required',
            'slug' => 'required',
            'secondary_name' => 'required',
            'weight' => 'required',
            'barcode' => 'required',
            'id_brand' => 'required',
            'id_kategori' => 'required',
            'id_unit' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         
        ]);

        $imagePath = null;
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $imageUrl = 'storage/' . $imagePath;
        }

        $product = product::updateOrCreate(
            [
                'id' => $productId
            ],
            [
                'nama_product' => $request->nama_product,
                'slug' => $request->slug,
                'secondary_name' => $request->secondary_name,
                'weight' => $request->weight,
                'barcode' => $request->barcode,
                'id_brand' => $request->id_brand,
                'id_kategori' => $request->id_kategori,
                'id_unit' => $request->id_unit,
                'price' => $request->price,
                'image' => $imagePath
                
            ]
        );

        return Response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $product  = product::where($where)->first();

        return Response()->json($product);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = product::where('id', $request->id)->delete();

        
        if (!$product) {
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
