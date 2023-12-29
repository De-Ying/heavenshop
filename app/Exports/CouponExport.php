<?php

namespace App\Exports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Coupon::all();
    }

    public function headings(): array
    {
        return [
           'Mã giảm giá',
           'Tên mã giảm giá',
           'Ngày bắt đầu',
           'Ngày kết thúc',
           'Số lượng mã',
           'Phương thúc mã',
           'Phần trăm/Tiền giảm',
           'Mã code giảm giá',
           'Mã người sử dụng'
        ];
    }
}
