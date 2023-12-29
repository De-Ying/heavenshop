<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'post_title',
        'post_image',
        'post_slug',
        'post_description',
        'post_content',
        'post_date',
        'post_view',
        'post_status',
        'post_author',
        'category_post_id',
    ];

    protected $primaryKey = 'post_id';

    public $timestamps = false;

    public function cate_post()
    {
        return $this->belongsTo('App\Models\CategoryPost', 'category_post_id');
    }
}
