<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping';

    protected $fillable = [
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_email',
        'shipping_notes',
        'shipping_method',
    ];

    protected $primaryKey = 'shipping_id';

    public $timestamps = false;

    public function array_order()
    {
        return $this->hasMany('App\Models\Order', 'order_id', 'shipping_id');
    }
}
