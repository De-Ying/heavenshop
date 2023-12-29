<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_code',
        'product_id',
        'product_name',
        'product_price',
        'product_sales_quantity',
        'product_coupon',
        'product_feeship',
    ];

    protected $primaryKey = 'order_details_id';

    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
