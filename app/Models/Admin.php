<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use Notifiable;

    protected $table = 'admins';
    protected $guard = 'admin';

    protected $fillable = [
        'full_name',
        'user_name',
        'email',
        'password',
        'avatar',
        'phone',
        'address',
        'gender',
    ];

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_admin');
    }

    public function hasAnyRoles($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
