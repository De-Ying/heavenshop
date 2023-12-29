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
                Hồ sơ
            </span>
        </div>
    </div>


    <div class="bg0 m-t-30 p-b-80">
        <div class="container">
            <div class="row p-t-10">
                <div class="m-6 col l-3 c-12 p-b-50">
                    <div class="profile-user">
                        @if (Session::has('customer_image'))
                            <img class="img-radius img-40 radius-50 w-70 h-70"
                                src="{{ url('public/uploads/customer/' . Session::get('customer_image')) }}"
                                alt="profile-user">
                        @elseif (Session::has('customer_image_social'))
                            <img class="img-radius img-40 radius-50" src="{{ Session::get('customer_image_social') }}"
                                alt="profile-user">
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
                                            href="{{ route('purchase') }}"><i class="zmdi zmdi-assignment"></i> Lịch sử
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
                                            href="{{ route('buyer.logout') }}"><i class="icofont icofont-logout"></i> Đăng
                                            xuất</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-6 col l-9 c-12">
                    <h5 class="fs-16">Hồ sơ của tôi</h5>
                    <h6 class="m-t-10 m-b-30 fs-14">Quản lý thông tin hồ sơ để bảo mật tài khoản</h6>

                    <form action="{{ route('account.update_profile') }}" method="POST" id="validate_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col l-8 c-12">
                                <div class="profile-account p-r-30">
                                    <input type="hidden" value="{{ Session::get('customer_id') }}" name="customer_id">

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
                                        <label class="col l-3 col-form-label fs-14 c-12">Họ & tên</label>
                                        <div class="l-9 c-12">
                                            <input type="text" class="form-control" name="customer_name"
                                                value="{{ Session::get('customer_name') }}" required=""
                                                data-parsley-required-message="* Tên không được để trống"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col l-3 col-form-label fs-14 c-12">E-Mail</label>
                                        <div class="l-9 c-12">
                                            <input type="text" class="form-control" name="customer_email"
                                                value="{{ Session::get('customer_email') }}" required=""
                                                data-parsley-required-message="* E-Mail không được để trống"
                                                data-parsley-pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                data-parsley-trigger="keyup"
                                                data-parsley-pattern-message="E-Mail không đúng định dạng"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col l-3 col-form-label fs-14 c-12">Số điện thoại</label>
                                        <div class="l-9 c-12">
                                            <input type="text" class="form-control" name="customer_phone"
                                                value="{{ Session::get('customer_phone') }}" required=""
                                                data-parsley-required-message="* Số điện thoại không được để trống"
                                                data-parsley-pattern="^[0-9\-\+]{9,15}$" data-parsley-trigger="keyup"
                                                data-parsley-pattern-message="* Số điện thoại không đúng định dạng"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col l-3 col-form-label fs-14 c-12">Địa chỉ</label>
                                        <div class="l-9 c-12">
                                            <input type="text" class="form-control" name="customer_address"
                                                value="{{ Session::get('customer_address') }}" required=""
                                                data-parsley-required-message="* Địa chỉ không được để trống"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row p-b-50">
                                    <div class="col l-12 c-12">
                                        <button class="btn btn-danger fs-16" type="submit">Cập nhật</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col l-4">
                                <div class="text-center m-b-25">
                                    @if (Session::has('customer_image'))
                                        <img class="img-radius img-40 radius-50 w-120 h-120"
                                            src="{{ url('public/uploads/customer/' . Session::get('customer_image')) }}"
                                            alt="contact-user">
                                    @elseif (Session::has('customer_image_social'))
                                        <img class="img-radius img-40 radius-50 w-120"
                                            src="{{ Session::get('customer_image_social') }}" alt="contact-user">
                                    @endif
                                </div>

                                <div class="input-group fs-14" style="border: 1px solid #ccc">
                                    <div style="width: 100%">
                                        <label id="reflink">Browse</label>
                                        <input type="file" class="form-control " name="customer_image"
                                            accept=".jpg,.jpeg,.png"
                                            onchange="document.getElementById('file_input').value = this.value;">
                                        <input type="text" id="file_input" readonly="" placeholder="Hình ảnh">
                                    </div>
                                </div>
                                <div class="input-group m-t-15 fs-14">
                                    <span class="j-hint">Only: .png / .jpg / .jpeg / ...</span>
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
                filterAccount[i].classList.add('account-link-active');
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
