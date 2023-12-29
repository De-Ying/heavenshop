<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Admin;
use Closure;

class CheckPermissionAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        // Lấy tất cả các quyền khi user login vào hệ thống
        // 1. Lấy tất cả role của user
        // 1.1.
        // $listRoleOfUser = DB::table('users')
        // ->join('role_user', 'users.id', '=', 'role_user.user_id')
        // ->join('roles', 'role_user.role_id', '=', 'roles.id')
        // ->where('users.id', auth()->id())
        // ->select('roles.*')
        // ->get()->pluck('id')->toArray();

        // 1.2.
        $listRoleOfAdmin = Admin::find(Auth::guard('admin')->user()->id)->roles()->select('roles.id')->pluck('id')->toArray();

        // 2. Lấy tất cả các quyền khi user login vào hệ thống

        $listRoleOfAdmin = DB::table('roles')
        ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->whereIn('roles.id', $listRoleOfAdmin)
        ->select('permissions.*')
        ->get()->pluck('id')->unique();  // Gộp bản ghi cùng id

        // 3. Lấy tất cả các quyền khi user login vào hệ thống
        $checkPermission = Permission::where('name', $permission)->value('id');  // Hàm value lấy 1 instance

        // 4. Lấy ra mã màn hình tương ứng để check phân quyền
        if($listRoleOfAdmin->contains($checkPermission)){
            return $next($request);
        }

        // return abort(401);
        Toastr::error('Bạn cần phải cấp quyền để thực hiện chức năng này!','Error');
        return redirect()->back();
    }
}
