<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * GET: Danh sách slide
     *
     * @return void
    */

    public function view_all()
    {
        $sliders = Slider::orderBy('slider_id', 'DESC')->get();

        return view('admin.slider.view_all', [
            'sliders' => $sliders
        ]);
    }

    /**
     * GET: Hiển thị form thêm
     *
     * @return void
    */

    public function view_insert()
    {
        return view('admin.slider.view_insert');
    }

    /**
     * GET: Uncctive trạng thái
     *
     * @param  mixed $slider_id
     * @return void
    */

    public function unactive_slider($slider_id)
    {
        Slider::where('slider_id', $slider_id)->update(['slider_status' => 0]);
        Toastr::success('Ẩn slide thành công','Success');
        return Redirect::to('admin/slider/');
    }

    /**
     * GET: Active trạng thái
     *
     * @param  mixed $slider_id
     * @return void
    */

    public function active_slider($slider_id)
    {
        Slider::where('slider_id', $slider_id)->update(['slider_status' => 1]);
        Toastr::success('Hiển thị slide thành công','Success');
        return Redirect::to('admin/slider/');
    }

    /**
     * POST: Xử lý thêm slide
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        if( $request->isMethod('POST') ) {
            try {
                $data = array();
                $data['slider_name'] = $request->slider_name;
                $data['slider_description'] = $request->slider_description;
                $data['slider_type'] = $request->slider_type;

                $path         = 'public/uploads/slider/';

                $get_image = $request->file('slider_image');
                if($get_image){
                    // Lấy tên ảnh
                    $get_name_image = $get_image->getClientOriginalName();
                    // Sử dụng hàm tách chuỗi
                    $name_image = current(explode('.', $get_name_image));
                    // Lấy đuôi mở rộng của hình ảnh
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move($path, $new_image);
                    $data['slider_image'] = $new_image;
                    Slider::create($data);
                    Toastr::success('Thêm slide thành công','Success');
                    return redirect()->route('slider.view_all');
                }
                Slider::create($data);
                Toastr::success('Thêm slide thành công','Success');
                return redirect()->route('slider.view_all');
            } catch (\Throwable $th) {
                Toastr::error('Thêm slide thất bại','Error');
                return redirect()->route('slider.view_insert');
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('slider.view_insert');
        }
    }

    /**
     * GET: Hiển thị form cập nhật slide
     *
     * @param  mixed $slider_id
     * @return void
    */

    public function view_update($slider_id)
    {
        $slider = Slider::find($slider_id);

        return view('admin.slider.view_update', [
            'slider' => $slider,
        ]);
    }

    /**
     * POST: Xử lý cập nhật
     *
     * @param  mixed $request
     * @param  mixed $slider_id
     * @return void
    */

    public function process_update(Request $request, $slider_id)
    {
        try {
            DB::beginTransaction();
            $data = array();
            $data['slider_name'] = $request->slider_name;
            $data['slider_description'] = $request->slider_description;
            $data['slider_type'] = $request->slider_type;

            $get_image = $request->file('slider_image');

            $path         = 'public/uploads/slider/';

            if($get_image){
                // Lấy tên ảnh
                $get_name_image = $get_image->getClientOriginalName();
                // Sử dụng hàm tách chuỗi
                $name_image = current(explode('.', $get_name_image));
                // Lấy đuôi mở rộng của hình ảnh
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['slider_image'] = $new_image;
                $slider = Slider::find($slider_id);
                unlink($path.$slider->slider_image);
                $slider->update($data);
                Toastr::success('Cập nhật slide thành công','Success');
                return redirect()->route('slider.view_all');
            }
            Slider::find($slider_id)->update($data);
            Toastr::success('Cập nhật slide thành công','Success');
            DB::commit();
            return redirect()->route('slider.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật slide thất bại','Error');
            DB::rollBack();
            return redirect()->route('slider.view_all');
        }
    }

    // GET: Xoá slide
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $slider = Slider::findOrFail($data['slider_id']);
            $slider->delete();
            Toastr::success('Xóa slide thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa slide thất bại','Error');
            DB::rollBack();
        }
    }
}
