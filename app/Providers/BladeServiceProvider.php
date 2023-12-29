<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasRole', function ($expression) // expression chứa quyền author, admin, user
        {
            if(Auth::guard('admin')->user()){
                if(Auth::guard('admin')->user()->hasAnyRoles($expression)){
                    return true;
                }
            }
            return false;
        });
    }
}
