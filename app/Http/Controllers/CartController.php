<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use App\Models\Coupon;
use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use App\Models\Feeship;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;



class CartController extends Controller
{
    // GET: Giỏ hàng
    public function view_cart()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Giỏ hàng";
        $city = City::orderBy('city_id', 'ASC')->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupons = Coupon::all();

        return view('pages.cart.view_cart', [
            'meta_title' => $meta_title,
            'city' => $city,
            'coupons' => $coupons,
            'today' => $today
        ]);
    }

    // POST: Lưu trữ giỏ hàng đơn giản
    public function save_cart_simple(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $product = Product::where('product_id', $data['product_id'])->first();

        $product_id = $product->product_id;
        $product_name = $product->product_name;
        $product_price = $product->product_price;
        $product_image = $product->product_image;
        $product_slug = $product->product_slug;

        if(!Session::get('cart')){
            $cart = array();
            $cart[$product_id] = array(
                'session_id'     => $session_id,
                'id'             => $product_id,
                'name'           => $product_name,
                'num'            => 1,
                'price'          => $product_price,
                'image'          =>  $product_image,
                'quantity'       => $data['product_quantity'],
                'slug'           => $product_slug
            );
        }else{
            $cart = Session::get('cart');
            if (array_key_exists($product_id, $cart)){
                $cart[$product_id] = array(
                    'session_id' => $session_id,
                    'id'         => $product_id,
                    'name'       => $product_name,
                    'num'        => (int)$cart[$product_id]['num']+1,
                    'price'      => $product_price,
                    'image'      =>  $product_image,
                    'quantity'   => $data['product_quantity'],
                    'slug'       => $product_slug
                );
            }else{
                $cart[$product_id] = array(
                    'session_id' => $session_id,
                    'id'         => $product_id,
                    'name'       => $product_name,
                    'num'        => 1,
                    'price'      => $product_price,
                    'image'      =>  $product_image,
                    'quantity'   => $data['product_quantity'],
                    'slug'       => $product_slug
                );
            }
        }
        Session::put('cart', $cart);
        Session::save();
    }

    // POST: Lưu trữ nhiều vp giỏ hàng
    public function save_cart_multiple(Request $request)
    {
        $data = $request->all();

        $session_id = substr(md5(microtime()),rand(0,26),5);
        $product = Product::where('product_id', $data['product_id'])->first();

        $product_id = $product->product_id;
        $product_name = $product->product_name;
        $product_price = $product->product_price;
        $product_image = $product->product_image;
        $product_slug = $product->product_slug;

        if(!Session::get('cart')){
            $cart = array();
            $cart[$product_id] = array(
                'session_id' => $session_id,
                'id'         => $product_id,
                'name'       => $product_name,
                'num'        => $data['num'],
                'price'      => $product_price,
                'image'      =>  $product_image,
                'quantity'   => $data['product_quantity'],
                'slug'       => $product_slug
            );
        }else{
            $cart = Session::get('cart');
            if (array_key_exists($product_id, $cart)){
                $cart[$product_id] = array(
                    'session_id' => $session_id,
                    'id'         => $product_id,
                    'name'       => $product_name,
                    'num'        => (int)$cart[$product_id]['num']+$data['num'],
                    'price'      => $product_price,
                    'image'      =>  $product_image,
                    'quantity'   => $data['product_quantity'],
                    'slug'       => $product_slug
                );
            }else{
                $cart[$product_id] = array(
                    'session_id' => $session_id,
                    'id'         => $product_id,
                    'name'       => $product_name,
                    'num'        => $data['num'],
                    'price'      => $product_price,
                    'image'      =>  $product_image,
                    'quantity'   => $data['product_quantity'],
                    'slug'       => $product_slug
                );
            }
        }
        Session::put('cart', $cart);
        Session::save();

        $numCart = 0;
        foreach ($cart as $key => $val){
            $numCart++;
        }
        echo $numCart;
    }

    // GET: Cập nhật sl [1] bằng Ajax
    public function update_num_cart($product_id, $type){
        $cart = Session::get('cart');

        if ($type == 'minus'){
            if ($cart[$product_id]['num'] == 1){
                unset($cart[$product_id]);
                Session::put('cart', $cart);
                Session::save();
            }else{
                $cart[$product_id]['num']--;
                Session::put('cart', $cart);
                Session::save();
            }
            Toastr::success('Giảm số lượng thành công', 'Success');
        }else{
            $cart[$product_id]['num']++;
            Session::put('cart', $cart);
            Session::save();
            Toastr::success('Tăng số lượng thành công', 'Success');
        }

        return redirect()->route('view_cart');
    }

    // POST: Cập nhật sl lớn
    public function update_all_num_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';
            // $key ~ session_id, $qty ~ value (num)
            foreach($data['cart_quantity'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id'] == $key && $qty < $cart[$session]['quantity']){

                        $cart[$session]['num'] = $qty;
                        $message.='<p style="color:#155724; font-size: 16px">'.$i.') Cập nhật số lượng :'.$cart[$session]['name'].' thành công</p>';

                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['quantity']){

                        $message.='<p style="color:crimson; font-size: 16px">'.$i.') Cập nhật số lượng :'.$cart[$session]['name'].' thất bại</p>';

                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->route('view_cart')->with('message', $message);
        }else{
            return redirect()->route('view_cart')->with('error', 'Cập nhật số lượng thất bại');
        }
    }

    // POST: Xóa 1 vp giỏ hàng
    public function delete_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['id'] ==  $data['pid']) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
        }
    }

    // GET: Xóa nhiều vp giỏ hàng
    public function delete_all_cart()
    {
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('fee');
    }

    // POST: Xóa tất cả giỏ hàng
    public function delete_cart_image(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['id'] ==  $data['del_id']) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
        }
    }

    // POST: Kiểm tra giảm giá
    public function check_coupon(Request $request)
    {
        $coupon_code = $request->coupon;

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        if(Session::get('customer_id')){
            $coupon = Coupon::where([
                ['coupon_code', $coupon_code],
                ['coupon_end_date', '>=', $today],
                ['coupon_used', 'LIKE', '%'.Session::get('customer_id').'%'],
            ])->first();

            if($coupon){
                Toastr::error('Mã giảm giá đã sử dụng vui lòng nhập mã khác!','Error');
                return redirect()->route('view_cart');
            }else{
                $coupon_login = Coupon::where([
                    ['coupon_code', $coupon_code],
                    ['coupon_end_date', '>=', $today],
                ])->first();

                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        // Chỉ nhập 1 mã khác nhau
                        if($coupon_session == true){
                            $is_avaiable = 0;
                            if($is_avaiable == 0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,
                                );
                                Session::put('coupon', $cou);
                            }
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,
                            );
                            Session::put('coupon', $cou);
                        }
                        Session::save();
                        Toastr::success('Thêm mã giảm giá thành công','Success');
                        return redirect()->route('view_cart')->with('coupon_code', $coupon_code);
                    }
                }else{
                    Toastr::error('Mã giảm giá không đúng hoặc đã hết hạn sử dùng!','Error');
                    return redirect()->route('view_cart');
                }
            }
        }else{
            $coupon = Coupon::where([
                ['coupon_code', $coupon_code],
                ['coupon_end_date', '>=', $today],
            ])->first();

            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    // Chỉ nhập 1 mã khác nhau
                    if($coupon_session == true){
                        $is_avaiable = 0;
                        if($is_avaiable == 0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
                            );
                            Session::put('coupon', $cou);
                        }
                    }else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                    Session::save();
                    Toastr::success('Thêm mã giảm giá thành công','Success');
                    return redirect()->route('view_cart')->with('coupon_code', $coupon_code);
                }
            }else{
                Toastr::error('Mã giảm giá không đúng hoặc đã hết hạn sử dùng!','Error');
                return redirect()->route('view_cart');
            }
        }
    }

    // GET: Huỷ mã giảm giá
    public function unset_coupon(){
        $coupon = Session::get('coupon');

        if($coupon == true){
            Session::forget('coupon');
            Toastr::success('Xoá mã giảm giá thành công','Success');
            return redirect()->route('view_cart');
        }
    }

    // POST: Lấy Ajax quận/huyện/xã/phường
    public function select_delivery_cart(Request $request){
        $data = $request->all();
        if ($data['action']){
            $output = '';
            if ($data['action'] == "city"){
                $select_district = District::where('city_id', $data['ma_id'])->orderBy('district_id', 'ASC')->get();
                $output .= '<option>Chọn quận/huyện</option>';
                foreach ($select_district as $district) {
                    $output .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }

            }else{
                $select_commune = Commune::where('district_id', $data['ma_id'])->orderBy('commune_id', 'ASC')->get();
                $output .= '<option>Chọn xã/phường</option>';
                foreach ($select_commune as $commune) {
                    $output .= '<option value="' . $commune->commune_id . '">' . $commune->commune_name . '</option>';
                }
            }
        }
        echo $output;
    }

    // POST: Tính giá vận chuyển
    public function calculate_feeship(Request $request)
    {
        $data = $request->all();
        if($data['city_id']){
            $feeship = Feeship::where('city_id', $data['city_id'])
                ->where('district_id', $data['district_id'])
                ->where('commune_id', $data['commune_id'])
                ->with('city')
                ->with('district')
                ->with('commune')
                ->first();

            $fee[] = array(
                'city_name'     => $feeship->city->city_name,
                'district_name' => $feeship->district->district_name,
                'commune_name'  => $feeship->commune->commune_name,
                'fee_feeship'   => $feeship->fee_feeship,
            );

            Session::put('fee', $fee);
            Session::save();
        }
    }

    // GET: Huỷ phí vận chuyển
    public function unset_delivery()
    {
        $delivery_free = Session::get('fee');

        if($delivery_free == true){
            Session::forget('fee');
            Toastr::success('Xoá phí vận chuyển thành công','Success');
            return redirect()->route('view_cart');
        }
    }
}
