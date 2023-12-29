<?php

namespace App\Imports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CouponImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Coupon([
            'coupon_name'       => $row['coupon_name'],
            'coupon_start_date' => $row['coupon_start_date'],
            'coupon_end_date'   => $row['coupon_end_date'],
            'coupon_time'       => $row['coupon_time'],
            'coupon_condition'  => $row['coupon_condition'],
            'coupon_number'     => $row['coupon_number'],
            'coupon_code'       => $row['coupon_code'],
            'coupon_used'       => $row['coupon_used'],
        ]);
    }
}
