<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'gallery_name',
        'gallery_image',
        'product_id',
    ];

    protected $primaryKey = 'gallery_id';

    public $timestamps = false;
}
