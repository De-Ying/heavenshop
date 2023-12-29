<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view_all()
    {
        $listUser = Admin::all();
        $listRole = Role::all();

        $role_admin = DB::table('role_admin')
        ->selectRaw("admins.*, roles.name, role_admin.admin_id")
        ->join('admins', 'admins.id', '=' ,'role_admin.admin_id')
        ->join('roles', 'roles.id', '=', 'role_admin.role_id')
        ->get();


        $permission_role = DB::table('role_admin')
        ->join('admins', 'admins.id', '=' ,'role_admin.admin_id')
        ->join('roles', 'roles.id', '=', 'role_admin.role_id')
        ->join('permission_role', 'permission_role.role_id', 'roles.id')
        ->join('permissions', 'permissions.id', 'permission_role.permission_id')
        ->get();

        return view('admin.users.view_all', [
            'listUser'        => $listUser,
            'listRole'        => $listRole,
            'role_admin'      => $role_admin,
            'permission_role' => $permission_role
        ]);
    }

    public function view_insert()
    {
        $roles = Role::all();
        return view('admin.users.view_insert')->with('roles', $roles);
    }

    public function process_insert(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $get_image = $request->file('avatar');

            $path      = 'public/uploads/avatar/';

            $data['password'] = Hash::make($data['password']);

            if ($get_image) {
                // Lấy tên ảnh
                $get_name_image = $get_image->getClientOriginalName();
                // Sử dụng hàm tách chuỗi
                $name_image = current(explode('.', $get_name_image));
                // Lấy đuôi mở rộng của hình ảnh
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['avatar']   = $new_image;
            }
            $userCreate = Admin::create($data);

            $userCreate->roles()->attach($data['roles']);

            // $roles = $request->roles;
            // foreach ($roles as $roleId) {
            //     DB::table('role_user')->insert([
            //         'user_id'  => $userCreate->id,
            //         'role_id'  => $roleId
            //     ]);
            // }
            Toastr::success('Thêm người dùng thành công','Success');
            DB::commit();
            return redirect()->route('users.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Thêm người dùng thất bại','Error');
            DB::rollBack();
            return redirect()->route('users.view_all');
        }
    }

    /**
     *  Show form edit
     */

    public function view_update($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();

        $listRoleOfUser = DB::table('role_admin')->where('admin_id', $id)->pluck('role_id');

        return view('admin.users.view_update', [
            'admin'          => $admin,
            'roles'          => $roles,
            'listRoleOfUser' => $listRoleOfUser
        ]);
    }

    public function view_role($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();

        $listRoleOfUser = DB::table('role_admin')->where('admin_id', $id)->pluck('role_id');

        return view('admin.users.view_role', [
            'admin'          => $admin,
            'roles'          => $roles,
            'listRoleOfUser' => $listRoleOfUser
        ]);
    }

    public function process_role(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $roles = $request->roles;
            $admin = Admin::find($id);
            DB::table('role_admin')->where('admin_id', $id)->delete();
            $admin->roles()->attach($roles);
            Toastr::success('Cấp quyền người dùng thành công','Success');
            DB::commit();
            return redirect()->route('users.view_all');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }


    /**
     *  Update user
     */

    public function process_update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = array();

            $data['full_name'] = $request->full_name;
            $data['user_name'] = $request->user_name;
            $data['email']     = $request->email;
            $data['password']  = Hash::make($request->password);
            $data['phone']     = $request->phone;
            $data['address']   = $request->address;
            $data['gender']    = $request->gender;
            $data['status']    = $request->status;
            $data['roles']     = $request->roles;

            $get_image = $request->file('avatar');
            $path      = 'public/uploads/avatar/';

            if($get_image){
                // Lấy tên ảnh
                $get_name_image = $get_image->getClientOriginalName();
                // Sử dụng hàm tách chuỗi
                $name_image = current(explode('.', $get_name_image));
                // Lấy đuôi mở rộng của hình ảnh
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['avatar'] = $new_image;

                $admin = Admin::find($id);

                if($admin->avatar != NULL){
                    unlink($path.$admin->avatar);
                }

                $admin->update($data);

                DB::table('role_admin')->where('admin_id', $id)->delete();
                $admin->roles()->attach($data['roles']);
                Toastr::success('Cập nhật người dùng thành công','Success');
                DB::commit();
                return redirect()->route('users.view_all');
            }

            Admin::find($id)->update($data);

            DB::table('role_admin')->where('admin_id', $id)->delete();
            $admin = Admin::find($id);
            $admin->roles()->attach($data['roles']);
            Toastr::success('Cập nhật người dùng thành công','Success');
            DB::commit();
            return redirect()->route('users.view_all');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }



    /**
     *  Delete user
    */

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $userDelete = Admin::find($data['id']);
            $userDelete->delete();
            $userDelete->roles()->detach();
            Toastr::success('Xóa người dùng thành công','Success');
            DB::commit();
            return redirect()->route('users.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Xóa người dùng thất bại','Error');
            DB::rollBack();
            return redirect()->route('users.view_all');
        }
    }
}
