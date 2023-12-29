@extends('layout')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/profile.css') !!}">
    @endpush

    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                @lang('lang.home')
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="uppercase stext-109 cl4 text-red">
                Đổi mật khẩu
            </span>
        </div>
    </div>


    <div class="bg0 m-t-30 p-b-80">
        <div class="container">

            <div class="row">

                <div class="m-6 col l-3 c-12 p-b-30">
                    <div class="row">
                        <div class="col l-12 c-12 m-12">
                            <div class="password-user">
                                @if (Session::has('customer_image'))
                                    <img class="img-radius img-40 radius-50 w-70 h-70"
                                        src="{{ url('public/uploads/customer/' . Session::get('customer_image')) }}"
                                        alt="profile-user">
                                @elseif (Session::has('customer_image_social'))
                                    <img class="img-radius img-40 radius-50"
                                        src="{{ Session::get('customer_image_social') }}" alt="profile-user">
                                @endif

                                <div class="m-t-30 m-l-50">
                                    <h5 class="m-b-5 fs-20">
                                        @if (Session::get('customer_id') != null)
                                            {{ Session::get('customer_name') }}
                                        @endif
                                    </h5>

                                    <span>
                                        <a class="text-black-36 fs-14" href="{{ route('account.profile') }}"><i
                                                class="icofont icofont-edit"></i> Sửa hồ sơ</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col l-12 c-12 m-12">
                            <div class="p-t-50">
                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                    class="uppercase text-black-36 fs-14" href="#account" id="profile">
                                                    <span class="caret"></span>
                                                    <i class="icofont icofont-user-alt-2"></i> Tài khoản của tôi
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="account" class="panel-collapse collapse">
                                            <div class="panel-body m-b-5 m-l-15">
                                                <ul>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.profile') }}">Hồ sơ</a>
                                                    </li>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.password') }}">Đổi mật khẩu</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('purchase') }}"><i class="zmdi zmdi-assignment"></i>
                                                    Lịch sử
                                                    mua hàng</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 wishlist-link fs-14"
                                                    href="{{ route('wishlist') }}"><i class="fa fa-heart-o"
                                                        aria-hidden="true"></i> Danh sách yêu thích</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('buyer.logout') }}"><i
                                                        class="icofont icofont-logout"></i> Đăng
                                                    xuất</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-6 col l-9 c-12 p-b-20">
                    <h5 class="fs-16">Đổi mật khẩu</h5>
                    <h6 class="m-t-10 m-b-30 fs-14">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác
                    </h6>

                    <form action="{{ route('account.change_password') }}" method="POST" id="validate_form">
                        @csrf
                        <div class="row">
                            <div class="col l-12 m-12 c-12">
                                <div class="p-r-30">
                                    <input type="hidden" value="{{ Session::get('customer_email') }}"
                                        name="customer_email">

                                    @if (session('success'))
                                        <div class="form-group">
                                            <div class="alert alert-success icons-alert" role="alert">
                                                <li style="display: block">{{ session('success') }}</li>
                                            </div>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="form-group">
                                            <div class="alert alert-danger icons-alert" role="alert">
                                                <li style="display: block">{{ session('error') }}</li>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col l-2 col-form-label c-12 fs-14">Mật khẩu mới</label>
                                        <div class="col l-10">
                                            <input type="password" class="form-control" name="new_password"
                                                id="new_password" required=""
                                                data-parsley-required-message="* Mật khẩu mới không được để trống"
                                                data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                                data-parsley-trigger="keyup"
                                                data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col l-2 col-form-label c-12 fs-14">Xác nhận mật khẩu mới</label>
                                        <div class="col l-10">
                                            <input type="password" class="form-control" required=""
                                                data-parsley-required-message="* Xác nhận mật khẩu không được để trống"
                                                data-parsley-equalto="#new_password" data-parsley-trigger="keyup"
                                                data-parsley-equalto-message="* Mật khẩu mới và Mật khẩu xác nhận không giống nhau"
                                                data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                                data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col l-12 c-12">
                                        <button class="btn btn-danger fs-16" type="submit">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        const currentLocationAccount = location.href;
        const filterAccount = document.querySelectorAll('.account-link');
        const filterLengthAccount = filterAccount.length;
        for (let i = 0; i < filterLengthAccount; i++) {
            if (filterAccount[i].href === currentLocationAccount) {
                filterAccount[i].className = "account-link-active";
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            if ($('li a').hasClass('account-link-active')) {
                $('#account').addClass('show');
                $('#profile').addClass('active');
            }
        });
    </script>
@endpush
