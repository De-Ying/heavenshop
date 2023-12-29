<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

use App\Models\Customer;

class ForgotPasswordController extends Controller
{
    public function forgot_password()
    {
        $meta_title = "Quên mật khẩu";
        return view('pages.buyer.forgot_password')->with('meta_title', $meta_title);
    }

    public function recovery_password(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('customer_email');
            $title_mail = "Thông báo đặt lại mật khẩu | Heaven Shop";

            $customer = Customer::where('customer_email', $data['customer_email'])->first();

            if (!$customer) {
                Toastr::error('E-Mail chưa được đăng ký để khôi phục mật khẩu', 'Error');
                return redirect()->back();
            }

            $existingToken = DB::table('password_resets')->where('email', $data['customer_email'])->count();

            if ($existingToken > 0) {
                Toastr::warning('E-Mail đã được gửi vào mail!', 'Warning');
                return redirect()->back();
            }

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email'      => $data['customer_email'],
                'token'      => $token,
                'created_at' => now('Asia/Ho_Chi_Minh'),
            ]);

            $emailTo = $data['customer_email'];
            $link_reset_password = url('/buyer/reset-password?email=' . $emailTo . '&token=' . $token);

            $mailData = [
                'link'  => $link_reset_password,
                'email' => $emailTo,
                'name'  => $customer->customer_name,
            ];

            Mail::send('pages.mail.send_recovery_password', ['data' => $mailData], function ($message) use ($title_mail, $mailData) {
                $message->to($mailData['email'])->subject($title_mail);
                $message->from($mailData['email'], $title_mail);
            });

            Toastr::success('Gửi mail thành công, vui lòng kiểm tra mail để lấy link đổi mật khẩu', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            // Handle exceptions if needed
            Toastr::error('Có lỗi xảy ra trong quá trình gửi mail khôi phục mật khẩu', 'Error');
            return redirect()->back();
        }
    }
}
