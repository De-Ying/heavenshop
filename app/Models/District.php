<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'district_name',
        'district_type',
        'city_id',
    ];

    protected $primaryKey = 'district_id';

    public $timestamps = false;
}
