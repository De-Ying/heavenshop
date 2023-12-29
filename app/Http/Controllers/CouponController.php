<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Hiển thị khuyến mãi
     *
     * @return void
    */

    public function coupon()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Khuyến mãi";
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        if(isset($_GET['status'])){
            $status = $_GET['status'];

            if($status == 'due'){
                $coupons = Coupon::where('coupon_end_date', '>=', $today)
                ->paginate(10);
            }else if($status == 'expired'){
                $coupons = Coupon::where('coupon_end_date', '<=', $today)
                ->paginate(10);
            }else if($status == 'used'){
                $customer_id = Session::get('customer_id');
                $coupons = Coupon::where('coupon_used', 'LIKE', '%'.$customer_id.'%')
                ->paginate(10);
            }else{
                $coupons = Coupon::paginate(10);
            }
        }
        else{
            $coupons = Coupon::paginate(10);
        }

        return view('pages.coupon', [
            'meta_title'   => $meta_title,
            'coupons'      => $coupons,
            'today'        => $today
        ]);
    }


    /**
     * GET: Thêm mã giảm giá
     *
     * @return void
    */

    public function view_all()
    {
        $coupons = Coupon::orderBy('coupon_id', 'DESC')->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        return view('admin.coupon.view_all', [
            'coupons' => $coupons,
            'today'  => $today
        ]);
    }

    /**
     * GET: Form thêm sản phẩm
     *
     * @return void
    */

    public function view_insert()
    {
        return view('admin.coupon.view_insert');
    }

    /**
     * POST: Xử lý thêm mã giảm giá
     *
     * @param  mixed $request
     * @return void
    */

    public function process_insert(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                DB::beginTransaction();
                $data = $request->all();

                if($data['coupon_start_date'] > $data['coupon_end_date']){
                    Toastr::error('Ngày bắt đầu nhỏ hơn ngày kết thúc khi giảm!','Error');
                    return redirect()->route('coupon.view_all');
                }else{
                    Coupon::create($data);
                    Toastr::success('Thêm mã giảm giá thành công', 'Success');
                    DB::commit();
                    return redirect()->route('coupon.view_all');
                }

            } catch (\Throwable $th) {
                Toastr::error('Thêm mã giảm giá thất bại','Error');
                DB::rollBack();
                return redirect()->route('coupon.view_all');
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('coupon.view_insert');
        }

        // dd($request->all());
    }

    public function view_update($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        return view('admin.coupon.view_update')->with('coupon', $coupon);
    }

    /**
     * POST: Xử lý cập nhật mã giảm giá
     *
     * @param  mixed $request
     * @return void
    */

    public function process_update(Request $request, $coupon_id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            if($data['coupon_start_date'] > $data['coupon_end_date']){
                Toastr::error('Ngày bắt đầu nhỏ hơn ngày kết thúc khi giảm!', 'Error');
                return redirect()->route('coupon.view_all');
            }else{
                Coupon::find($coupon_id)->update($data);
                Toastr::success('Cập nhật mã giảm giá thành công','Success');
                DB::commit();
                return redirect()->route('coupon.view_all');
            }
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật mã giảm giá thất bại','Error');
            DB::rollBack();
            return redirect()->route('coupon.view_all');
        }
    }

    /**
     * POST: Xóa mã giảm giá
     *
     * @param  mixed $request
     * @return void
    */

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $coupon = Coupon::findOrFail($data['coupon_id']);
            $coupon->delete();
            Toastr::success('Xóa mã giảm giá thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa mã giảm giá thất bại','Error');
            DB::rollBack();
        }
    }
}
