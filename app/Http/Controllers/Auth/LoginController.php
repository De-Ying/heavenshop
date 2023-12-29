<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Brian2694\Toastr\Facades\Toastr;

use App\Models\Customer;

class LoginController extends Controller
{
    public function login()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Đăng nhập";

        return view('pages.buyer.login')->with('meta_title', $meta_title);
    }

    public function process_login(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['customer_email', 'customer_password']);
            $customer = Customer::where('customer_email', $data['customer_email'])->first();

            if (!$customer || !Hash::check($data['customer_password'], $customer->customer_password)) {
                Toastr::error('Không tồn tại tài khoản hoặc mật khẩu không đúng', 'Error');
                return redirect()->route('buyer.login');
            }

            if ($customer->customer_status !== 1) {
                Toastr::error('Tài khoản tạm thời bị khóa', 'Error');
                return redirect()->route('buyer.login');
            }

            Session::put([
                'customer_id'       => $customer->customer_id,
                'customer_name'     => $customer->customer_name,
                'customer_email'    => $customer->customer_email,
                'customer_image'    => $customer->customer_image,
                'customer_phone'    => $customer->customer_phone,
                'customer_address'  => $customer->customer_address,
            ]);

            $redirectRoute = Session::get('cart') ? 'checkout' : 'product';

            Toastr::success('Đăng nhập tài khoản thành công', 'Success');
            DB::commit();
            return redirect()->route($redirectRoute);
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Có lỗi xảy ra trong quá trình đăng nhập', 'Error');
            return redirect()->route('buyer.login');
        }
    }

    public function logout()
    {
        try {
            Session::flush();
            Toastr::success('Đăng xuất thành công', 'Success');
            return redirect()->route('buyer.login');
        } catch (\Throwable $th) {
            Toastr::error('Có lỗi xảy ra trong quá trình đăng xuất', 'Error');
            return redirect()->route('buyer.login');
        }
    }
}
