<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class BrandImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Brand([
            'brand_name'        => $row['brand_name'],
            'brand_slug'        => $row['brand_slug'],
            'brand_status'      => ($row['brand_status'] == 'Hiện') ? 1 : 0
        ]);
    }
}
