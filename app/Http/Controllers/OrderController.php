<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Statistic;

use Carbon\Carbon;
use PDF;

class OrderController extends Controller
{
    // ----------------------= BACKEND =---------------------------

    // GET: Hiển thị đơn hàng
    public function manage_order(Request $request)
    {
        if ($request->ajax()) {
            $bill_from   = $request->bill_from;
            $bill_to     = $request->bill_to;
            $bill_status = $request->bill_status;

            if (!empty($bill_from) && !empty($bill_to) && !empty($bill_status)) {
                $orders = Order::with('customer')
                ->with('shipping')
                ->whereBetween('order_date', [$bill_from, $bill_to])
                ->where('order_status', $bill_status)
                ->get();
            } else if (!empty($bill_from) && !empty($bill_to)) {
                $orders = Order::with('customer')
                ->with('shipping')
                ->whereBetween('order_date', [$bill_from, $bill_to])
                ->get();
            } else if (!empty($bill_status)) {
                $orders = Order::with('customer')
                ->with('shipping')
                ->where('order_status', $bill_status)
                ->get();
            } else {
                $orders = Order::with('customer')
                ->with('shipping')
                ->get();
            }

            return datatables()->of($orders)
                ->addIndexColumn()
                ->addColumn('action', function ($order) {
                    return
                        '<a href="'. route('m-order.view_order', ['order_code' => $order->order_code]). '" class="text-white">
                            <button type="button" class="btn btn-grd-info btn-sm modal-trigger">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </a>

                        <a href="'. route('m-order.update_order', ['order_code' => $order->order_code]) .'" class="text-white">
                            <button type="button" class="btn btn-grd-primary btn-sm">
                                <i class="fa fa-edit fa-fw"></i>
                            </button>
                        </a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.order.manage_order');
    }

    // GET: Xem đơn hàng
    public function view_order($order_code)
    {
        $orders                  = Order::where('order_code', $order_code)->get();

        foreach ($orders as $order){
            $customer_id         = $order->customer_id;
            $shipping_id         = $order->shipping_id;
            $order_status        = $order->order_status;
            $order_code          = $order->order_code;
            $order_date          = $order->order_date;
        }

        $customer                = Customer::where('customer_id', $customer_id)->first();
        $shipping                = Shipping::where('shipping_id', $shipping_id)->first();

        $orderDetails = DB::table('order_details')->where('order_code', $order_code)
                        ->join('products', 'order_details.product_id', 'products.product_id')
                        ->select('order_details.*', 'products.product_name', 'products.product_quantity')->get();

        foreach ($orderDetails as $ordDetail){
            $product_coupon      = $ordDetail->product_coupon;
        }

        if($product_coupon != 'no'){
            $coupon              = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition    = $coupon->coupon_condition;
            $coupon_number       = $coupon->coupon_number;
        }else{
            $coupon_condition    = 2;
            $coupon_number       = 0;
        }

        return view('admin.order.view_order', [
            'order_status'       => $order_status,
            'order_date'         => $order_date,
            'orderDetails'       => $orderDetails,
            'customer'           => $customer,
            'shipping'           => $shipping,
            'coupon_condition'   => $coupon_condition,
            'coupon_number'      => $coupon_number,
            'order_code'         => $order_code
        ]);
    }

    // GET: Cập nhật đơn hàng
    public function update_order($order_code)
    {
        $orders                   = Order::where('order_code', $order_code)->get();

        foreach ($orders as $order){
            $customer_id         = $order->customer_id;
            $shipping_id         = $order->shipping_id;
            $order_status        = $order->order_status;
            $order_code          = $order->order_code;
            $order_date          = $order->order_date;
        }

        $customer                = Customer::where('customer_id', $customer_id)->first();
        $shipping                = Shipping::where('shipping_id', $shipping_id)->first();

        $orderDetails = DB::table('order_details')->where('order_code', $order_code)
                        ->join('products', 'order_details.product_id', 'products.product_id')
                        ->select('order_details.*', 'products.product_name', 'products.product_quantity')->get();

        foreach ($orderDetails as $ordDetail){
            $product_coupon      = $ordDetail->product_coupon;
        }

        if($product_coupon != 'no'){
            $coupon              = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition    = $coupon->coupon_condition;
            $coupon_number       = $coupon->coupon_number;
        }else{
            $coupon_condition    = 2;
            $coupon_number       = 0;
        }

        return view('admin.order.update_order', [
            'orders'             => $orders,
            'order_status'       => $order_status,
            'order_date'         => $order_date,
            'orderDetails'       => $orderDetails,
            'customer'           => $customer,
            'shipping'           => $shipping,
            'coupon_condition'   => $coupon_condition,
            'coupon_number'      => $coupon_number,
            'order_code'         => $order_code
        ]);
    }

    // GET: In đơn hàng
    public function print_order($check_code)
    {
        $pdf                    = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($check_code));
        return $pdf->stream();
    }

    public function print_order_convert($check_code)
    {
        $order                   = Order::where('order_code', $check_code)->get();

        foreach ($order as $ord){
            $customer_id         = $ord->customer_id;
            $shipping_id         = $ord->shipping_id;
            $order_date          = $ord->order_date;
        }

        $order_date_format = date('d-m-Y', strtotime($order_date));

        $customer                = Customer::where('customer_id', $customer_id)->first();
        $shipping                = Shipping::where('shipping_id', $shipping_id)->first();

        $orderDetails            = OrderDetails::where('order_code', $check_code)->with('product')->get();

        foreach ($orderDetails as $ordDetail){
            $product_coupon      = $ordDetail->product_coupon;
            $order_code          = $ordDetail->order_code;
        }

        if($product_coupon != 'no'){
            $coupon              = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition    = $coupon->coupon_condition;
            $coupon_number       = $coupon->coupon_number;

            if($coupon_condition==1){
                $coupon_echo     = $coupon_number.'%';
            }elseif($coupon_condition==2){
                $coupon_echo     = number_format($coupon_number,0,',','.') . ' ' . '₫';
            }
        }else{
            $coupon_condition    = 2;
            $coupon_number       = 0;
            $coupon_echo         = '0';
        }

        $url = asset('public/backend/assets/css/custom.css');

        $output = '';

        $output.='
            <link rel="stylesheet" type="text/css" href='.$url.'>

            <div class="healding-order">
                <div class="hl-l">
                    <h2>Heaven Shop</h2>
                    <h5>Địa chỉ: 177 Tổ 6, P.Mộ Lao, Q.Hà Đông, TP.Hà Nội</h5>
                    <h5>Số điện thoại: 0332618888</h5>
                    <h5>Số Fax: 0843.666.666</h5>
                </div>

                <div class="hl-r">
                    <h2>HOÁ ĐƠN</h2>
                    <h5>Ngày xuất: <span>'.$order_date_format.'</span></h5><br>
                    <h5>Mã hoá đơn: <span>'.$order_code.'</span></h5>
                </div>
            </div>

            <div class="clear"></div>

            <div class="content-order">
                <div class="ct-t">
                    <div class="ct-t-l">
                        Người đặt hàng:
                    </div>

                    <div class="ct-t-r">
                        Vận chuyển tới:
                    </div>
                </div>

                <div class="clear"></div>

                <div class="ct-m">
                    <div class="ct-m-l">
                        <h5>Người đặt: '.$customer->customer_name.'</h5>
                        <h5>Số điện thoại: '.$customer->customer_phone.'</h5>
                        <h5>Địa chỉ: '.$customer->customer_address.'</h5>
                    </div>

                    <div class="ct-m-r">
                        <h5>Người nhận: '.$shipping->shipping_name.'</h5>
                        <h5>Số điện thoại: '.$shipping->shipping_phone.'</h5>
                        <h5>Địa chỉ: '.$shipping->shipping_address.'</h5>
                    </div>
                </div>

                <div class="clear"></div>
                ';
                if ($shipping->shipping_notes!=null){
                    $shipping_notes = $shipping->shipping_notes;
                }else{
                    $shipping_notes = 'Không';
                }
            $output.='
                <div class="ct-b">
                    <p>Ghi chú đơn đặt hàng: '.$shipping_notes.'</p>

                    <table class="table-responsive">
                        <thead>
                            <tr>
                              <th style="width: 5%">#</th>
                              <th style="width: 35%">Tên sản phẩm</th>
                              <th style="width: 15%">Số lượng</th>
                              <th style="width: 20%">Giá</th>
                              <th style="width: 25%">Số tiền</th>
                            </tr>
                        </thead>
                        <tbody>';

                        $total = 0;
                        $count = 1;

                        foreach($orderDetails as $ordDetail) {

                            $subtotal               = $ordDetail->product_price * $ordDetail->product_sales_quantity;
                            $total += $subtotal;

                            if ($ordDetail->product_coupon != 'no') {
                                $product_coupon     = $ordDetail->product_coupon;
                            } else {
                                $product_coupon     = '';
                            }

                            $output .= '
                                <tr>
                                   <td>'.$count++.'</td>
                                   <td>'.$ordDetail->product_name.'</td>
                                   <td>'.$ordDetail->product_sales_quantity.'</td>
                                   <td>'.number_format($ordDetail->product_price,0,',','.') .'</td>
                                   <td>'.number_format($subtotal,0,',','.') . ' ' . '₫'.'</td>
                                </tr>';
                        }

                        if($coupon_condition==1){
                            $total_after_coupon     = ($total*$coupon_number)/100;
                            $total_coupon           = $total - $total_after_coupon;
                        }else{
                            $total_coupon           = $total - $coupon_number;
                        }

                        $output.='
                            </tbody>

                            <tbody class="order-calculator">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Tổng tiền:</td>
                                    <td>'.number_format($total,0,',','.') . ' ' . '₫'.'</td>
                                </tr>
                            </tbody>

                            <tbody class="order-calculator">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Phiếu giảm:</td>
                                    <td>'.$coupon_echo.'</td>
                                </tr>
                            </tbody>

                            <tbody class="order-calculator">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Phí ship:</td>
                                    <td>'.number_format($ordDetail->product_feeship,0,',','.') . ' ' . '₫'.'</td>
                                </tr>
                            </tbody>

                            <tbody class="order-calculator">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Thành tiền:</td>
                                    <td>'.number_format($total_coupon + $ordDetail->product_feeship,0,',','.') . ' ' . '₫'.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="footer-order">
                    <div class="ft-l">
                        <i>Người lập phiếu</i>
                    </div>
                    <div class="ft-r">
                        <i>Người nhận</i>
                    </div>
                </div>
            ';

            return $output;
    }

    public function update_status_order(Request $request)
    {
        // Cập nhật trạng thái hóa đơn
        $data = $request->all();

        $order                                       = Order::find($data['order_id']);
        $order->order_status                         = $data['order_status'];
        $order->save();

        // Mail
        $customer                                    = Customer::where('customer_id', $order->customer_id)->first();
        $data['customer_email']                      = $customer->customer_email;

        $shipping                                    = Shipping::where('shipping_id', $order->shipping_id)->first();

        $shipping_array = array(
            'customer_name'                          => $customer->customer_name,
            'shipping_name'                          => $shipping->shipping_name,
            'shipping_phone'                         => $shipping->shipping_phone,
            'shipping_address'                       => $shipping->shipping_address,
            'shipping_email'                         => $shipping->shipping_email,
            'shipping_notes'                         => $shipping->shipping_notes,
            'shipping_method'                        => $shipping->shipping_method
        );
        // End Mail

        // So sánh ngày đặt hàng => doanh thu
        $order_date = $order->order_date;

        $statistic = Statistic::where('order_date', $order_date)->get();

        if($statistic){
            $statistic_count                         = $statistic->count();
        }else{
            $statistic_count                         = 0;
        }

        $ordDetails = DB::table('order_details')->where('order_code', $order->order_code)->get();

        foreach ($ordDetails as $ordDetail) {
            $product_coupon                          = $ordDetail->product_coupon;
            // Mail
            $product_feeship                         = $ordDetail->product_feeship;
            $checkout_code                           = $ordDetail->order_code;
            // End Mail
        }

        $coupons = Coupon::where('coupon_code', $product_coupon)->get();

        if($coupons){
            $coupons_count                           = $coupons->count();
        }else{
            $coupons_count                           = 0;
        }

        // Mail
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_mail                             = $coupon->coupon_code;
        }else{
            $coupon_mail                             = 'Không áp dụng';
        }
        // End Mail

        // Tính toán số lượng tồn đọng (update theo key)
        if($order->order_status == 2){

            $sales                                   = 0;
            $funds                                   = 0;
            $quantity                                = 0;
            $total_order                             = 0;

            foreach( $data['order_product_id'] as $key => $product_id ){

                $product                             = Product::find($product_id);

                $product_name                        = $product->product_name;
                $product_quantity                    = $product->product_quantity;
                $product_sold                        = $product->product_sold;

                $product_price                       = $product->product_price;
                $product_cost_price                  = $product->product_cost_price;

                foreach($data['quantity'] as $key2 => $qty){
                    if($key == $key2){
                        $product_remain              = $product_quantity - $qty;
                        $product->product_quantity   = $product_remain;
                        $product->product_sold       = $product_sold + $qty;
                        $product->save();

                        // Update doanh thu
                        $quantity+=$qty;

                        $sales+=$product_price*$qty;
                        $funds+=$product_cost_price*$qty;

                        // Mail
                        $cart_array[] = array(
                            'product_name'           => $product_name,
                            'product_price'          => $product_price,
                            'product_sales_quantity' => $qty
                        );
                        // End Mail
                    }
                }

                if($coupons_count > 0){
                    foreach ($coupons as $coupon) {
                        $coupon_condition           = $coupon->coupon_condition;
                        $coupon_number              = $coupon->coupon_number;
                    }

                    // Coupon + Feeship -> sales
                    if($coupon_condition == 1){
                        $sales_coupon                = ($sales * $coupon_number) / 100;
                        $sales_coupon_after          = $sales - $sales_coupon;
                    }else{
                        $sales_coupon_after          = $sales - $coupon_number;
                    }

                    $sales_coupon_fee_after          = $sales_coupon_after + $product_feeship;
                }else{
                    $sales_coupon_fee_after         = $sales + $product_feeship;
                }

                $profit_coupon_fee_after        = $sales_coupon_fee_after - $funds;
            }

            $total_order +=1;

            if($statistic_count > 0){
				$statistic_update                   = Statistic::where('order_date', $order_date)->first();
				$statistic_update->funds            = $statistic_update->funds + $funds;
				$statistic_update->sales            = $statistic_update->sales + $sales_coupon_fee_after;
				$statistic_update->profit           = $statistic_update->profit +  $profit_coupon_fee_after;
				$statistic_update->quantity         = $statistic_update->quantity + $quantity;
				$statistic_update->total_order      = $statistic_update->total_order + $total_order;
				$statistic_update->save();

			}else{
				$statistic_new = new Statistic();
				$statistic_new->order_date          = $order_date;
				$statistic_new->funds               = $funds;
				$statistic_new->sales               = $sales_coupon_fee_after;
				$statistic_new->profit              = $profit_coupon_fee_after;
				$statistic_new->quantity            = $quantity;
				$statistic_new->total_order         = $total_order;
				$statistic_new->save();
			}

            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $title_mail = "Đơn hàng đã đặt được xác nhận".' '.$now;

            // Get order/coupon code
            $code_mail = array(
                'coupon_code'                       => $coupon_mail,
                'order_code'                        => $checkout_code,
                'fee_ship'                          => $product_feeship
            );

            $coupons = Coupon::where('coupon_code', $product_coupon)->get();

            if($coupons->count() > 0){
                foreach ($coupons as $coupon) {
                    $coupon_array[] = array(
                        'coupon_condition'                   => $coupon->coupon_condition,
                        'coupon_number'                      => $coupon->coupon_number
                    );
                }
            }else{
                $coupon_array[] = array(
                    'coupon_condition'   => 2,
                    'coupon_number'      => 0
                );
            }

            // Send mail
            Mail::send('admin.mail.mail_confirm_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code_mail' => $code_mail, 'coupon_array' => $coupon_array], function($message) use ($title_mail, $data){
                $message->to($data['customer_email'])->subject($title_mail);
                $message->from($data['customer_email'],$title_mail);
            });

        }elseif($order->order_status == 3){

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
    }

    public function update_order_qty(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            DB::table('order_details')->where('product_id', $data['product_id'])
            ->where('order_code', $data['order_code'])
            ->update(['product_sales_quantity' => $data['order_qty']]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
