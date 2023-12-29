@extends('layout')
@push('css')
    <!--=================================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!--=================================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/login.css') !!}">
    <!--=================================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/color/color-1.css') !!}" id="color" />
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
                Khôi phục mật khẩu
            </span>
        </div>

        <div class="row p-b-80 p-t-30">
            <div class="m-12 col l-6 c-12">
                <h4 class="m-b-15 fs-14">Khôi phục mật khẩu</h4>

                <form action="{{ route('recovery_password') }}" method="post" id="validate_form">
                    @csrf
                    <h6>Địa chỉ E-Mail <strong>*</strong></h6>
                    <div class="form-group">
                        <input type="text" name="customer_email" class="form-control" required
                        data-parsley-required-message="E-Mail không được để trống"
                        required data-parsley-pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        data-parsley-trigger="keyup"
                        data-parsley-pattern-message="E-Mail không đúng định dạng" >
                    </div>
                    <button type="submit" class="continue">
                        Khôi phục
                    </button>
                </form>
            </div>

            <div class="m-12 col l-6 c-12"></div>
        </div>

    </div>
@endsection
