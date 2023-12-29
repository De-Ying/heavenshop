<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * GET: Danh sách quyền
     *
     * @return void
    */

    public function view_all()
    {
        $listPermission = Permission::all();
        return view('admin.permissions.view_all')->with('listPermission', $listPermission);
    }

    /**
     * GET: Hiển thị form thêm quyền
     *
     * @return void
    */

    public function view_insert()
    {
        return view('admin.permissions.view_insert');
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
            Permission::create($request->all());
            Toastr::success('Thêm quyền thành công','Success');
            DB::commit();
            return redirect()->route('permissions.view_all');
        } catch (\Exception $ex) {
            Toastr::error('Thêm quyền thất bại','Error');
            DB::rollBack();
            // Log::error("Loi: " . $ex->getMessage() . $ex->getLine());
            return redirect()->route('permissions.view_all');
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
        $permission = Permission::find($id);

        return view('admin.permissions.view_update', [
            'permission'            => $permission,
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
            Permission::find($id)->update($request->all());
            Toastr::success('Cập nhật quyền thành công','Success');
            DB::commit();
            return redirect()->route('permissions.view_all');
        } catch (\Exception $ex) {
            Toastr::error('Cập nhật quyền thất bại','Error');
            DB::rollBack();
            // Log::error("Loi: " . $ex->getMessage() . $ex->getLine());
            return redirect()->route('permissions.view_all');
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
            $permissionsDelete = Permission::find($data['id']);
            $permissionsDelete->delete();
            Toastr::success('Xóa quyền thành công','Success');
            DB::commit();
            return redirect()->route('permissions.view_all');
        } catch (\Exception $ex) {
            Toastr::error('Xóa quyền thất bại','Error');
            DB::rollBack();
            return redirect()->route('permissions.view_all')->with('error', 'Xóa quyền thất bại');
        }
    }
}
