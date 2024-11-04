<?php

namespace App\Imports;

use App\Models\brand;
use Maatwebsite\Excel\Concerns\ToModel;

class BrandImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new brand([
            'nama_brand' => $row[0],
            'code_brand' => $row[1]
        ]);
    }
}