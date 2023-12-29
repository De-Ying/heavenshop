<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = "wishlists";

    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    public $timestamps = false;

    protected $primaryKey = 'wishlist_id';

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
