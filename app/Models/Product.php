<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_quantity',
        'product_sold',
        'product_slug',
        'product_description',
        'product_content',
        'product_tags',
        'product_cost_price',
        'product_price',
        'product_image',
        'product_view',
        'product_status',
        'category_id',
        'brand_id',
        'supplier_id',
        'product_date',
    ];

    protected $primaryKey = 'product_id';

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function array_order_details()
    {
        return $this->hasMany('App\Models\OrderDetails', 'product_id', 'product_id');
    }

    public function array_comment()
    {
        return $this->hasMany('App\Models\Comment', 'comment_id', 'product_id');
    }

    public function rating(){
        return $this->hasMany('App\Models\Rating');
    }

    public function wishlist(){
        return $this->hasMany('App\Models\Wishlist');
    }

}
