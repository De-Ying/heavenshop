<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'product_id',
            'product_name',
            'product_quantity',
            'product_sold',
            'product_slug',
            'product_description',
            'product_content',
            'product_tags',
            'product_cost_price',
            'product_price',
            'product_image',
            'product_view',
            'product_status',
            'category_id',
            'supplier_id',
            'brand_id',
            'created_at',
        ];
    }
}
