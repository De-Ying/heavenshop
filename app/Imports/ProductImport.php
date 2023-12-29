<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name'           => $row['product_name'],
            'product_quantity'       => $row['product_quantity'],
            'product_slug'           => $row['product_slug'],
            'product_description'    => $row['product_description'],
            'product_content'        => $row['product_content'],
            'product_tags'           => $row['product_tags'],
            'product_cost_price'     => $row['product_cost_price'],
            'product_price'          => $row['product_price'],
            'category_id'            => $row['category_id'],
            'brand_id'               => $row['brand_id']
        ]);
    }
}
