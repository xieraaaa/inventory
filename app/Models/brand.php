<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $table = 'brand';

    protected $fillable = [
        'nama_brand',
        'code_brand',
    ];

    
}
