<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

use App\Models\Customer;

class ResetPasswordController extends Controller
{
    public function reset_password()
    {
        $meta_title = "Đặt lại mật khẩu";

        return view('pages.buyer.reset_password')->with('meta_title', $meta_title);
    }

    public function update_password(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['email', 'token', 'customer_password']);

            $updatePassword = DB::table('password_resets')
            ->where($data)
            ->first();

            if (!$updatePassword) {
                Toastr::error('Mã token không hợp lệ!', 'Error');
                return redirect()->back();
            }

            Customer::where('customer_email', $data['email'])
            ->update(['customer_password' => Hash::make($data['customer_password'])]);

            DB::table('password_resets')->where('email', $data['email'])->delete();

            Toastr::success('Bạn đã đổi mật khẩu thành công', 'Success');
            DB::commit();
            return redirect()->route('buyer.login');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Có lỗi xảy ra trong quá trình đổi mật khẩu', 'Error');
            return redirect()->back();
        }
    }
}
