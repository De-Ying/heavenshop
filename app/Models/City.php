<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'city_name',
        'city_type',
    ];

    protected $primaryKey = 'city_id';

    public $timestamps = false;
}
