<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{

    public function gallery($product_id)
    {
        $galleries = Gallery::where('product_id', $product_id)->get();

        return view('admin.gallery.view_gallery', [
            'galleries'  => $galleries,
            'product_id' => $product_id
        ]);
    }

    public function select_gallery(Request $request)
    {
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '';
        $output .= '<div class="table-responsive">
        <div class="table-content">
            <div class="project-table">
                <form>
                    '.csrf_field().'
                    <table class="table dt-responsive nowrap table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên hình ảnh</th>
                                <th>Hình ành</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';

            if($gallery_count > 0) {
                $i = 1;
                foreach ($gallery as $key => $img) {
                    $output .= '
                        <tr>
                            <td style="width: 10%">' . $i++ .'</td>
                            <td style="width: 50%">' . $img->gallery_name . '</td>
                            <td>
                                <img src="' . url('public/uploads/gallery/'.$img->gallery_image) . '" style="height: 120px; width: 120px;
                                border: 1px solid #ddd; padding: 5px; border-radius: 5px;" class="img-thumbnail">
                                <div id="form-gallery">
                                    <input type="file" name="file" class="file-image" accept="image/*" style="position: absolute;" id="file-'.$img->gallery_id.'" data-gal_id="'.$img->gallery_id.'">
                                </div>
                            </td>
                            <td><button type="button" class="btn btn-xs btn-danger delete-gallery" data-gal_id="'.$img->gallery_id.'">Xóa</button></td>
                        </tr>
                    ';
                }

                $output .= '
                        </tbody>
                    </table>
                </form>
                </div>
        </div>
        </div>

        ';
        }else{
            $output = 'Hiện tại không có dữ liệu';
        }
        echo $output;
    }

    public function insert_gallery(Request $request, $product_id)
    {
        if ($request->isMethod("POST")) {
            try {
                $get_image = $request->file('file');
                if($get_image){
                    foreach ($get_image as $image) {
                        $data = array();
                        // Lấy tên ảnh
                        $get_name_image = $image->getClientOriginalName();
                        // Sử dụng hàm tách chuỗi
                        $name_image = current(explode('.', $get_name_image));
                        // Lấy đuôi mở rộng của hình ảnh
                        $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                        $image->move('public/uploads/gallery', $new_image);

                        $data['gallery_name'] = $name_image;
                        $data['gallery_image'] = $new_image;
                        $data['product_id'] = $product_id;
                        Gallery::create($data);
                    }
                }
                return redirect()->back()->with('success', 'Thêm thư viện ảnh thành công');
            } catch (\Throwable $th) {
                return redirect()->route('gallery', [$product_id]);
            }
        } else {
            return redirect()->route('gallery', [$product_id])->with('warning', 'Phương thức truyền vào không đúng');
        }
    }


    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');
        $gallery_id    = $request->gallery_id;

        if($get_image){
            // Lấy tên ảnh
            $get_name_image = $get_image->getClientOriginalName();
            // Sử dụng hàm tách chuỗi
            $name_image = current(explode('.', $get_name_image));
            // Lấy đuôi mở rộng của hình ảnh
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/gallery', $new_image);

            $gallery = Gallery::find($gallery_id);
            unlink('public/uploads/gallery/'.$gallery->gallery_image);
            $gallery->gallery_name = $name_image;
            $gallery->gallery_image = $new_image;
            $gallery->save();
        }
    }


    public function delete_gallery(Request $request)
    {
        $gallary_id = $request->gallary_id;
        $gallery = Gallery::find($gallary_id);
        unlink('public/uploads/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }
}
