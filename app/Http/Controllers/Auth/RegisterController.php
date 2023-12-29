<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

use App\Models\Customer;

class RegisterController extends Controller
{
    public function register()
    {
        $meta_title = "Đăng ký";
        return view('pages.buyer.register')->with('meta_title', $meta_title);
    }

    public function process_register(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $email = $data['customer_email'];

            if (Customer::where('customer_email', $email)->exists()) {
                Toastr::error('E-Mail đã được sử dụng', 'Error');
                return redirect()->route('register');
            }

            $data['customer_password'] = bcrypt($data['customer_password']);
            $customer = Customer::create($data);

            $sessionData = [
                'customer_id', 'customer_name', 'customer_email',
                'customer_image', 'customer_phone', 'customer_address',
            ];

            Session::put(array_combine($sessionData, $customer->toArray()));
            $redirectRoute = Session::get('cart') ? 'checkout' : 'home_page';

            Toastr::success('Đăng kí tài khoản thành công', 'Success');
            DB::commit();
            return redirect()->route($redirectRoute);
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Có lỗi xảy ra trong quá trình đăng ký', 'Error');
            return redirect()->route('register');
        }
    }
}
