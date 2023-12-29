<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'contact_address',
        'contact_phone',
        'contact_email',
        'contact_url_fanpage',
        'contact_map',
        'contact_fanpage',
        'contact_status',
    ];

    protected $primaryKey = 'contact_id';

    public $timestamps = false;
}
