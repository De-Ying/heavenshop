<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ProductImport;
use App\Exports\ProductExport;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Supplier;
use App\Models\Wishlist;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    //TODO: BACKEND

    /**
     * GET: Hiển thị sản phẩm
     *
     * @return void
    */

    public function view_all()
    {
        $categories = Category::where('category_status', 1)->get();

        $subcategory = Category::where('category_parent',0)->orderBy('category_id','DESC')->get();

        $brands     = Brand::where('brand_status', 1)->get();

        $products   = Product::with('category')
        ->with('brand')
        ->with('supplier')
        ->orderBy('product_id', 'DESC')
        ->get();

        $suppliers  = Supplier::where('supplier_status', 1)->get();

        return view('admin.product.view_all', [
            'categories'  => $categories,
            'subcategory' => $subcategory,
            'brands'      => $brands,
            'products'    => $products,
            'suppliers'   => $suppliers,
        ]);
    }


    /**
     * POST: Tìm kiếm sản phẩm
     *
     * @param  mixed $request
     * @return void
    */

    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::where('category_status', 1)->get();

        $subcategory = Category::where([
            ['category_parent', 0],
            ['category_status', 1]
        ])->orderBy('category_id','DESC')->get();

        $brands     = Brand::where('brand_status', 1)->get();

        $products = Product::query()
        ->where('product_name', 'LIKE', "%{$search}%")
        ->paginate(10);

        $products->appends($request->all());

        return view('admin.product.search', [
            'categories' => $categories,
            'brands'     => $brands,
            'products'   => $products,
            'search'     => $search
        ]);
    }

    /**
     * POST: Lọc sản phẩm
     *
     * @param  mixed $request
     * @return void
    */

    public function filter(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                $filterCate   = $request->filterCate;
                $filterBrand  = $request->filterBrand;
                $filterStatus = $request->filterStatus;

                $categories = Category::where('category_status', 1)->get();
                $brands     = Brand::where('brand_status', 1)->get();
                $status = Product::where('product_status', $filterStatus)->get();

                if(isset($filterCate) && isset($filterBrand) && isset($filterStatus)){
                    $products = Product::where([
                        ['category_id', $filterCate],
                        ['brand_id', $filterBrand],
                        ['product_status', $filterStatus]
                    ])->paginate(10);
                }elseif(isset($filterCate) && isset($filterBrand)){
                    $products = Product::where([
                        ['category_id', $filterCate],
                        ['brand_id', $filterBrand]
                    ])->paginate(10);
                }elseif(isset($filterCate) && isset($filterStatus)){
                    $products = Product::where([
                        ['category_id', $filterCate],
                        ['product_status', $filterStatus]
                    ])->paginate(10);
                }elseif(isset($filterBrand) && isset($filterStatus)){
                    $products = Product::where([
                        ['brand_id', $filterBrand],
                        ['product_status', $filterStatus]
                    ])->paginate(10);
                }elseif(isset($filterCate)){
                    $products = Product::where([
                        ['category_id', $filterCate]
                    ])->paginate(10);
                }elseif(isset($filterBrand)){
                    $products = Product::where([
                        ['brand_id', $filterBrand]
                    ])->paginate(10);
                }elseif(isset($filterStatus)){
                    $products = Product::where([
                        ['status', $filterStatus]
                    ])->paginate(10);
                }else{
                    $products   = Product::with('category')
                    ->with('brand')
                    ->with('supplier')
                    ->orderBy('product_id', 'DESC')
                    ->paginate(10);
                }
            } catch (\Throwable $th) {
                return redirect()->route('product.filter');
            }

            return view('admin.product.filter', [
                'categories' => $categories,
                'brands'     => $brands,
                'products'   => $products,
                'filterCate' => $filterCate,
                'filterBrand' => $filterBrand,
                'filterStatus' => $filterStatus,
                'status'   => $status
            ]);
        } else {
            // Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('product.view_all');
        }


    }

    /**
     * GET: Hiển thị form thêm
     *
     * @return void
    */

    public function view_insert()
    {
        $categories = Category::orderBy('category_id', 'DESC')->get();
        $subcategory = Category::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $brands = Brand::orderBy('brand_id', 'DESC')->get();
        $suppliers = Supplier::orderBy('supplier_id', 'DESC')->get();

        return view('admin.product.view_insert', [
            'categories'  => $categories,
            'subcategory' => $subcategory,
            'brands'      => $brands,
            'suppliers'   => $suppliers
        ]);
    }

    /**
     * GET: Uncctive trạng thái
     *
     * @param  mixed $product_id
     * @return void
    */

    public function unactive_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_status' => 0]);
        Toastr::success('Ẩn sản phẩm thành công','Success');
        return Redirect::to('admin/product/');
    }

    /**
     * GET: Active trạng thái
     *
     * @param  mixed $product_id
     * @return void
    */

    public function active_product($product_id)
    {
        Product::where('product_id', $product_id)->update(['product_status' => 1]);
        Toastr::success('Hiển thị sản phẩm thành công','Success');
        return Redirect::to('admin/product/');
    }

    /**
     * POST: Xử lý thêm sản phẩm
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                $data = array();

                $product_cost_price = filter_var($request->product_cost_price, FILTER_SANITIZE_NUMBER_INT);
                $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);

                $data['product_name']        = $request->product_name;
                $data['product_quantity']    = $request->product_quantity;
                $data['product_slug']        = $request->product_slug;
                $data['product_cost_price']  = $product_cost_price;
                $data['product_price']       = $product_price;
                $data['product_description'] = $request->product_description;
                $data['product_content']     = $request->product_content;
                $data['product_tags']        = $request->product_tags;
                $data['category_id']         = $request->product_cate;
                $data['brand_id']            = $request->product_brand;
                $data['supplier_id']         = $request->product_supplier;

                $get_image = $request->file('product_image');

                $path         = 'public/uploads/product/';
                $path_gallery = 'public/uploads/gallery/';

                if ($get_image) {
                    // Lấy tên ảnh
                    $get_name_image = $get_image->getClientOriginalName();
                    // Sử dụng hàm tách chuỗi
                    $name_image = current(explode('.', $get_name_image));
                    // Lấy đuôi mở rộng của hình ảnh
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move($path, $new_image);
                    File::copy($path.$new_image, $path_gallery.$new_image);
                    $data['product_image']   = $new_image;
                }

                $product_id = Product::insertGetId($data);
                $gallery = new Gallery();
                $gallery->gallery_name = $name_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();

                Toastr::success('Thêm sản phẩm thành công','Success');
                return redirect()->route('product.view_all');

            } catch (\Throwable $th) {
                Toastr::error('Thêm sản phẩm không thành công','Error');
                return redirect()->route('product.view_insert');
                // dd($th);
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('product.view_insert');
        }
    }

    /**
     * GET: Hiển thị form sửa sản phẩm
     *
     * @param  mixed $product_id
     * @return void
    */

    public function view_update($product_id)
    {
        $product = Product::find($product_id);
        $categories = Category::orderBy('category_id', 'DESC')->get();
        $brands = Brand::orderBy('brand_id', 'DESC')->get();
        $suppliers = Supplier::orderBy('supplier_id', 'DESC')->get();

        return view('admin.product.view_update', [
            'product'         => $product,
            'categories'      => $categories,
            'brands'          => $brands,
            'suppliers'       => $suppliers
        ]);
    }

    // POST: Xử lý cập nhật
    public function process_update(Request $request, $product_id)
    {
        $data = array();

        $product_cost_price = filter_var($request->product_cost_price, FILTER_SANITIZE_NUMBER_INT);
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);

        $data['product_name']        = $request->product_name;
        $data['product_quantity']    = $request->product_quantity;
        $data['product_slug']        = $request->product_slug;
        $data['product_cost_price']  = $product_cost_price;
        $data['product_price']       = $product_price;
        $data['product_description'] = $request->product_description;
        $data['product_content']     = $request->product_content;
        $data['product_tags']        = $request->product_tags;
        $data['category_id']         = $request->product_cate;
        $data['brand_id']            = $request->product_brand;
        $data['supplier_id']         = $request->product_supplier;

        $get_image = $request->file('product_image');

        $path         = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $data['product_image'] = $new_image;
            $product = Product::find($product_id);
            unlink($path.$product->product_image);
            $product->update($data);

            $gallery = Gallery::find($product_id);
            unlink($path_gallery.$gallery->gallery_image);
            $gallery->gallery_name = $name_image;
            $gallery->gallery_image = $new_image;
            $gallery->save();

            Toastr::success('Cập nhật sản phẩm thành công','Success');
            return redirect()->route('product.view_all');
        }
        Product::find($product_id)->update($data);
        Toastr::success('Cập nhật sản phẩm thành công','Success');
        return redirect()->route('product.view_all');

    }

    // GET: Xoá sản phẩm
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $product = Product::findOrFail($data['product_id']);
            $product->delete();
            Toastr::success('Xóa sản phẩm thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa sản phẩm thất bại','Error');
            DB::rollBack();
        }
    }

    // POST: Upload ảnh cục bộ ckeditor
    public function uploads_ckeditor(Request $request)
    {
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('public/uploads/ckeditor', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    // GET: Lấy ảnh từ cục bộ ckeditor
    public function file_browser(Request $request)
    {
        $paths = glob(public_path('uploads/ckeditor/*'));
        $fileNames = array();
        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }

        $data = array(
            'fileNames' => $fileNames
        );

        return view('admin.images.file_browser')->with($data);
    }

    // POST: Excel
    public function import_product_excel(Request $request)
    {
        try {
            Excel::import(new ProductImport, $request->product_import);
            return redirect()->route('product.view_all')->with('success', 'Import dữ liệu thành công');
        } catch (\Throwable $th) {
            return redirect()->route('product.view_all')->with('error', 'Lỗi Import dữ liệu');
        }
    }

    public function export_product_excel()
    {
        return Excel::download(new ProductExport, 'HV_export_product.xlsx');
    }

    // END BACKEND

    //TODO: FRONTEND

    // GET: Hiển thị sản phẩm
    public function product(Request $request)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Sản phẩm";

        if(isset($_GET['sortBy'])){
            $sortBy = $_GET['sortBy'];

            if($sortBy == 'default'){
                $products = Product::where('product_status', 1)->paginate(12);
            }else if($sortBy == 'alpha-asc'){
                $products = Product::where('product_status', 1)
                ->orderBy('product_name', 'ASC')
                ->paginate(12);
            }else if($sortBy == 'alpha-desc'){
                $products = Product::where('product_status', 1)
                ->orderBy('product_name', 'DESC')
                ->paginate(12);
            }else if($sortBy == 'price-asc'){
                $products = Product::where('product_status', 1)
                ->orderBy('product_price', 'ASC')
                ->paginate(12);
            }else if($sortBy == 'price-desc'){
                $products = Product::where('product_status', 1)
                ->orderBy('product_price', 'DESC')
                ->paginate(12);
            }else if($sortBy == 'created-asc'){
                $now      = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                $products = Product::where([
                    ['product_status', 1],
                    ['product_date', $now]
                ])->paginate(12);
            }else if($sortBy == 'created-desc'){
                $now      = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                $products = Product::where([
                    ['product_status', 1],
                    ['product_date', '<',  $now]
                ])->paginate(12);
            }else{
                $products = Product::where('product_status', 1)
                ->inRandomOrder()
                ->paginate(12);
            }

        }else if(isset($_GET['brand'])){
            $brand_id = Brand::where('brand_slug', $_GET['brand'])->first()->brand_id;

            $products = Product::where([
                ['brand_id', $brand_id],
                ['product_status', 1]
            ])->paginate(12);

        }else if(isset($_GET['filter_price'])){
            $filter_price = explode("-", $_GET['filter_price']);
            $min_price = $filter_price[0];
            $max_price = $filter_price[1];

            $products = Product::where([
                ['product_status', 1],
            ])->whereBetween('product_price', [$min_price, $max_price])
            ->orderBy('product_price', 'DESC')
            ->paginate(12);

        }else{
            $products = Product::where([
                ['product_status', 1]
            ])->inRandomOrder()
            ->paginate(12);
        }

        $categories = Category::where('category_status', 1)
        ->orderBy('category_id', 'ASC')
        ->get();

        $brands = Brand::where('brand_status', 1)
        ->orderBy('brand_id', 'ASC')
        ->get();

        $products->appends($request->all());

        return view('pages.product.all_product', [
            'meta_title'      => $meta_title,
            'categories'      => $categories,
            'brands'          => $brands,
            'products'        => $products
        ]);
    }


    public function product_category_slug(Request $request, $category_slug)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Sản phẩm";

        $category = Category::where('category_slug', $category_slug)->get();

        foreach($category as $cate){
            $category_id = $cate->category_id;
            $category_name = $cate->category_name;
            $category_parent = $cate->category_parent;
        }

        if($category_parent == 1){
            $breadcrumb_category = $category_name . ' ' . 'nam';
        }elseif($category_parent == 2){
            $breadcrumb_category = $category_name . ' ' . 'nữ';
        }else{
            $breadcrumb_category = $category_name;
        }

        if(isset($_GET['sortBy'])){
            $sortBy = $_GET['sortBy'];

            if($sortBy == 'default'){
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->paginate(12);
            }else if($sortBy == 'alpha-asc'){
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->orderBy('product_name', 'ASC')
                ->paginate(12);
            }else if($sortBy == 'alpha-desc'){
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->orderBy('product_name', 'DESC')
                ->paginate(12);
            }else if($sortBy == 'price-asc'){
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->orderBy('product_price', 'ASC')
                ->paginate(12);
            }else if($sortBy == 'price-desc'){
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->orderBy('product_price', 'DESC')
                ->paginate(12);
            }else if($sortBy == 'created-asc'){
                $now      = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->where('product_date', $now)
                ->paginate(12);
            }else if($sortBy == 'created-desc'){
                $now      = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->where('product_date', '<', $now)
                ->paginate(12);
            }else{
                $products = Product::where([
                    ['category_id', $category_id],
                    ['product_status', 1]
                ])->inRandomOrder()->paginate(12);
            }

        }else if(isset($_GET['brand'])){
            $brand_id = Brand::where('brand_slug', $_GET['brand'])->first()->brand_id;

            $products = Product::where([
                ['category_id', $category_id],
                ['brand_id', $brand_id],
                ['product_status', 1]
            ])->paginate(12);

        }else if(isset($_GET['filter_price'])){
            $filter_price = explode("-", $_GET['filter_price']);
            $min_price = $filter_price[0];
            $max_price = $filter_price[1];

            $products = Product::where([
                ['category_id', $category_id],
                ['product_status', 1],
            ])->whereBetween('product_price', [$min_price, $max_price])
            ->orderBy('product_price', 'DESC')
            ->paginate(12);

        }else{
            $products = Product::where([
                ['category_id', $category_id],
                ['product_status', 1]
            ])->inRandomOrder()->paginate(12);
        }

        $categories = Category::where('category_status', 1)
        ->orderBy('category_id', 'ASC')
        ->get();

        $brands = Brand::where('brand_status', 1)
        ->orderBy('brand_id', 'ASC')
        ->get();

        return view('pages.product.cate_product', [
            'meta_title'          => $meta_title,
            'categories'          => $categories,
            'brands'              => $brands,
            'breadcrumb_category' => $breadcrumb_category,
            'category_slug'       => $category_slug,
            'products'            => $products
        ]);
    }

    public function product_detail($product_slug)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Chi tiết sản phẩm";

        $product_details = Product::where('product_slug', $product_slug)
        ->with('category')
        ->with('brand')
        ->get();

        foreach ($product_details as $value) {
            $product_id   = $value->product_id;
            $product_name = $value->product_name;
            $category_id  = $value->category_id;
        }

        // Category
        $category_name = Category::where('category_id', $category_id)->get();

        foreach ($category_name as $cate) {
            $category_name    = $cate->category_name;
            $category_slug    = $cate->category_slug;
            $category_parent  = $cate->category_parent;
        }

        if($category_parent == 1){
            $breadcrumb_category = $category_name . ' ' . 'nam';
        }elseif($category_parent == 2){
            $breadcrumb_category = $category_name . ' ' . 'nữ';
        }else{
            $breadcrumb_category = $category_name;
        }

        // Gallery
        $gallery = Gallery::where('product_id', $product_id)->get();

        $comment = Comment::where([
            ['product_id', $product_id],
            ['comment_status', 2],
            ['parent_id', NULL]
        ])->count();

        // Cập nhật hiển thị sản phẩm đã xem
        $product = Product::where('product_id', $product_id)->first();
        $product->product_view = $product->product_view + 1;
        $product->save();

        // Lấy ra sản phẩm thuộc cùng 1 danh mục
        $product_related = Product::where('category_id', $category_id)
        ->whereNotIn('product_id', [$product_id])
        ->with('category')
        ->with('brand')
        ->get();

        $starPersonal    = Rating::where([
            ['product_id', $product_id],
            ['customer_id', Session::get('customer_id')]
        ])->get();

        $rating  = round($starPersonal->avg('rating'));

        $starPublic = Rating::where('product_id', $product_id)->get();

        $counter = $starPublic->count();
        $ratingScope = $starPublic->avg('rating');

        $star1 = Rating::where('product_id', $product_id)->where('rating', 1)->count();
        $star2 = Rating::where('product_id', $product_id)->where('rating', 2)->count();
        $star3 = Rating::where('product_id', $product_id)->where('rating', 3)->count();
        $star4 = Rating::where('product_id', $product_id)->where('rating', 4)->count();
        $star5 = Rating::where('product_id', $product_id)->where('rating', 5)->count();

        $sumStar = Rating::where('product_id', $product_id)->count('rating');

        if ($star1 != NULL && $sumStar != NULL) {
            $percentStar1 = ($star1 / $sumStar) * 100;
        } else {
            $percentStar1 = 0;
        }

        if ($star2 != NULL && $sumStar != NULL) {
            $percentStar2 = ($star2 / $sumStar) * 100;
        } else {
            $percentStar2 = 0;
        }

        if ($star3 != NULL && $sumStar != NULL) {
            $percentStar3 = ($star3 / $sumStar) * 100;
        } else {
            $percentStar3 = 0;
        }

        if ($star4 != NULL && $sumStar != NULL) {
            $percentStar4 = ($star4 / $sumStar) * 100;
        } else {
            $percentStar4 = 0;
        }

        if ($star5 != NULL && $sumStar != NULL) {
            $percentStar5 = ($star5 / $sumStar) * 100;
        } else {
            $percentStar5 = 0;
        }

        // $starUser = Rating::where([
        //     ['product_id', $product_id],
        //     ['customer_id', Session::get('customer_id')]
        // ])->first();

        return view('pages.product.detail_product', [
            'meta_title'          => $meta_title,
            'product_details'     => $product_details,
            'product_name'        => $product_name,
            'category_slug'       => $category_slug,
            'breadcrumb_category' => $breadcrumb_category,
            'product_related'     => $product_related,
            'category_name'       => $category_name,
            'gallery'             => $gallery,
            'comment'             => $comment,
            'rating'              => $rating,
            'ratingScope'         => $ratingScope,
            'counter'             => $counter,
            'star1'               => $star1,
            'star2'               => $star2,
            'star3'               => $star3,
            'star4'               => $star4,
            'star5'               => $star5,
            'percentStar1'        => $percentStar1,
            'percentStar2'        => $percentStar2,
            'percentStar3'        => $percentStar3,
            'percentStar4'        => $percentStar4,
            'percentStar5'        => $percentStar5,
        ]);
    }

    public function insert_rating(Request $request){

        $customer_id = $request->customer_id;
        $product_id  = $request->product_id;
        $star        = $request->eID;

        $statusRating = Rating::where([
            ['customer_id', $customer_id],
            ['product_id', $product_id]
        ])->first();

        if(isset($statusRating->customer_id) && isset($statusRating->product_id))
        {
            return abort(401);
        }
        else
        {
            $rating = new Rating();

            $rating->customer_id = $customer_id;
            $rating->product_id  = $product_id;
            $rating->rating      = $star;
            $rating->save();
        }
    }

    public function product_tag(Request $request, $product_tags)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Tags sản phẩm";

        $categories = Category::where('category_status', 1)
        ->orderBy('category_id', 'ASC')
        ->get();

        $brands = Brand::where('brand_status', 1)
        ->orderBy('brand_id', 'ASC')
        ->get();

        $tag = str_replace("-"," ",$product_tags);

        $product_tag = Product::where('product_status', 1)
        ->where('product_name', 'LIKE', '%'.$tag.'%')
        ->orWhere('product_tags', 'LIKE', '%'.$tag.'%')
        ->orWhere('product_slug', 'LIKE', '%'.$tag.'%')
        ->paginate(12);

        return view('pages.product.tag_product', [
            'meta_title'      => $meta_title,
            'categories'      => $categories,
            'brands'          => $brands,
            'tag'             => $tag,
            'product_tag'     => $product_tag
        ]);
    }

    public function quick_view(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $product_brand = Brand::where('brand_id', $product->brand_id)->first()->brand_name;

        $gallery = Gallery::where('product_id', $product_id)->get();

        $output['product_quantity'] = '
            <input type="hidden" class="product_quantity_'.$product->product_id.'" value="'.$product->product_quantity.'">
        ';

        $output['product_id']   = $product->product_id;
        $output['product_name'] = $product->product_name;
        $output['product_description'] = $product->product_description;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.') . ' ' . '₫';

        $path_product = asset('public/uploads/product/'.$product->product_image);

        $output['product_image'] = '
            <div class="gallery-lb">
                <div class="item-slick3" data-thumb="'.$path_product.'">
                    <div class="wrap-pic-w pos-relative">
                        <img src="'.$path_product.'" alt="'.$product->product_image.'">
                        <a class="flex-c-m size-108 how-pos1 bor0 fs-1 cl10 bg0 hov-btn3 trans-04" href="'.$path_product.'">
                            <i class="fa fa-expand"></i>
                        </a>
                    </div>
                </div>
            </div>
        ';

        $output['product_brand'] = $product_brand;

        if ($product->product_quantity > 0) {
            $product_status = 'Còn hàng';
        } else {
            $product_status = 'Tạm thời hết hàng';
        }

        $output['product_status'] = $product_status;

        if($product->product_quantity > 0){
            $product_button = '
                <button
                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                    style="height: 43px; border-radius: 3px;"
                    onclick="quickViewMultipleAddCart('.$product->product_id.')">
                    <i class="icofont icofont-cart-alt f-1"
                        style="font-size: 17px; margin-right: 5px;"></i> Thêm giỏ hàng
                </button>
            ';
        }else{
            $product_button = '
                <button
                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                    style="height: 43px; border-radius: 3px;">
                    <i class="icofont icofont-cart-alt f-1"
                        style="font-size: 17px; margin-right: 5px;"></i> Thêm giỏ hàng
                </button>
            ';
        }

        $output['product_button'] = $product_button;

        $product_tags = Product::where([
            ['product_status', 1],
            ['product_id', $product_id],
        ])->get();

        foreach ($product_tags as $item) {

            $output['product_tag'] = '
                <span class="text-base stext-107 cl6">
                    <i class="fa fa-tags"></i> Tags:
                    ';

                    $tags = $item->product_tags;
                    $tags = explode(',', $tags);

                    foreach ($tags as $tag){
                        $output['product_tag'] .= '
                        | <a href="'.route('product_tag', ['product_tags' => str_slug($tag)]).'"
                            class="tags" style="color: darkslategrey;">'.$tag.'</a>
                        ';
                    }

                    $output['product_tag'] .= '
                </span>
            ';

        }

        echo json_encode($output);
    }

    public function insert_wishlist(Request $request)
    {
        $customer_id = $request->customer_id;
        $product_id  = $request->product_id;

        $status = Wishlist::where([
            ['customer_id', $customer_id],
            ['product_id', $product_id]
        ])->first();

        if(isset($status->customer_id) && isset($status->product_id))
        {
            return abort(401);
        }
        else
        {
            $wishlist = new Wishlist;

            $wishlist->customer_id = $customer_id;
            $wishlist->product_id  = $product_id;
            $wishlist->save();
        }
    }

    public function delete_wishlist_image(Request $request)
    {
        $data = $request->all();

        $wishlist = Wishlist::findOrFail($data['del_id']);
        $wishlist->delete();
    }

    // END FRONTEND
}
