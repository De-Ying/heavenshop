<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'comment_content',
        'comment_like',
        'comment_dislike',
        'comment_status',
        'parent_id',
        'admin_id',
        'product_id',
        'customer_id',
        'comment_date',
    ];

    protected $primaryKey = 'comment_id';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

}
