<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;

    protected $table = 'unit';

    protected $fillable = [
        'nama_unit',
        'code_unit',
    ];

    
}
