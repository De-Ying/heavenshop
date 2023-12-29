<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryPost;
use App\Models\Posts;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    //TODO: Frontend
    public function blog()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Bài viết";

        $category_post = CategoryPost::all();
        $posts = Posts::with('cate_post')
        ->where('post_status', 1)
        ->paginate(3);

        return view('pages.blog.all_blog', [
            'meta_title'    => $meta_title,
            'category_post' => $category_post,
            'posts'         => $posts
        ]);
    }

    public function blog_category($category_post_slug)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Danh mục bài viết";

        $cate_post = CategoryPost::where('category_post_slug', $category_post_slug)
        ->take(1)
        ->get();

        foreach($cate_post as $cp){
            $category_post_id = $cp->category_post_id;
            $category_post_name = $cp->category_post_name;
        }

        $category_post = CategoryPost::all();

        $posts = Posts::with('cate_post')
        ->where('post_status', 1)
        ->where('category_post_id', $category_post_id)
        ->paginate(3);

        return view('pages.blog.cate_blog', [
            'meta_title'         => $meta_title,
            'category_post'      => $category_post,
            'category_post_name' => $category_post_name,
            'posts'              => $posts
        ]);
    }

    public function blog_detail($post_slug)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Tin tức chi tiết";

        $category_post = CategoryPost::all();

        $posts = Posts::with('cate_post')
        ->where('post_status', 1)
        ->where('post_slug', $post_slug)
        ->take(1)
        ->get();

        foreach($posts as $post){
            $post_id = $post->post_id;
            $category_post_id = $post->category_post_id;
            $post_date = $post->post_date;
        }

        // Update view product
        $post = Posts::where('post_id', $post_id)->first();
        $post->post_view = $post->post_view + 1;
        $post->save();

        $related_post = Posts::with('cate_post')
        ->where('post_status', 1)
        ->where('category_post_id', $category_post_id)
        ->whereNotIn('post_slug', [$post_slug])
        ->take(3)
        ->get();

        return view('pages.blog.detail_blog', [
            'meta_title'    => $meta_title,
            'category_post' => $category_post,
            'posts'         => $posts,
            'related_post'  => $related_post
        ]);
    }


    public function blog_search(Request $request)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Tìm kiếm tin tức";

        $category_post = CategoryPost::all();

        $keywords = $request->keyword;

        $search_blog = Posts::where([
            ['post_status', 1],
            ['post_title', 'LIKE', "%{$keywords}%"],
        ])->paginate(3);

        return view('pages.blog.search_blog', [
            'meta_title'    => $meta_title,
            'category_post' => $category_post,
            'search_blog'   => $search_blog,
            'keywords'        => $keywords
        ]);
    }

    //TODO: Backend
    //? GET: News category list
    public function view_category_post()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Danh mục bài viết";

        $category_post = CategoryPost::all();

        return view('admin.category_post.view_all', [
            'category_post' => $category_post,
            'meta_title' => $meta_title,
        ]);
    }

    //? GET: Form to add news categories
    public function insert_category_post()
    {
        return view('admin.category_post.view_insert');
    }

    //? POST: Processing additional news categories
    public function process_insert_category_post(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                CategoryPost::create($request->all());
                Toastr::success('Thêm danh mục bài viết thành công','Success');
                return redirect()->route('category-post.view_category_post');
            } catch (\Throwable $th) {
                Toastr::error('Thêm danh mục bài viết thất bại','Error');
                return redirect()->route('category-post.insert_category_post');
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('category-post.insert_category_post');
        }
    }

    //? GET: Form to update news categories
    public function update_category_post($category_post_id)
    {
        $category_post = CategoryPost::find($category_post_id);

        return view('admin.category_post.view_update')->with('category_post', $category_post);
    }

    //? POST: Processing update news categories
    public function process_update_category_post(Request $request, $category_post_id)
    {
        CategoryPost::find($category_post_id)->update($request->all());
        Toastr::success('Cập nhật danh mục bài viết thành công','Success');
        return redirect()->route('category-post.view_category_post');
    }

    //? GET: Delete news categories
    public function delete_category_post(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $categoryPost = CategoryPost::findOrFail($data['category_post_id']);
            $categoryPost->delete();
            Toastr::success('Xóa danh mục bài viết thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa danh mục bài viết thành công','Error');
            DB::rollBack();
        }
    }

    //? GET: Un-active status news categories
    public function unactive_category_post($category_post_id)
    {
        CategoryPost::where('category_post_id', $category_post_id)->update(['category_post_status' => 0]);
        Toastr::success('Ẩn danh mục bài viết thành công','Success');
        return Redirect::to('admin/category-post/');
    }

    //? GET: Active status news categories
    public function active_category_post($category_post_id)
    {
        CategoryPost::where('category_post_id', $category_post_id)->update(['category_post_status' => 1]);
        Toastr::success('Hiển thị danh mục bài viết thành công','Success');
        return Redirect::to('admin/category-post/');
    }

    //? GET: News list
    public function view_post()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Bài viết";

        $posts = Posts::with('cate_post')->get();

        return view('admin.post.view_all', [
            'posts' => $posts,
            'meta_title' => $meta_title,
        ]);
    }

    //? GET: Form to add news
    public function insert_post()
    {
        $category_post = CategoryPost::all();
        return view('admin.post.view_insert', [
            'category_post' => $category_post
        ]);
    }

    //? POST: Processing additional news
    public function process_insert_post(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $user = Auth::guard('admin')->user()->user_name;

        if($request->isMethod('POST')){
            try {
                $data = array();
                $data['post_title'] = $request->post_title;
                $data['post_slug'] = $request->post_slug;
                $data['post_description'] = $request->post_description;
                $data['post_content'] = $request->post_content;
                $data['post_date'] = $now;
                $data['post_author'] = $user;
                $data['category_post_id'] = $request->category_post_id;

                $get_image = $request->file('post_image');

                $path         = 'public/uploads/blog/';
                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move($path, $new_image);
                    $data['post_image'] = $new_image;
                    Posts::create($data);
                    Toastr::success('Thêm bài viết thành công','Success');
                    return redirect()->route('posts.view_post');
                }
                Posts::create($data);
                Toastr::success('Thêm bài viết thành công','Success');
                return redirect()->route('posts.view_post');

            } catch (\Throwable $th) {
                Toastr::error('Thêm bài viết thất bại','Error');
                return redirect()->route('posts.insert_post');
            }
        }else{
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('posts.insert_post');
        }
    }

    //? GET: Form to update news
    public function update_post($post_id)
    {
        $posts = Posts::find($post_id);
        $category_post = CategoryPost::all();

        return view('admin.post.view_update', [
            'posts' => $posts,
            'category_post' => $category_post
        ]);
    }

    //? POST: Processing update news
    public function process_update_post(Request $request, $post_id)
    {
        try {
            DB::beginTransaction();
            $data = array();
            $user = Auth::guard('admin')->user()->user_name;

            $data['post_title'] = $request->post_title;
            $data['post_slug'] = $request->post_slug;
            $data['post_description'] = $request->post_description;
            $data['post_content'] = $request->post_content;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data['post_date_post'] = now();
            $data['post_author'] = $user;
            $data['category_post_id'] = $request->category_post_id;

            $path         = 'public/uploads/blog/';

            $get_image = $request->file('post_image');
            if ($get_image) {
                // Lấy tên ảnh
                $get_name_image = $get_image->getClientOriginalName();
                // Sử dụng hàm tách chuỗi
                $name_image = current(explode('.', $get_name_image));
                // Lấy đuôi mở rộng của hình ảnh
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['post_image'] = $new_image;
                $posts = Posts::find($post_id);
                unlink($path.$posts->post_image);
                $posts->update($data);

                Toastr::success('Cập nhật bài viết thành công','Success');
                DB::commit();
                return redirect()->route('posts.view_post');
            }
            Posts::find($post_id)->update($data);
            Toastr::success('Cập nhật bài viết thành công','Success');
            DB::commit();
            return redirect()->route('posts.view_post');
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật bài viết thất bại','Error');
            DB::rollBack();
            return redirect()->route('posts.view_post');
        }

    }

    //? GET: Un-active status news
    public function unactive_post($post_id)
    {
        Posts::where('post_id', $post_id)->update(['post_status' => 0]);
        Toastr::success('Ẩn bài viết thành công','Success');
        return Redirect::to('admin/posts/');
    }

    //? GET: Active status news
    public function active_post($post_id)
    {
        Posts::where('post_id', $post_id)->update(['post_status' => 1]);
        Toastr::success('Hiển thị bài viết thành công','Success');
        return Redirect::to('admin/posts/');
    }

    //? GET: Delete news
    public function delete_post(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $posts = Posts::findOrFail($data['post_id']);
            $posts->delete();
            Toastr::success('Xóa bài viết thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa bài viết thất bại','Error');
            DB::rollBack();
        }
    }


}
