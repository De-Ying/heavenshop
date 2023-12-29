@extends('layout')
@push('css')
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/login.css') !!}">
    <!--=================================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/jquery.mCustomScrollbar.css') !!}">
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
                Đặt lại mật khẩu
            </span>
        </div>

        @php
            $token = $_GET['token'];
            $email = $_GET['email'];
        @endphp

        <div class="row p-t-30 p-b-60">
            <div class="m-6 col l-6 c-12 p-r-15">
                <h4 class="m-b-15">Đặt lại mật khẩu</h4>
                <form action="{{ route('buyer.update_password') }}" method="post" id="validate_form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <h6>Mật khẩu <strong>*</strong></h6>
                    <div class="form-group">
                        <input type="password" name="customer_password" id="customer_password" class="form-control" required=""
                        data-parsley-required-message="* Mật khẩu mới không được để trống"
                        data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                        data-parsley-trigger="keyup"
                        data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                        autocomplete="off">
                    </div>

                    <h6>Xác nhận mật khẩu <strong>*</strong></h6>
                    <div class="form-group">
                        <input type="password" class="form-control" required=""
                        data-parsley-required-message="* Xác nhận mật khẩu không được để trống"
                        data-parsley-equalto="#customer_password"
                        data-parsley-trigger="keyup"
                        data-parsley-equalto-message="* Mật khẩu mới và Mật khẩu xác nhận không giống nhau"
                        data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                        data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                        autocomplete="off">
                    </div>
                    <button type="submit" class="continue">
                        Đặt lại
                    </button>
                </form>
            </div>

            <div class="m-6 col l-6 c-12 p-r-15">

            </div>
        </div>
    </div>
@endsection

