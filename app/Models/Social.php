<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'social';

    protected $fillable = [
        'provider_user_id',
        'provider_user_email',
        'provider',
        'user'
    ];

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'user');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'user');
    }
}
