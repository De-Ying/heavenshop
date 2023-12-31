<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';

    protected $fillable = [
        'rating',
        'customer_id',
        'product_id'
    ];

    protected $primaryKey = 'rating_id';

    public $timestamps = false;

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
