<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_product',
        'code_product',
        'slug',
        'secondary_name',
        'weight',
        'barcode',
        'id_brand',
        'id_kategori',
        'id_unit',
        'price',
        'image'
        
    ];

   
public function brand() {
    return $this->belongsTo(Brand::class, 'id_brand');
}

public function kategori() {
    return $this->belongsTo(Kategori::class, 'id_kategori');
}

public function unit() {
    return $this->belongsTo(Unit::class, 'id_unit');
}

public static function generateBarcode($namaProduct)
    {
        return substr(md5($namaProduct), 0, 12); // Menghasilkan barcode unik dari nama produk
    }

}