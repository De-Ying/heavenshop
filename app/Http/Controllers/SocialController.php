<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

use App\Models\Customer;
use App\Models\Social;

class SocialController extends Controller
{
    // Google (FE)

    public function login_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }

    public function callback_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);

        $users = Socialite::driver('google')->stateless()->user();

        $authUser = $this->findOrCreateCustomerByGoogle($users, 'google');

        if($authUser){
            $account_customer = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_customer->customer_id);
            Session::put('customer_name', $account_customer->customer_name);
            Session::put('customer_image_social', $account_customer->customer_image);
            Session::put('customer_email', $account_customer->customer_email);
            Session::put('customer_phone', $account_customer->customer_phone);
            Session::put('customer_address', $account_customer->customer_address);
        }else if($new_customer){
            $account_customer = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_customer->customer_id);
            Session::put('customer_name', $account_customer->customer_name);
            Session::put('customer_image_social', $account_customer->customer_image);
            Session::put('customer_email', $account_customer->customer_email);
            Session::put('customer_phone', $account_customer->customer_phone);
            Session::put('customer_address', $account_customer->customer_address);
        }

        if(Session::get('cart')){
            return redirect()->route('checkout');
        }else{
            return redirect()->route('home_page');
        }
    }

    public function findOrCreateCustomerByGoogle($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();

        if($authUser){
            return $authUser;
        }else{
            $new_customer = new Social([
                'provider_user_id'    => $users->id,
                'provider_user_email' => $users->email,
                'provider'            => strtoupper($provider) // strtoupper: Chuyển tất cả chuỗi thành in Hoa
            ]);

            $customer = Customer::where('customer_email', $users->email)->first();

            if(!$customer){
                $customer = Customer::create([
                    'customer_name'     => $users->name,
                    'customer_email'    => $users->email,
                    'customer_image'    => $users->avatar,
                    'customer_password' => '',
                    'customer_phone'    => '',
                    'customer_address'  => '',
                    'customer_social'  => 1,
                ]);
            }

            $new_customer->customer()->associate($customer); // associate: nối 2 bảng lại với nhau

            $new_customer->save();
            return $new_customer;
        }
    }

    // Facebook (FE)

    public function login_customer_facebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_customer_facebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);

        $users = Socialite::driver('facebook')->user();

        $authUser = $this->findOrCreateCustomerByFacebook($users, 'facebook');

        if($authUser){
            $account_customer = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_customer->customer_id);
            Session::put('customer_name', $account_customer->customer_name);
            Session::put('customer_image_social', $account_customer->customer_image);
            Session::put('customer_email', $account_customer->customer_email);
            Session::put('customer_phone', $account_customer->customer_phone);
            Session::put('customer_address', $account_customer->customer_address);
        }elseif($new_customer){
            $account_customer = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_customer->customer_id);
            Session::put('customer_name', $account_customer->customer_name);
            Session::put('customer_image_social', $account_customer->customer_image);
            Session::put('customer_email', $account_customer->customer_email);
            Session::put('customer_phone', $account_customer->customer_phone);
            Session::put('customer_address', $account_customer->customer_address);
        }

        if(Session::get('cart')){
            return redirect()->route('checkout');
        }else{
            return redirect()->route('home_page');
        }
    }

    public function findOrCreateCustomerByFacebook($users, $provider)
    {
        $authUser = Social::where('provider', 'facebook')->where('provider_user_id', $users->getId())->first();

        if($authUser){
            return $authUser;
        }else{
            $new_customer = new Social([
                'provider_user_id'    => $users->getId(),
                'provider_user_email' => $users->getEmail(),
                'provider'            => strtoupper($provider) // strtoupper: Chuyển tất cả chuỗi thành in Hoa
            ]);

            $customer = Customer::where('customer_email', $users->getEmail())->first();

            if(!$customer){
                $customer = Customer::create([
                    'customer_name'     => $users->getName(),
                    'customer_email'    => $users->getEmail(),
                    'customer_image'    => $users->avatar,
                    'customer_password' => '',
                    'customer_phone'    => '',
                    'customer_address'  => '',
                    'customer_social'  => 1,
                ]);
            }

            $new_customer->customer()->associate($customer); // associate: nối 2 bảng lại với nhau

            $new_customer->save();
            return $new_customer;
        }
    }
}
