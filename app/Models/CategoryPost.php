<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_posts';

    protected $fillable = [
        'category_post_name',
        'category_post_slug',
        'category_post_description',
        'category_post_status',
    ];

    protected $primaryKey = 'category_post_id';

    public $timestamps = false;

    public function array_post()
    {
        return $this->hasMany('App\Models\Posts', 'post_id', 'category_post_id');
    }
}
