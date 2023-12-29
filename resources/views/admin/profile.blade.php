@extends('admin_layout')
@section('title', 'Hồ sơ cá nhân')
@push('css')

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/bootstrap/css/bootstrap.min.css') !!}">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/pages/advance-elements/css/bootstrap-datetimepicker.css') !!}">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/bootstrap-daterangepicker/css/daterangepicker.css') !!}">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/datedropper/css/datedropper.min.css') !!}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') !!}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/themify-icons/themify-icons.css') !!}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/feather/css/feather.css') !!}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/jquery.mCustomScrollbar.css') !!}">
    <!-- Parsley.css -->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/parsley.css') !!}">

    <style>
        .md-content h3 {
            color: #97A1A8;
            background: none;
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .r-0 {
            right: 0;
        }

        .text-base {
            font-size: 1rem !important;
        }

        .z-50 {
            z-index: 50;
        }

        .mx-3 {
            margin: 0.75rem;
        }

        .h-38 {
            height: 2.4rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .form-radio {
            margin-bottom: 1rem;
        }

    </style>

@endpush
@section('admin_content')
    @include('admin.theme.sidebar.common')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">

                {!! Toastr::message() !!}

                <div class="page-wrapper">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <div class="d-inline">
                                        <h4>Hồ sơ cá nhân</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{!! route('dashboard') !!}">
                                                <i class="feather icon-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">Hồ sơ cá nhân</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cover-profile">
                                    <div class="profile-bg-img">
                                        <img class="profile-bg-img img-fluid" src="{!! asset('public/backend/assets/images/user-profile/bg-img1.jpg') !!}" alt="bg-img">
                                        <div class="card-block user-info">
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <a href="#" class="profile-image">
                                                        @if ($profile->avatar != null)
                                                            <img width="108px" height="108px" class="user-img img-radius"
                                                                src="{!! asset('public/uploads/avatar/' . $profile->avatar) !!}" alt="user-img">
                                                        @else
                                                            <img width="108px" height="108px" class="user-img img-radius"
                                                                src="{!! asset('public/backend/assets/images/question.png') !!}" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-body row">
                                                    <div class="col-lg-12">
                                                        <div class="user-title">
                                                            <h2>{{ $profile->user_name }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--profile cover end-->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- tab content start -->
                                <div class="tab-content">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">Bản thân</h5>
                                            <button id="edit-btn" type="button"
                                                class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                <i class="icofont icofont-edit"></i>
                                            </button>
                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table m-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>
                                                                                        Tên người dùng</th>
                                                                                    <td>{{ $profile->user_name }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Họ và tên</th>
                                                                                    <td>{{ $profile->full_name }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>
                                                                                        Giới tính</th>
                                                                                    <td>
                                                                                        @if ($profile->gender == 1)
                                                                                            Nam
                                                                                        @else
                                                                                            Nữ
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        Email</th>
                                                                                    <td>
                                                                                        {{ $profile->email }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        Số điện thoại
                                                                                    </th>
                                                                                    <td>{{ $profile->phone }}
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        Địa chỉ
                                                                                    </th>
                                                                                    <td>{{ $profile->address }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <form
                                                                action="{{ route('update_profile', ['id' => Auth::guard('admin')->user()->id]) }}"
                                                                method="POST" enctype="multipart/form-data"
                                                                id="validate_form">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                    padding: 6px 12px;
                                                                                                    border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-user"></i></label>
                                                                                                <input type="text"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="full_name"
                                                                                                    value="{{ $profile->full_name }}"
                                                                                                    placeholder="Họ và tên"
                                                                                                    required=""
                                                                                                    data-parsley-required-message="* Họ và tên không được để trống">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                    padding: 6px 12px;
                                                                                                    border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-ui-email"></i></label>
                                                                                                <input type="text"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="email"
                                                                                                    value="{{ $profile->email }}"
                                                                                                    placeholder="E-Mail"
                                                                                                    required=""
                                                                                                    data-parsley-required-message="* E-Mail không được để trống"
                                                                                                    data-parsley-pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                                                                    data-parsley-trigger="keyup"
                                                                                                    data-parsley-pattern-message="* E-Mail không đúng định dạng"
                                                                                                    autocomplete="off">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                    padding: 6px 12px;
                                                                                                    border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-location-pin"></i></label>
                                                                                                <input type="text"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="address"
                                                                                                    value="{{ $profile->address }}"
                                                                                                    placeholder="Địa chỉ"
                                                                                                    required=""
                                                                                                    data-parsley-required-message="* Địa chỉ không được để trống"
                                                                                                    autocomplete="off">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td
                                                                                        style="border-top: none; margin-bottom: 5px">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6"
                                                                                                style="justify-content: center">
                                                                                                <div>
                                                                                                    @if ($profile->avatar != null)
                                                                                                        <img width="108px"
                                                                                                            height="108px"
                                                                                                            class="user-img img-radius"
                                                                                                            src="{!! asset('public/uploads/avatar/' . $profile->avatar) !!}"
                                                                                                            alt="user-img">
                                                                                                    @else
                                                                                                        <img width="108px"
                                                                                                            height="108px"
                                                                                                            class="user-img img-radius"
                                                                                                            src="{!! asset('public/backend/assets/images/question.png') !!}"
                                                                                                            alt="">
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                    padding: 6px 12px;
                                                                                                    border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-user"></i></label>
                                                                                                <input type="text"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="user_name"
                                                                                                    value="{{ $profile->user_name }}"
                                                                                                    placeholder="Tên người dùng"
                                                                                                    required=""
                                                                                                    data-parsley-required-message="* Tên người dùng không được để trống">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                    padding: 6px 12px;
                                                                                                    border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-mobile-phone"></i></label>
                                                                                                <input type="text"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="phone"
                                                                                                    value="{{ $profile->phone }}"
                                                                                                    placeholder="Số điện thoại"
                                                                                                    required=""
                                                                                                    data-parsley-required-message="* Số điện thoại không được để trống"
                                                                                                    data-parsley-pattern="^[0-9\-\+]{9,15}$"
                                                                                                    data-parsley-trigger="keyup"
                                                                                                    data-parsley-pattern-message="* Số điện thoại không đúng định dạng"
                                                                                                    autocomplete="off">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <label
                                                                                                    style="position: absolute;
                                                                                                        padding: 10px 14px;
                                                                                                        border-right: 1px solid #ddd;"
                                                                                                    for=""><i
                                                                                                        class="icofont icofont-file-image"></i></label>

                                                                                                <input type="file"
                                                                                                    style="padding-left: 50px;"
                                                                                                    class="form-control"
                                                                                                    name="avatar"
                                                                                                    accept=".jpg,.jpeg,.png"
                                                                                                    placeholder="Ảnh đại diện">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-radio">
                                                                                                    <div
                                                                                                        class="group-add-on">
                                                                                                        <div
                                                                                                            class="radio radiofill radio-inline">
                                                                                                            <label>
                                                                                                                <input
                                                                                                                    type="radio"
                                                                                                                    name="gender"
                                                                                                                    value="1"
                                                                                                                    {{ $profile->gender == 1 ? 'checked' : '' }}><i
                                                                                                                    class="helper"></i>
                                                                                                                Nam
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="radio radiofill radio-inline">
                                                                                                            <label>
                                                                                                                <input
                                                                                                                    type="radio"
                                                                                                                    name="gender"
                                                                                                                    value="0"
                                                                                                                    {{ $profile->gender == 0 ? 'checked' : '' }}><i
                                                                                                                    class="helper"></i>
                                                                                                                Nữ
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="m-l-10">
                                                                    <button type="reset" id="edit-cancel"
                                                                        class="btn btn-grd-danger waves-effect m-r-20"><i
                                                                            class="icofont icofont-close-circled"></i></a>
                                                                        <button type="submit"
                                                                            class="btn btn-grd-primary waves-effect waves-light"><i
                                                                                class="icofont icofont-check"></i></a>
                                                                </div>
                                                            </form>

                                                            <form
                                                                action="{{ route('change_password', ['id' => $profile->id]) }}"
                                                                id="validate_form1" method="POST">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="border-top: none">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <input type="checkbox"
                                                                                                    name="mycheckbox"
                                                                                                    id="mycheckbox" /> Hiển
                                                                                                thị đổi mật khẩu
                                                                                                <div id="mycheckboxdiv"
                                                                                                    style="display:none; margin: 15px 0">
                                                                                                    <div
                                                                                                        class="row">
                                                                                                        <div
                                                                                                            class="col-lg-12">
                                                                                                            <label
                                                                                                                style="position: absolute;
                                                                                                                padding: 6px 12px;
                                                                                                                border-right: 1px solid #ddd;"
                                                                                                                for=""><i
                                                                                                                    class="icofont icofont-key"></i></label>
                                                                                                            <input
                                                                                                                type="password"
                                                                                                                style="padding-left: 50px; margin-bottom: 15px"
                                                                                                                id="password"
                                                                                                                class="form-control"
                                                                                                                placeholder="Mật khẩu"
                                                                                                                name="password"
                                                                                                                required=""
                                                                                                                data-parsley-required-message="* Mật khẩu không được để trống"
                                                                                                                data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                                                                                                data-parsley-trigger="keyup"
                                                                                                                data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                                                                                                autocomplete="off">
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="row">
                                                                                                        <div
                                                                                                            class="col-lg-12">
                                                                                                            <label
                                                                                                                style="position: absolute;
                                                                                                                padding: 6px 12px;
                                                                                                                border-right: 1px solid #ddd;"
                                                                                                                for=""><i
                                                                                                                    class="icofont icofont-key"></i></label>
                                                                                                            <input
                                                                                                                type="password"
                                                                                                                style="padding-left: 50px; margin-bottom: 15px"
                                                                                                                class="form-control"
                                                                                                                placeholder="Xác nhận mật khẩu"
                                                                                                                required=""
                                                                                                                data-parsley-required-message="* Xác nhận mật khẩu không được để trống"
                                                                                                                data-parsley-equalto="#password"
                                                                                                                data-parsley-trigger="keyup"
                                                                                                                data-parsley-equalto-message="* Mật khẩu và Mật khẩu xác nhận không giống nhau"
                                                                                                                data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                                                                                                data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                                                                                                autocomplete="off">
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div>
                                                                                                        <button type="reset"
                                                                                                            id="edit-cancel"
                                                                                                            class="btn btn-grd-danger waves-effect m-r-20"><i
                                                                                                                class="icofont icofont-close-circled"></i></a>
                                                                                                            <button
                                                                                                                type="submit"
                                                                                                                class="btn btn-grd-primary waves-effect waves-light"><i
                                                                                                                    class="icofont icofont-check"></i></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">

            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <!-- Required Jquery -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery/js/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-ui/js/jquery-ui.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/popper.js/js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') !!}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/modernizr/js/modernizr.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/modernizr/js/css-scrollbars.js') !!}"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/datedropper/js/datedropper.min.js') !!}"></script>
    <!-- data-table js -->
    <script src="{!! asset('public/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('public/backend/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('public/backend/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('public/backend/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') !!}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next/js/i18next.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') !!}">
    </script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') !!}">
    </script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-i18next/js/jquery-i18next.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/pages/user-profile.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/pcoded.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/vartical-layout.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/jquery.mCustomScrollbar.concat.min.js') !!}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/script.js') !!}"></script>
    <!-- My self-->
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/custom/custom.js') !!}"></script>
    <!-- Parsley.js -->
    <script src="{!! asset('public/backend/assets/js/parsley.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#validate_form').parsley();
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <script>
        $(document).ready(function() {
            $('#mycheckbox').change(function() {
                $('#mycheckboxdiv').toggle();
            });
        });
    </script>

@endpush
