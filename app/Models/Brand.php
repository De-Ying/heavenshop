<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [
        'brand_name',
        'brand_slug',
        'brand_status',
    ];

    protected $primaryKey = 'brand_id';

    public $timestamps = false;

    public function array_product()
    {
        return $this->hasMany('App\Models\Product', 'product_id', 'brand_id');
    }
}
