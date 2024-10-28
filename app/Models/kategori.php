<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
  
    
    protected $fillable = [
        'nama_kategori',
        'code_kategori',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_kategori');
    }

}
