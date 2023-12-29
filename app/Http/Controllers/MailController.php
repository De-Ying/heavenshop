<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Coupon;


class MailController extends Controller
{
    public function send_coupon_normal($coupon_code)
    {
        $customer_normal = Customer::where('customer_vip', '<>', 1)->get();

        $coupon = Coupon::where('coupon_code', $coupon_code)->first();
        $coupon_start_date = $coupon->coupon_start_date;
        $coupon_end_date   = $coupon->coupon_end_date;
        $coupon_time       = $coupon->coupon_time;
        $coupon_condition  = $coupon->coupon_condition;
        $coupon_number     = $coupon->coupon_number;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;

        $data = [];
        foreach ($customer_normal as $normal) {
            $data['customer_email'][] = $normal->customer_email;
        }

        $coupon = array(
            'coupon_start_date' => $coupon_start_date,
            'coupon_end_date'   => $coupon_end_date,
            'coupon_time'       => $coupon_time,
            'coupon_condition'  => $coupon_condition,
            'coupon_number'     => $coupon_number,
            'coupon_code'       => $coupon_code,
        );

        Mail::send('admin.mail.send_coupon_normal', ['coupon' => $coupon], function($message) use ($title_mail, $data){
            $message->to($data['customer_email'])->subject($title_mail);
            $message->from($data['customer_email'], $title_mail);
        });

        return redirect()->route('coupon.view_all')->with('success', 'Gửi mã khuyến mãi cho khách hàng thành công');
    }

    public function send_coupon_vip($coupon_code)
    {
        $customer_vip = Customer::where('customer_vip', 1)->get();

        $coupon = Coupon::where('coupon_code', $coupon_code)->first();
        $coupon_start_date = $coupon->coupon_start_date;
        $coupon_end_date   = $coupon->coupon_end_date;
        $coupon_time       = $coupon->coupon_time;
        $coupon_condition  = $coupon->coupon_condition;
        $coupon_number     = $coupon->coupon_number;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;

        $data = [];
        foreach ($customer_vip as $vip) {
            $data['customer_email'][] = $vip->customer_email;
        }

        $coupon = array(
            'coupon_start_date' => $coupon_start_date,
            'coupon_end_date'   => $coupon_end_date,
            'coupon_time'       => $coupon_time,
            'coupon_condition'  => $coupon_condition,
            'coupon_number'     => $coupon_number,
            'coupon_code'       => $coupon_code,
        );

        Mail::send('admin.mail.send_coupon_vip', ['coupon' => $coupon], function($message) use ($title_mail, $data){
            $message->to($data['customer_email'])->subject($title_mail);
            $message->from($data['customer_email'], $title_mail);
        });

        return redirect()->route('coupon.view_all')->with('success', 'Gửi mã khuyến mãi cho khách hàng vip thành công');
    }
}
