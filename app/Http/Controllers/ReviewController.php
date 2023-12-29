<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;
use Brian2694\Toastr\Facades\Toastr;

class ReviewController extends Controller
{
    public function review($product_id)
    {
        $reviews = Rating::with('product')->where('product_id', $product_id)
        ->select('rating.*', 'customer_name')
        ->join('customers', 'customers.customer_id', 'rating.customer_id')
        ->get();

        return view('admin.review.list')->with('reviews', $reviews);
    }

    public function delete_review(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $review = Rating::findOrFail($data['rating_id']);
            $review->delete();
            Toastr::success('Xóa sản phẩm thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa sản phẩm thất bại','Error');
            DB::rollBack();
        }
    }
}
