<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'slider_name',
        'slider_image',
        'slider_type',
        'slider_status',
        'slider_description',
    ];

    protected $primaryKey = 'slider_id';

    public $timestamps = false;

}
