<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;


class CheckoutController extends Controller
{
    // GET: Form thông tin gủi hàng (FE)
    public function checkout()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Thanh toán - thông tin gủi hàng";

        return view('pages.checkout.checkout')->with('meta_title',$meta_title);
    }

    // GET: Cập nhật số lượng trong thanh toán
    public function update_num_cart_checkout($product_id, $type)
    {
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
        }else{
            $cart[$product_id]['num']++;
            Session::put('cart', $cart);
            Session::save();
        }
        echo '<pre>';
        print_r(Session::get('cart'));
        return redirect()->route('checkout');
    }

    // POST: Cập nhật sl lớn
    public function update_all_num_cart_checkout(Request $request)
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
            return redirect()->route('checkout')->with('message', $message);
        }else{
            return redirect()->route('checkout')->with('error', 'Cập nhật số lượng thất bại');
        }
    }

    // POST: Xác nhận đơn hàng
    public function confirm_order(Request $request)
    {
        $data = $request->all();

        // Check number coupon
        if($data['order_coupon'] != 'no'){
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_used = Session::get('customer_id').','.$coupon->coupon_used;
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_mail         = $coupon->coupon_code;
            $coupon->save();
        }else{
            $coupon_mail = 'Không áp dụng';
        }

        // Get shipping
        $shipping = new Shipping();
        $shipping->shipping_name    = $data['shipping_name'];
        $shipping->shipping_phone   = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_email   = $data['shipping_email'];
        $shipping->shipping_notes   = $data['shipping_notes'];
        $shipping->shipping_method  = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        // Get order
        $order = new Order();
        $order->customer_id  = Session::get('customer_id');
        $order->shipping_id  = $shipping_id;
        $order->order_code   = $checkout_code;
        $order->order_status = 1;
        $order_date          = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_date   = $order_date;
        $order->save();
        $order_id            = $order->order_id;

        // Get item cart
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code             = $checkout_code;
                $order_details->product_id             = $cart['id'];
                $order_details->order_id               = $order_id;
                $order_details->product_price          = $cart['price'];
                $order_details->product_sales_quantity = $cart['num'];
                $order_details->product_coupon         = $data['order_coupon'];
                $order_details->product_feeship        = $data['order_fee'];
                $order_details->save();
            }
        }

        // Send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;

        $customer = Customer::find(Session::get('customer_id'));

        $data['customer_email'] = $customer->customer_email;

        // Get cart
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name'           => $cart_mail['name'],
                    'product_price'          => $cart_mail['price'],
                    'product_sales_quantity' => $cart_mail['num']
                );
            }
        }
        // Get money fee
        if(Session::get('fee')==true){
            foreach(Session::get('fee') as $key => $fee){
                $fee_array[] = array(
                    'fee_feeship'     => $fee['fee_feeship']
                );
            }
        }else{
            $fee_array[] = array(
                'fee_feeship'     => 25000
            );
        }

        // Get money coupon
        if(Session::get('coupon')==true){
            foreach(Session::get('coupon') as $key => $coupon){
                $coupon_array[] = array(
                    'coupon_condition'   => $coupon['coupon_condition'],
                    'coupon_number'      => $coupon['coupon_number']
                );
            }
        }else{
            $coupon_array[] = array(
                'coupon_condition'   => 2,
                'coupon_number'      => 0
            );
        }

        $shipping_array = array(
            'customer_name'    => $customer->customer_name,
            'shipping_name'    => $data['shipping_name'],
            'shipping_phone'   => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_email'   => $data['shipping_email'],
            'shipping_notes'   => $data['shipping_notes'],
            'shipping_method'  => $data['shipping_method']
        );

        // Get order/coupon code
        $code_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code'  => $checkout_code
        );


        // Send mail
        Mail::send('admin.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code_mail' => $code_mail, 'fee_array' => $fee_array, 'coupon_array' => $coupon_array ], function($message) use ($title_mail,$data){
            $message->to($data['customer_email'])->subject($title_mail);
            $message->from($data['customer_email'],$title_mail);
        });

        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
}
