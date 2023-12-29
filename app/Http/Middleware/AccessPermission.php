<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use Closure;

class AccessPermission
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
        if(Auth::guard('admin')->user()->hasAnyRoles(['administrator', 'product-management'])){
            return $next($request);
        }

        Toastr::error('Bạn cần phải cấp quyền để thực hiện chức năng này!','Error');
        return redirect()->back();
    }
}
