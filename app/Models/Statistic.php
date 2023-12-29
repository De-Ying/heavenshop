<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistical';

    protected $fillable = [
        'order_date',
        'funds',
        'sales',
        'profit',
        'quantity',
        'total_order'
    ];

    protected $primaryKey = 'statistical_id';

    public $timestamps = false;
}
