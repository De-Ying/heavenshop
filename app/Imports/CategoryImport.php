<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'category_name'        => $row['category_name'],
            'category_slug'        => $row['category_slug'],
            'category_parent'      => $row['category_parent'],
            'category_status'      => ($row['category_status'] == 'Hiện') ? 1 : 0
        ]);
    }
}
