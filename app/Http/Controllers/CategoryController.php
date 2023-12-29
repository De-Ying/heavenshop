<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Category;

use App\Imports\CategoryImport;
use App\Exports\CategoryExport;

class CategoryController extends Controller
{
    /**
     * GET: Hiển thị danh mục sản phẩm
     *
     * @return void
    */

    public function view_all()
    {
        $category = Category::orderBy('category_parent','DESC')->get();
        $subcategory = Category::where('category_parent',0)->orderBy('category_id','DESC')->get();

        return view('admin.category.view_all', [
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }

    public function view_insert()
    {
        $subcategory = Category::where('category_parent',0)->orderBy('category_id','DESC')->get();
        return view('admin.category.view_insert')->with('subcategory', $subcategory);
    }

    /**
     * POST: Xử lý thêm danh mục sản phẩm
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        try {
            DB::beginTransaction();
            Category::create($request->all());
            Toastr::success('Thêm danh mục thành công','Success');
            DB::commit();
            return redirect()->route('category.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Thêm danh mục thất bại','Error');
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * GET: Hiển thị form sửa danh mục sản phẩm
     *
     * @param  mixed $category_id
     * @return void
    */

    public function view_update($category_id)
    {
        $categories = Category::orderBy('category_id','DESC')->get();
        $category   = Category::find($category_id);

        return view('admin.category.view_update', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    /**
     * POST: Xử lý cập nhật
     *
     * @param  mixed $request
     * @param  mixed $category_id
     * @return void
    */

    public function process_update(Request $request, $category_id)
    {
        try {
            DB::beginTransaction();
            Category::find($category_id)->update($request->all());
            Toastr::success('Cập nhật danh mục thành công','Success');
            DB::commit();
            return redirect()->route('category.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật danh mục thất bại','Error');
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * GET: Xoá danh mục
     *
     * @param  mixed $request
     * @return void
    */

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $category = Category::findOrFail($data['category_id']);
            $category->delete();
            Toastr::success('Xóa danh mục thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa danh mục thất bại','Error');
            DB::rollBack();
        }
    }

    /**
     * GET: Ẩn danh mục
     *
     * @param  mixed $category_id
     * @return void
    */

    public function unactive_category_product($category_id)
    {
        try {
            DB::beginTransaction();
            Category::where('category_id', $category_id)->update(['category_status' => 0]);
            Toastr::success('Ẩn danh mục thành công','Success');
            DB::commit();
            return Redirect::to('admin/category/');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * GET: Hiện danh mục
     *
     * @param  mixed $category_id
     * @return void
    */

    public function active_category_product($category_id)
    {
        try {
            DB::beginTransaction();
            Category::where('category_id', $category_id)->update(['category_status' => 1]);
            Toastr::success('Hiện danh mục thành công','Success');
            DB::commit();
            return Redirect::to('admin/category/');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * POST: Nhập dữ liệu từ Excel
     *
     * @param  mixed $request
     * @return void
    */

    public function import_category_excel(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new CategoryImport, $request->category_import);
            Toastr::success('Nhập dữ liệu thành công','Success');
            DB::commit();
            return redirect()->route('category.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Nhập dữ liệu thất bại','Error');
            DB::rollBack();
            return redirect()->route('category.view_all');
        }
    }

    /**
     * POST: Xuất dữ liệu từ Hệ thống
     *
     * @return void
    */

    public function export_category_excel()
    {
        return Excel::download(new CategoryExport, 'HV-export-category.xlsx');
    }
}
