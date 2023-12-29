<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'category_name',
        'category_slug',
        'category_parent',
        'category_status'
    ];

    protected $primaryKey = 'category_id';

    public $timestamps = false;

    public function array_product()
    {
        return $this->hasMany('App\Models\Product', 'product_id', 'category_id');
    }
}
