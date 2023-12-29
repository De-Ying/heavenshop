<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'supplier_name',
        'supplier_image',
        'supplier_phone',
        'supplier_address',
        'supplier_email',
        'supplier_status',
    ];

    protected $primaryKey = 'supplier_id';

    public $timestamps = false;

    public function array_product()
    {
        return $this->hasMany('App\Models\Product', 'product_id', 'supplier_id');
    }
}
