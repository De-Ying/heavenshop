<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Imports\BrandImport;
use App\Exports\BrandExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class BrandController extends Controller
{
    /**
     * GET: Hiển thị thương hiệu
     *
     * @return void
    */

    public function view_all()
    {
        $brands = Brand::get();

        return view('admin.brand.view_all', [
            'brands' => $brands,
        ]);
    }

    public function view_insert()
    {
        return view('admin.brand.view_insert');
    }

    /**
     * POST: Xử lý thêm thương hiệu
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        try {
            DB::beginTransaction();
            Brand::create($request->all());
            Toastr::success('Thêm thương hiệu thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Thêm thương hiệu thất bại','Error');
            DB::rollBack();
        }
    }

    public function view_update($brand_id)
    {
        $brand = Brand::find($brand_id);
        return view('admin.brand.view_update')->with('brand', $brand);
    }

    /**
     * POST: Xử lý cập nhật thương hiệu
     *
     * @param  mixed $request
     * @return void
    */

    public function process_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            Brand::find($data['brand_id'])->update($data);
            Toastr::success('Cập nhật thương hiệu thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật thương hiệu thất bại','Error');
            DB::rollBack();
        }
    }

    /**
     * GET: Ẩn thương hiệu
     *
     * @param  mixed $brand_id
     * @return void
    */

    public function unactive_brand_product($brand_id)
    {
        try {
            DB::beginTransaction();
            Brand::where('brand_id', $brand_id)->update(['brand_status' => 0]);
            Toastr::success('Ẩn thương hiệu thành công', 'Success');
            DB::commit();
            return Redirect::to('admin/brand/');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * GET: Hiển thị thương hiệu
     *
     * @param  mixed $brand_id
     * @return void
    */

    public function active_brand_product($brand_id)
    {
        try {
            DB::beginTransaction();
            Brand::where('brand_id', $brand_id)->update(['brand_status' => 1]);
            Toastr::success('Hiển thị thương hiệu thành công', 'Success');
            DB::commit();
            return Redirect::to('admin/brand/');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * GET: Xoá thương hiệu
     *
     * @param  mixed $request
     * @return void
    */

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $brand = Brand::findOrFail($data['brand_id']);
            $brand->delete();
            Toastr::success('Xóa thương hiệu thành công', 'Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa thương hiệu thất bại', 'Error');
            DB::rollBack();
        }
    }

    /**
     * POST: Nhập dữ liệu
     *
     * @param  mixed $request
     * @return void
    */

    public function import_brand_excel(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new BrandImport, $request->brand_import);
            Toastr::success('Nhập dữ liệu thành công','Success');
            DB::commit();
            return redirect()->route('brand.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Nhập dữ liệu thất bại','Error');
            DB::rollBack();
            return redirect()->route('brand.view_all');
        }
    }

    /**
     * POST: Xuất dữ liệu
     *
     * @return void
    */

    public function export_brand_excel()
    {
        return Excel::download(new BrandExport, 'HV_export_brand.xlsx');
    }

}
