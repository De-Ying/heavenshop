<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Supplier([
            'supplier_name'         => $row['supplier_name'],
            'supplier_image'        => $row['supplier_image'],
            'supplier_phone'        => $row['supplier_phone'],
            'supplier_address'      => $row['supplier_address'],
            'supplier_email'        => $row['supplier_email'],
            'supplier_status'       => ($row['supplier_status'] == 'Hiện') ? 1 : 0,
        ]);
    }
}
