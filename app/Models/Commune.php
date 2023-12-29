<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';

    protected $fillable = [
        'commune_name',
        'commune_type',
        'district_id',
    ];

    protected $primaryKey = 'commune_id';

    public $timestamps = false;
}
