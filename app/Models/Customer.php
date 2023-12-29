<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name',
        'customer_image',
        'customer_phone',
        'customer_address',
        'customer_email',
        'customer_password',
        'customer_vip',
        'customer_social',
        'customer_status',
    ];

    public $timestamps = false;

    public function array_order()
    {
        return $this->hasMany(Order::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }
}
