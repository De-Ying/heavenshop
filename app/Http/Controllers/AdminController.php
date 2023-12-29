<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * GET: Hiển thị đăng nhập quản trị viên
     *
     * @return void
    */

    public function getLogin()
    {
        $title = 'Cửa hàng bán quần áo thời trang Heaven | Đăng nhập';

        return view('admin_login')->with('title', $title);
    }

    /**
     * POST: Xử lý đăng nhập người dùng
     *
     * @param  mixed $request
     * @return void
    */

    public function postLogin(Request $request)
    {
        try {
            DB::beginTransaction();

            $credentials = [
                'email'    => $request->email,
                'password' => $request->password,
                'status'   => 1,
            ];

            $remember = $request->filled('remember');

            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $user = Auth::guard('admin')->user();
                $redirects = [
                    'administrator'        => 'dashboard',
                    'merchandiser'         => 'dashboardMC',
                    'product-management'   => 'dashboardPCM',
                    'post-management'      => 'dashboardPSM',
                    'interface-management' => 'dashboardIM',
                    'customer-care'        => 'dashboardCC',
                ];

                if (array_key_exists($user->role, $redirects)) {
                    DB::commit();
                    return redirect()->route($redirects[$user->role]);
                } else {
                    Toastr::error('Quyền người dùng không hợp lệ!', 'Error');
                }
            }else {
                Toastr::error('Dữ liệu truyền vào không đúng!', 'Error');
            }

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * GET: Xử lý đăng xuất người dùng
     *
     * @param  mixed $request
     * @return void
    */

    public function getLogout()
    {
        try {
            Auth::guard('admin')->logout();
            Toastr::success('Đăng xuất khỏi trang quản trị thành công', 'Success');
            return redirect()->route('admin.getLogin');
        } catch (\Throwable $th) {
            return redirect()->route('admin.getLogin')->withErrors(['error' => 'Có lỗi xảy ra trong quá trình đăng xuất']);
        }
    }

    /**
     * GET: Hiển thị form khôi phục mật khẩu
     *
     * @return void
    */

    public function reset_password()
    {
        $title = 'Cửa hàng bán quần áo thời trang Heaven | Khôi phục mật khẩu';

        return view('admin.reset_password')->with('title', $title);
    }

    /**
     * GET: Hiển thị hồ sơ người dùng
     *
     * @param  mixed $id
     * @return void
    */

    public function profile($id)
    {
        $profile = Admin::where('id', $id)->first();

        return view('admin.profile', [
            'profile' => $profile
        ]);
    }

    /**
     * POST: Cập nhật thông tin người dùng
     *
     * @param  mixed $request
     * @return void
    */

    public function update_profile(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = array();

            $data['full_name']  = $request->full_name;
            $data['user_name']  = $request->user_name;
            $data['email']      = $request->email;
            $data['phone']      = $request->phone;
            $data['address']    = $request->address;
            $data['gender']     = $request->gender;


            $get_image = $request->file('avatar');
            $path      = 'public/uploads/avatar/';

            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $data['avatar'] = $new_image;

                $admin = Admin::find($id);

                if($admin->avatar != NULL){
                    unlink($path.$admin->avatar);
                }

                $admin->update($data);
                Toastr::success('Cập nhật thông tin hồ sơ thành công','Success');
                DB::commit();
                return redirect()->route('admin.profile', [$id]);
            }

            $admin = Admin::find($id)->update($data);
            Toastr::success('Cập nhật thông tin hồ sơ thành công','Success');
            DB::commit();
            return redirect()->route('admin.profile', [$id]);
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật thông tin hồ sơ thất bại','Error');
            DB::rollBack();
        }
    }

    /**
     * POST: Đổi mật khẩu
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
    */

    public function change_password(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Admin::find($id)->update(['password' => Hash::make($request->password)]);
            Toastr::success('Đổi mật khẩu thành công','Success');
            DB::commit();
            return redirect()->route('admin.profile', [$id]);
        } catch (\Throwable $th) {
            Toastr::error('Đổi mật khẩu thất bại', 'Error');
            DB::rollBack();
        }
    }

    /**
     * POST: Cập nhật đổi mật khẩu
     *
     * @param  mixed $request
     * @return void
    */

    public function update_password(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $updatePassword = DB::table('password_resets')->where([
                'email'    => $data['email'],
                'token'    => $data['token']
            ])->first();

            if(!$updatePassword){
                Toastr::error('Mã token không hợp lệ!', 'Error');
                DB::commit();
                return redirect()->back();
            }else{
                Admin::where('email', $data['email'])
                ->update(['password' => Hash::make($data['password'])]);

                DB::table('password_resets')->where(['email' => $data['email']])->delete();

                Toastr::success('Bạn đã đổi mật khẩu thành công!','Success');
                DB::commit();
                return redirect()->route('admin.getLogin');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function recovery_password(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $title_mail = "Thông báo đặt lại mật khẩu | Heaven Shop";

            $admin = Admin::where('email', $data['email'])->get();

            if($admin){

                $pwd = DB::table('password_resets')->where('email', $data['email'])->get();
                $count_pwd = $pwd->count();

                $count_admin = $admin->count();

                if($count_admin == 0){
                    Toastr::error('E-Mail chưa được đăng ký để khôi phục mật khẩu','Error');
                    DB::commit();
                    return redirect()->back();
                }else if($count_pwd > 0) {
                    Toastr::warning('E-Mail đã được gửi vào mail!', 'Warning');
                    DB::commit();
                    return redirect()->back();
                }else{
                    $token = Str::random(64);

                    DB::table('password_resets')->insert([
                        'email'      => $data['email'],
                        'token'      => $token,
                        'created_at' => $created_at
                    ]);

                    // Send mail
                    $emailTo = $data['email'];
                    $link_reset_password = url('/admin/reset-password?email='.$emailTo.'&token='.$token);

                    $admin = Admin::where('email', $emailTo)->first();

                    $data = array(
                        'link'  => $link_reset_password,
                        'email' => $data['email'],
                        'name'  => $admin->full_name
                    );

                    Mail::send('pages.mail.send_recovery_password', ['data' => $data], function($message) use ($title_mail, $data){
                        $message->to($data['email'])->subject($title_mail);
                        $message->from($data['email'], $title_mail);
                    });

                    // Notification mail
                    Toastr::success('Gửi mail thành công, vui lòng kiểm tra mail để lấy link đổi mật khẩu', 'Success');
                    DB::commit();
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
