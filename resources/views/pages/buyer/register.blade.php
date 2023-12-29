@extends('layout')
@push('css')
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/login.css') !!}">
    <!--=================================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/jquery.mCustomScrollbar.css') !!}">

    <style>
        .parsley-errors-list {
            line-height: 1.5rem !important;
            margin-top: 10px;
        }

    </style>
@endpush

@section('main')
    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('buyer.login') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Đăng nhập
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Đăng ký
            </span>
        </div>

        <form action="{{ route('buyer.process_register') }}" method="post" id="validate_form" autocomplete="off">
            @csrf
            <h4 class="m-t-30 fs-16">Tạo mới tài khoản</h4>

            <div class="row p-t-20">
                <div class="m-6 col l-6 c-12 p-r-15">
                    <div class="form-group">
                        <input type="text" name="customer_name" class="form-control" placeholder="Tên đầy đủ" required
                            data-parsley-required-message="* Họ và tên không được để trống">
                    </div>
                    <div class="form-group">
                        <input type="text" name="customer_email" class="form-control" placeholder="E-Mail" required
                            data-parsley-required-message="* E-Mail không được để trống" required
                            data-parsley-pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" data-parsley-trigger="keyup"
                            data-parsley-pattern-message="* E-Mail không đúng định dạng">
                    </div>
                    <div class="form-group">
                        <input type="password" name="customer_password" class="form-control" id="new_password"
                            placeholder="Mật khẩu" required data-parsley-required-message="* Mật khẩu không được để trống"
                            data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường">
                    </div>
                </div>

                <div class="m-6 col l-6 c-12">
                    <div class="form-group">
                        <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại" required
                            data-parsley-required-message="* Số điện thoại không được để trống"
                            data-parsley-pattern="^[0-9\-\+]{9,15}$" data-parsley-trigger="keyup"
                            data-parsley-pattern-message="* Số điện thoại không đúng định dạng">
                    </div>
                    <div class="form-group">
                        <input type="text" name="customer_address" class="form-control" placeholder="Địa chỉ" required
                            data-parsley-required-message="* Địa chỉ không được để trống">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Xác nhận mật khẩu" required
                            data-parsley-required-message="* Xác nhận mật khẩu không được để trống"
                            data-parsley-equalto="#new_password" data-parsley-trigger="keyup"
                            data-parsley-equalto-message="* Mật khẩu mới và Mật khẩu xác nhận không giống nhau"
                            data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                            data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường">
                    </div>
                </div>
            </div>

            <div class="row p-b-60">
                <div class="m-6 col l-6 c-12 p-r-15">
                    <button type="submit" class="continue">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>
@endsection
