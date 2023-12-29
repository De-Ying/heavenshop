<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\Statistic;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function view_all()
    {
        $customers = Customer::paginate(10);
        return view('admin.customer.customer_list')->with('customers', $customers);
    }

    public function unactive_customer($customer_id)
    {
        Customer::where('customer_id', $customer_id)->update(['customer_status' => 0]);
        Toastr::error('Trạng thái đã bị khóa', 'Error');
        return Redirect::to('admin/customer/');

    }

    public function active_customer($customer_id)
    {
        Customer::where('customer_id', $customer_id)->update(['customer_status' => 1]);
        Toastr::success('Trạng thái đã mở','Success');
        return Redirect::to('admin/customer/');
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $customer = Customer::withTrashed()->findOrFail($data['customer_id']);
            $customer->delete();

            Toastr::success('Xóa khách hàng thành công', 'Success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Xóa khách hàng thất bại', 'Error');
        }
    }

    public function view_customer($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();

        return view('admin.customer.view_customer', [
            'customer'  => $customer
        ]);
    }

    // GET: Lịch sử hóa đơn
    public function history_order($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        $orders = Order::with('shipping')->where('customer_id', $customer_id)->get();

        return view('admin.customer.history_order', [
            'customer'  => $customer,
            'orders'    => $orders
        ]);
    }

    /**
     * GET: Hồ sơ khách hàng
     *
     * @return void
    */

    public function profile()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Hồ sơ khách hàng";

        return view('pages.user.account.profile')->with('meta_title', $meta_title);
    }

    /**
     * POST: Cập nhật hồ sơ
     *
     * @param  mixed $request
     * @return void
     */

    public function update_profile(Request $request)
    {
        if (!$request->isMethod('POST')) {
            Toastr::warning('Phương thức truyền vào không đúng', 'Warning');
            return redirect()->route('account.profile');
        }

        try {
            $data = $request->validate([
                'customer_id' => 'required|numeric',
                'customer_name' => 'required|string',
                'customer_phone' => 'required|string',
                'customer_address' => 'required|string',
                'customer_email' => 'required|email',
                'customer_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $customer = Customer::find($data['customer_id']);

            if (!$customer) {
                Toastr::error('Không tìm thấy khách hàng', 'Error');
                return redirect()->route('account.profile');
            }

            if ($request->hasFile('customer_image')) {
                $path = 'public/uploads/customer/';

                $get_image = $request->file('customer_image');
                $new_image = uploadImage($get_image, $path, $customer->customer_image);

                if ($customer->customer_image != null) {
                    unlink($path . $customer->customer_image);
                }

                $customer->customer_image = $new_image;
            }

            $customer->customer_name = $data['customer_name'];
            $customer->customer_phone = $data['customer_phone'];
            $customer->customer_address = $data['customer_address'];
            $customer->customer_email = $data['customer_email'];
            $customer->save();

            $this->updateSession($customer);

            Toastr::success('Cập nhật thông tin hồ sơ thành công', 'Success');
            return redirect()->route('account.profile');
        } catch (\Throwable $th) {
            Toastr::error('Đã xảy ra lỗi khi cập nhật thông tin hồ sơ', 'Error');
            return redirect()->route('account.profile');
        }
    }

    private function updateSession($customer)
    {
        $sessionData = [
            'customer_id' => $customer->customer_id,
            'customer_name' => $customer->customer_name,
            'customer_email' => $customer->customer_email,
            'customer_phone' => $customer->customer_phone,
            'customer_address' => $customer->customer_address,
        ];

        if ($customer->customer_social == 0) {
            $sessionData['customer_image'] = $customer->customer_image;
        } else {
            $sessionData['customer_image_social'] = $customer->customer_image;
        }

        Session::put($sessionData);
    }

    /**
     * GET: Giao diện đổi mật khẩu
     *
     * @return void
    */

    public function password()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Đổi mật khẩu khách hàng";

        return view('pages.user.account.password')->with('meta_title', $meta_title);
    }

    /**
     * POST: Xử lý đổi mật khẩu
     *
     * @param  mixed $request
     * @return void
    */

    public function change_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                DB::beginTransaction();

                $data = $request->all();
                Customer::where('customer_email', $data['customer_email'])
                ->update(['customer_password' => Hash::make($data['new_password'])]);
                Toastr::success('Đổi mật khẩu thành công','Success');

                DB::commit();
                return redirect()->route('account.password');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('account.password');
        }
    }

    /**
     * GET: Lịch sử đơn hàng
     *
     * @return void
    */

    public function purchase()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Lịch sử đơn hàng";

        $orders = Order::where('customer_id', Session::get('customer_id'))
        ->orderBy('order_id', 'DESC')->paginate(10);

        $count_order = $orders->count();

        return view('pages.user.purchase.order', [
            'meta_title'  => $meta_title,
            'orders'      => $orders,
            'count_order' => $count_order
        ]);
    }

    /**
     * POST: Lọc hóa đơn theo ngày
     *
     * @param  mixed $request
     * @return void
    */

    public function filter_order_date(Request $request)
    {
        try {
            DB::beginTransaction();
            $filter_start_order = $request->filter_start_order;
            $filter_end_order   = $request->filter_end_order;

            $orders = Order::whereBetween('order_date', [$filter_start_order, $filter_end_order])
            ->where('customer_id', Session::get('customer_id'))
            ->orderBy('order_date', 'ASC')
            ->get();

            $count_order = $orders->count();

            $output = '';

            $output .= '
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
            ';

            $stt = 1;

            if ($count_order > 0) {
                foreach ($orders as $order) {
                    $output .= '
                        <tr>
                            <td>'.$stt++.'</td>
                            <td>'.$order->order_code.'</td>
                            <td>'.$order->order_date.'</td>
                            <td>';
                                if ($order->order_status == 1)
                                    $output .= '<span class="label label-primary">Đang chờ
                                        xử lý</span>';
                                elseif($order->order_status == 2)
                                    $output .= '<span class="label label-success">Đã xử lý /
                                        Đang giao hàng</span>';
                                else
                                    $output .= '<span class="label label-danger">Hủy đơn
                                        hàng</span>
                            </td>';
                            $output .= '
                            <td>
                                <a class="btn btn-info" href="'.route('order_detail', ['order_code' => $order->order_code]) .'"><i
                                    class="icofont icofont-eye-alt"></i></a>
                            </td>
                        </tr>
                    ';
                }
            } else {
                $output .= '
                    <td colspan="5">
                        <span>Không có dữ liệu nào trong bảng</span>
                    </td>
                ';
            }

            $output .= '
                </tbody>
            ';

            echo $output;

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * POST: Hiển thị hóa đơn theo ngày
     *
     * @param  mixed $request
     * @return void
    */

    public function show_order_date(Request $request)
    {
        try {
            DB::beginTransaction();

            // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('Y-m-d');
            // $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $earlyLastMonth    = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y-m-d');
            $endLastMonth      = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->format('Y-m-d');

            $orders = Order::whereBetween('order_date', [$earlyLastMonth, $endLastMonth])
            ->where('customer_id', Session::get('customer_id'))
            ->orderBy('order_date', 'ASC')
            ->get();

            $count_order = $orders->count();

            $output = '';

            $output .= '
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
            ';

            if ($count_order > 0) {
                $stt = 1;

                foreach ($orders as $order) {
                    $output .= '
                        <tr>
                            <td>'.$stt++.'</td>
                            <td>'.$order->order_code.'</td>
                            <td>'.$order->order_date.'</td>
                            <td>';
                                if ($order->order_status == 1)
                                    $output .= '<span class="label label-primary">Đang chờ
                                        xử lý</span>';
                                elseif($order->order_status == 2)
                                    $output .= '<span class="label label-success">Đã xử lý /
                                        Đang giao hàng</span>';
                                else
                                    $output .= '<span class="label label-danger">Hủy đơn
                                        hàng</span>
                            </td>';
                            $output .= '
                            <td>
                                <a class="btn btn-info" href="'.route('order_detail', ['order_code' => $order->order_code]) .'"><i
                                    class="icofont icofont-eye-alt"></i></a>
                            </td>
                        </tr>
                    ';
                }
            } else {
                $output .= '
                    <td colspan="5">Không có dữ liệu nào trong bảng</td>
                ';
            }

            $output .= '
                </tbody>
            ';

            echo $output;

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * GET: Hóa đơn chi tiết
     *
     * @param  mixed $order_code
     * @return void
    */

    public function order_detail($order_code)
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Chi tiết đơn hàng";

        $order = Order::where('order_code', $order_code)->get();

        foreach ($order as $ord){
            $customer_id  = $ord->customer_id;
            $shipping_id  = $ord->shipping_id;
            $order_id     = $ord->order_id;
            $order_status = $ord->order_status;
        }

        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $orderDetails = OrderDetails::with('product')
        ->where('order_code', $order_code)
        ->get();

        foreach ($orderDetails as $ordDetail){
            $product_coupon = $ordDetail->product_coupon;
        }

        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('pages.user.purchase.order_detail', [
            'meta_title'       => $meta_title,
            'order_id'         => $order_id,
            'order_status'     => $order_status,
            'order'            => $order,
            'orderDetails'     => $orderDetails,
            'customer'         => $customer,
            'shipping'         => $shipping,
            'coupon_condition' => $coupon_condition,
            'coupon_number'    => $coupon_number
        ]);
    }

    /**
     * POST: Hủy hóa đơn
     *
     * @param  mixed $request
     * @return void
    */

    public function cancel_order(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $order = Order::find($data['order_id']);
            $order->order_reason = $data['order_reason'];
            $order->order_status = $data['order_status'];
            $order->save();

            $order_date = $order->order_date;

            $statistic = Statistic::where('order_date', $order_date)->get();

            if($statistic){
                $statistic_count = $statistic->count();
            }else{
                $statistic_count = 0;
            }

            $ordDetails = OrderDetails::where('order_code', $order->order_code)->get();

            foreach ($ordDetails as $ordDetail) {
                $product_coupon = $ordDetail->product_coupon;
                $product_feeship = $ordDetail->product_feeship;
            }

            $coupons = Coupon::where('coupon_code', $product_coupon)->get();

            if($coupons){
                $coupons_count = $coupons->count();
            }else{
                $coupons_count = 0;
            }

            if($order->order_status == 3){
                $statisticCancelOrder                   = Statistic::where('order_date', $order_date)->first();

                $funds_total                            = $statisticCancelOrder->funds;
                $sales_total                            = $statisticCancelOrder->sales;
                $profit_total                           = $statisticCancelOrder->profit;
                $quantity_total                         = $statisticCancelOrder->quantity;
                $total_order                            = $statisticCancelOrder->total_order;



                foreach( $data['order_product_id'] as $key => $product_id ){
                    $product                            = Product::find($product_id);
                    $product_quantity                   = $product->product_quantity;
                    $product_sold                       = $product->product_sold;

                    $product_price                      = $product->product_price;
                    $product_cost_price                 = $product->product_cost_price;

                    foreach( $data['quantity'] as $key2 => $qty){
                        if($key == $key2){
                            $product_remain             = $product_quantity + $qty;
                            $product->product_quantity  = $product_remain;
                            $product->product_sold      = $product_sold - $qty;
                            $product->save();

                            if($statistic_count > 0){
                                // Update doanh thu
                                $quantity_total -= $qty;
                                $funds = $product_cost_price*$qty;
                                $sales = $product_price * $qty;
                            }
                        }
                    }

                    if($coupons_count > 0){
                        foreach ($coupons as $coupon) {
                            $coupon_condition               = $coupon->coupon_condition;
                            $coupon_number                  = $coupon->coupon_number;
                        }

                        // Coupon + Feeship -> sales
                        if($coupon_condition == 1){
                            $sales_coupon                   = ($sales * $coupon_number)/100;
                            $sales_coupon_after             = $sales - $sales_coupon;
                        }else{
                            $sales_coupon_after             = $sales - $coupon_number;
                        }

                        $sales_coupon_fee_after             = $sales_coupon_after + $product_feeship;
                    }else{
                        $sales_coupon_fee_after             = $sales + $product_feeship;
                    }

                    $profit_coupon_fee_after = $sales_coupon_fee_after - $funds;
                }

                $total_order -=1;

                $statistic_update                       = Statistic::where('order_date',$order_date)->first();
                $statistic_update->funds                = $funds_total - $funds;
                $statistic_update->sales                = $sales_total - $sales_coupon_fee_after;
                $statistic_update->profit               = $profit_total - $profit_coupon_fee_after;
                $statistic_update->quantity             = $quantity_total;
                $statistic_update->total_order          = $total_order;
                $statistic_update->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * GET: Danh sách yêu thích
     *
     * @return void
    */

    public function wishlist()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Danh sách yêu thích";

        $wishlists = Wishlist::with('product')
        ->where('customer_id', Session::get('customer_id'))
        ->orderBy('wishlist_id', 'DESC')
        ->paginate(5);

        return view('pages.user.wishlist.wishlist', [
            'meta_title' => $meta_title,
            'wishlists'  => $wishlists
        ]);
    }

    /**
     * POST: Xóa danh sách yêu thích
     *
     * @param  mixed $request
     * @return void
    */

    public function deleteWishlist(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $wishlist = Wishlist::findOrFail($data['wishlist_id']);
            $wishlist->delete();
            Toastr::success('Xóa sản phẩm khỏi danh sách thành công', 'Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa sản phẩm khỏi danh sách thất bại', 'Error');
            DB::rollBack();
        }
    }
}
