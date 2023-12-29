<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SupplierImport;
use App\Exports\SupplierExport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    // GET: Hiển thị nhà cung cấp
    public function view_all()
    {
        $suppliers = Supplier::get();

        return view('admin.supplier.view_all', [
            'suppliers' => $suppliers,
        ]);
    }

    // GET: Hiển thị form thêm
    public function view_insert()
    {
        return view('admin.supplier.view_insert');
    }

    // GET: Uncctive trạng thái
    public function unactive_supplier($supplier_id)
    {
        try {
            DB::beginTransaction();
            Supplier::where('supplier_id', $supplier_id)->update(['supplier_status' => 0]);
            Toastr::success('Ẩn nhà cung cấp thành công','Success');
            DB::commit();
            return Redirect::to('admin/supplier/');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::to('admin/supplier/');
        }
    }

    // GET: Active trạng thái
    public function active_supplier($supplier_id)
    {
        try {
            DB::beginTransaction();
            Supplier::where('supplier_id', $supplier_id)->update(['supplier_status' => 1]);
            Toastr::success('Hiển thị nhà cung cấp thành công','Success');
            DB::commit();
            return Redirect::to('admin/supplier/');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::to('admin/supplier/');
        }
    }

    // POST: Xử lý thêm nhà cung cấp
    public function process_insert(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                DB::beginTransaction();
                $data = array();

                $data['supplier_name']     = $request->supplier_name;
                $data['supplier_phone']    = $request->supplier_phone;
                $data['supplier_address']  = $request->supplier_address;
                $data['supplier_email']    = $request->supplier_email;

                $get_image = $request->file('supplier_image');

                $path         = 'public/uploads/supplier/';

                if ($get_image) {
                    // Lấy tên ảnh
                    $get_name_image = $get_image->getClientOriginalName();
                    // Sử dụng hàm tách chuỗi
                    $name_image = current(explode('.', $get_name_image));
                    // Lấy đuôi mở rộng của hình ảnh
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move($path, $new_image);
                    $data['supplier_image']   = $new_image;
                }

                Supplier::create($data);
                Toastr::success('Thêm nhà cung cấp thành công','Success');
                DB::commit();
                return redirect()->route('supplier.view_all');

            } catch (\Throwable $th) {
                Toastr::error('Thêm nhà cung cấp thất bại','Error');
                DB::rollBack();
                return redirect()->route('supplier.view_insert');
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('supplier.view_insert');
        }
    }

    // GET: Hiển thị form sửa
    public function view_update($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);

        return view('admin.supplier.view_update')->with('supplier', $supplier);
    }

    // POST: Xử lý cập nhật
    public function process_update(Request $request, $supplier_id)
    {
        try {
            DB::beginTransaction();
            $data = array();

            $data['supplier_name']     = $request->supplier_name;
            $data['supplier_phone']    = $request->supplier_phone;
            $data['supplier_address']  = $request->supplier_address;
            $data['supplier_email']    = $request->supplier_email;

            $get_image = $request->file('supplier_image');

            $path         = 'public/uploads/supplier/';

            if ($get_image) {
                // Lấy tên ảnh
                $get_name_image = $get_image->getClientOriginalName();
                // Sử dụng hàm tách chuỗi
                $name_image = current(explode('.', $get_name_image));
                // Lấy đuôi mở rộng của hình ảnh
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['supplier_image']   = $new_image;
                $supplier = Supplier::find($supplier_id);
                unlink($path.$supplier->supplier_image);
                $supplier->update($data);

                Toastr::success('Cập nhật nhà cung cấp thành công','Success');
                DB::commit();
                return redirect()->route('supplier.view_all');
            }

            Supplier::find($supplier_id)->update($data);
            Toastr::success('Cập nhật nhà cung cấp thành công','Success');
            DB::commit();
            return redirect()->route('supplier.view_all');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    // GET: Xoá nhà cung cấp
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction(); // Bảo toàn tính toàn vẹn dữ liệu
            $data = $request->all();
            $supplier = Supplier::findOrFail($data['supplier_id']);
            $supplier->delete();
            Toastr::success('Xóa nhà cung cấp thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function import_supplier_excel(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new SupplierImport, $request->supplier_import);
            Toastr::success('Nhập dữ liệu thành công','Success');
            DB::commit();
            return redirect()->route('supplier.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Nhập dữ liệu thất bại','Error');
            DB::rollBack();
            return redirect()->route('supplier.view_all');
        }
    }

    // POST: Export dữ liệu
    public function export_supplier_excel()
    {
    return Excel::download(new SupplierExport, 'HV_export_supplier.xlsx');
    }
}
