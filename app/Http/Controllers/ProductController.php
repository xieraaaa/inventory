<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\kategori;
use App\Models\unit;
use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;

use Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Product::with(['brand', 'kategori', 'unit'])
                ->select('id', 'nama_product','code_product', 'slug', 'secondary_name', 'weight', 'barcode', 'id_brand', 'id_kategori', 'id_unit', 'price', 'image'))
                ->addColumn('image', function ($product) {
                    return '<img src="' . asset('storage/' . $product->image) . '" style="max-width: 50px;"/>';
                })
                ->addColumn('brand', function ($product) {
                    return $product->brand ? $product->brand->nama_brand : '-';
                })
                ->addColumn('kategori', function ($product) {
                    return $product->kategori ? $product->kategori->nama_kategori : '-';
                })
                ->addColumn('unit', function ($product) {
                    return $product->unit ? $product->unit->nama_unit : '-';
                })
                ->addColumn('barcode', function ($product) {
                    return $product->barcode;
                })
                ->addColumn('barcode', function ($product) {
                    return '<img src="' . asset('storage/barcodes/' . $product->code_product . '.png') . '" alt="Barcode" style="max-width: 150px;" />';
                })
                ->addColumn('action', 'content.product.product-action')
                ->rawColumns(['image', 'action','barcode'])
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
            'code_product' => 'required',
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
                'code_product' => $request->code_product,
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
        // Generate barcode sebagai base64 string
        $barcodeBase64 = (new DNS1D())->getBarcodePNG($product->code_product, 'C39', 1.5, 50);

        // Menyimpan base64 string sebagai file image
        $barcodePath = 'barcodes/' . $product->code_product . '.png';
        Storage::disk('public')->put($barcodePath, base64_decode($barcodeBase64));

        return response()->json([
            'product' => $product,
            'barcode_url' => asset('storage/' . $barcodePath)
        ]);

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
        // Ambil produk yang akan dihapus berdasarkan ID
        $product = Product::where('id', $request->id)->first();
    
        if ($product) {
            // Hapus gambar produk jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
    
            // Hapus barcode jika ada
            $barcodePath = 'barcodes/' . $product->code_product . '.png'; // Path ke barcode
            if (Storage::disk('public')->exists($barcodePath)) {
                Storage::disk('public')->delete($barcodePath); // Menghapus barcode
            }
    
            // Hapus produk dari database
            $product->delete();
    
            return response()->json([
                "status" => "success",
                "msg" => "Product Deleted Successfully"
            ], 201);
        } else {
            return response()->json([
                "status" => "failed",
                "msg" => "Something went wrong!"
            ], 210);
        }
    }
    
}