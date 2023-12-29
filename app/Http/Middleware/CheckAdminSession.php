<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return $next($request);
        }else{
            if(Auth::guard('admin')->user()->hasRole('administrator')){
                return redirect()->route('dashboard');
            }elseif(Auth::guard('admin')->user()->hasRole('merchandiser')){
                return redirect()->route('dashboardMC');
            }elseif(Auth::guard('admin')->user()->hasRole('product-management')){
                return redirect()->route('dashboardPCM');
            }elseif(Auth::guard('admin')->user()->hasRole('post-management')){
                return redirect()->route('dashboardPSM');
            }elseif(Auth::guard('admin')->user()->hasRole('interface-management')){
                return redirect()->route('dashboardIM');
            }elseif(Auth::guard('admin')->user()->hasRole('customer-care')){
                return redirect()->route('dashboardCC');
            }
       }
    }
}
