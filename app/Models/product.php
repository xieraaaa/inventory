<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_product',
        'slug',
        'secondary_name',
        'weight',
        'barcode',
        'id_brand',
        'id_kategori',
        'id_unit',
        'price',
        
    ];

}
