<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Posts;

use Carbon\Carbon;

class HomeController extends Controller
{
    // GET: Trang chủ
    public function home_page()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Trang chủ";

        $categories = Category::where('category_status', 1)->orderBy('category_id', 'DESC')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('brand_id', 'DESC')->get();
        $sliders = Slider::where([
            ['slider_status', 1],
            ['slider_type', 1]
        ])->orderBy('slider_id', 'ASC')->take(4)->get();

        $banners = Slider::where([
            ['slider_status', 1],
            ['slider_type', 2]
        ])->orderBy('slider_id', 'ASC')->take(3)->get();

        $addWeek  = Carbon::now('Asia/Ho_Chi_Minh')->adddays(7)->toDateString();

        $new_product = Product::where([
            ['product_status', 1],
            ['product_date', '<', $addWeek]
        ])->get();

        // $newProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        $featured_product = Product::where([
            ['product_status', 1],
            ['product_view', '>',  20]
        ])->get();

        $selling_product = Product::where([
            ['product_status', 1],
            ['product_sold', '>',  20]
        ])->get();

        $posts = Posts::where('post_status', 1)->get();

        return view('pages.home', [
            'meta_title'  => $meta_title,
            'sliders'     => $sliders,
            'banners'     => $banners,
            'posts'       => $posts,
            'new_product' => $new_product,
            'featured_product' => $featured_product,
            'selling_product' => $selling_product
        ]);
    }

    // POST: Xử lý tìm kiếm sản phẩm
    public function search(Request $request)
    {
        try {
            DB::beginTransaction();

            $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Tìm kiếm sản phẩm";
            $keyword = $request->keyword;

            $search_product = Product::where([
                ['product_status', 1],
                ['product_name', 'LIKE', '%'.$keyword.'%'],
            ])->paginate(12);

            $count_search_product = $search_product->count();

            // $search_product->appends($request->all());

            return view('pages.product.search_product', [
                'meta_title'           => $meta_title,
                'search_product'       => $search_product,
                'keyword'              => $keyword,
                'count_search_product' => $count_search_product
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    // POST: Xử lý tự động tìm kiếm sản phẩm
    public function fetch_data_search(Request $request)
    {
        $data = $request->all();

        if($data['searchText']){
            $fetch_data = Product::where([
                ['product_status', 1],
                ['product_name', 'LIKE', '%'.$data['searchText'].'%'],
            ])->get();

            $count_search_product = $fetch_data->count();
            if ($count_search_product > 0) {
                $output = '<ul class="dropdown-search" style="overflow-y: scroll; height: 300px;">';

                foreach ($fetch_data as $value) {
                    $product_url = url('public/uploads/product/'.$value->product_image);

                    $output .= '
                        <li>
                            <img src="'.$product_url.'" alt="'.$value->product_name.'">
                            <a href="#">'.$value->product_name.'</a>
                        </li>
                    ';
                }

                $output .= '</ul>';
                echo $output;
            } else {
                $output = '<ul class="dropdown-search" >';
                    $output .= '
                    <li class="hideAllAtr">
                        Tìm kiếm sản phẩm chưa phù hợp
                    </li>
                ';
                $output .= '</ul>';
                echo $output;
            }
        }
    }
}
