<?php

namespace App\Exports;

use App\Models\CategoryPost;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryPostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryPost::all();
    }

    public function headings(): array
    {
        return [
            'category_post_id',
            'category_post_name',
            'category_post_slug',
            'category_post_description',
            'category_post_status'
        ];
    }
}
