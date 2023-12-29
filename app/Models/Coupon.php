<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'coupon_name',
        'coupon_start_date',
        'coupon_end_date',
        'coupon_time',
        'coupon_condition',
        'coupon_number',
        'coupon_code',
        'coupon_used',
    ];

    protected $primaryKey = 'coupon_id';

    public $timestamps = false;
}
