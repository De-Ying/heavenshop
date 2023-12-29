<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'shipping_id',
        'order_code',
        'order_reason',
        'order_status',
        'order_date',
    ];

    protected $primaryKey = 'order_id';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping', 'shipping_id');
    }
}
