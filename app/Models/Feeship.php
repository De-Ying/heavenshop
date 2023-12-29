<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    protected $table = 'feeship';

    protected $fillable = [
        'city_id',
        'district_id',
        'commune_id',
        'fee_feeship',
    ];

    protected $primaryKey = 'fee_id';

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function commune()
    {
        return $this->belongsTo('App\Models\Commune', 'commune_id');
    }
}
