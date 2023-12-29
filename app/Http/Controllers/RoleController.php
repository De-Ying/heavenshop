<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * GET: Danh sách quyền
     *
     * @return void
     */
    public function view_all()
    {
        $listRole = Role::all();
        return view('admin.roles.view_all')->with('listRole', $listRole);
    }

    /**
     * GET: Hiển thị form thêm quyền
     *
     * @return void
    */

    public function view_insert()
    {
        $listPermission = Permission::all();
        return view('admin.roles.view_insert')->with('listPermission', $listPermission);
    }

    /**
     * POST: Xử lý thêm quyền
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        try {
            DB::beginTransaction(); // Bảo toàn tính toàn vẹn dữ liệu

            $rolesCreate = Role::create([
                'name'            => $request->name,
                'display_name'    => $request->display_name
            ]);

            $rolesCreate->permissions()->attach($request->permissions);
            Toastr::success('Thêm vai trò thành công','Success');
            DB::commit();
            return redirect()->route('roles.view_all');
        } catch (\Exception $ex) {
            Toastr::error('Thêm vai trò thất bại','Error');
            DB::rollBack();
            return redirect()->route('roles.view_all');
        }
    }

    /**
     * GET: Hiển thị form cập nhật
     *
     * @param  mixed $id
     * @return void
    */

    public function view_update($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.view_update', [
            'role'                   => $role,
        ]);
    }

    /**
     * POST: Xử lý cập nhật quyền
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
    */

    public function process_update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            Role::Where('id', $id)->update([
                'name'           => $request->name,
                'display_name'   => $request->display_name
            ]);

            DB::table('permission_role')->where('role_id', $id)->delete();
            $rolesCreate = Role::find($id);
            $rolesCreate->permissions()->attach($request->permissions);
            Toastr::success('Cập nhật vai trò thành công','Success');
            DB::commit();
            return redirect()->route('roles.view_all');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('roles.view_all');
        }
    }


    public function view_permission($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $getAllPermissionOfRole = DB::table('permission_role')->where('role_id', $id)->pluck('permission_id');

        return view('admin.roles.view_permission', [
            'role'                   => $role,
            'permissions'            => $permissions,
            'getAllPermissionOfRole' => $getAllPermissionOfRole
        ]);
    }

    public function process_permission(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            DB::table('permission_role')->where('role_id', $id)->delete();
            $rolesCreate = Role::find($id);
            $rolesCreate->permissions()->attach($request->permissions);
            Toastr::success('Cấp quyền thành công','Success');
            DB::commit();
            return redirect()->route('roles.view_all');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('roles.view_all');
        }
    }

    /**
     * GET: Xóa quyền
     *
     * @param  mixed $id
     * @return void
    */

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $rolesDelete = Role::find($data['id']);
            $rolesDelete->delete();

            $rolesDelete->permissions()->detach();
            Toastr::success('Xóa vai trò thành công','Success');
            DB::commit();
            return redirect()->route('roles.view_all');
        } catch (\Exception $ex) {
            Toastr::error('Xóa vai trò thất bại','Error');
            DB::rollBack();
            return redirect()->route('roles.view_all');
        }
    }
}
