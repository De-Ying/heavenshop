@extends('layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/login.css') !!}">
@endpush

@section('main')
    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Đăng nhập
            </span>
        </div>

        <div class="row p-t-30 p-b-60">
            <div class="m-6 col l-6 c-12 p-r-15">
                <div class="buyer-register p-b-40">
                    <h4 class="m-b-15 fs-16">Đăng ký</h4>
                    <p class="text-justify m-b-15 fs-14">Bằng cách tạo tài khoản với cửa hàng của chúng tôi, bạn sẽ có thể
                        chuyển qua
                        quy trình thanh toán nhanh hơn, lưu trữ nhiều địa chỉ giao hàng, xem và theo dõi đơn hàng của bạn
                        trong
                        tài khoản của bạn và hơn thế nữa.</p>
                    <a href="{{ route('buyer.register') }}">
                        <button type="button" class="continue">Tiếp tục</button>
                    </a>
                </div>
            </div>

            <div class="m-6 col l-6 c-12">
                <div class="buyer-login">
                    <h4 class="m-b-15 fs-16">Đăng nhập</h4>
                    <form action="{{ route('buyer.process_login') }}" method="POST" id="validate_form" autocomplete="off">
                        @csrf

                        <h6>Địa chỉ E-Mail <strong>*</strong></h6>
                        <div class="form-group">
                            <input type="text" name="customer_email" class="form-control" required
                                data-parsley-required-message="* E-Mail không được để trống" required
                                data-parsley-pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" data-parsley-trigger="keyup"
                                data-parsley-pattern-message="* E-Mail không đúng định dạng">
                        </div>
                        <h6>Mật khẩu <strong>*</strong></h6>
                        <div class="form-group">
                            <input type="password" name="customer_password" class="form-control" required
                                data-parsley-required-message="* Mật khẩu không được để trống"
                                data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                data-parsley-trigger="keyup"
                                data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường">
                        </div>
                        <h6>
                            <a href="{{ route('buyer.forgot_password') }}" class="text-black-w">Quên mật khẩu?</a>
                        </h6>

                        <div class="row pull-right">
                            <div class="col l-12">
                                <a href="{{ route('login_customer_google') }}"
                                    class="text-white p-full-7 bg-blue-w b-radius-3 fs-14"><img
                                        src="{{ asset('public/frontend/images/icons/google.png') }}"
                                        class="bg-white b-radius-3 p-full-2" alt="#"> Google</a>
                                <a href="{{ route('login_customer_facebook') }}"
                                    class="text-white p-full-7 bg-blue-w b-radius-3 fs-14"><i
                                        class="bg-white icofont icofont-social-facebook text-blue-w b-radius-1p2 p-r-2 p-l-2"></i>
                                    Facebook</a>
                                <i class="icofont icofont-infinite p-t-10 p-b-10 p-r-5 p-l-5 fs-12"></i>
                                <button type="submit" class="continue m-t-10">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
