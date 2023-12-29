@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thêm người dùng')
<style>
    .select2-container--default
    .select2-selection--multiple
    .select2-selection__choice {
        background-color: black !important;
        margin-top: 8px;
    }

    .select2-container--default
    .select2-selection--multiple
    .select2-selection__choice__remove:hover {
        color: red !important;
    }

    .select2 {
        margin-top: 10px !important;
    }
</style>


@section('admin_content')
    @include('admin.theme.sidebar.user.list')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Người dùng</span>
                            </h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="mb-0 breadcrumbs">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard') !!}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{!! route('users.view_all') !!}">
                                        Danh sách người dùng
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thêm người dùng
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section users-edit">
                        <div class="card">
                            <div class="card-content">
                               <div class="card-body">
                                    <ul class="mb-2 tabs row">
                                        <li class="tab">
                                            <a class="display-flex align-items-center active" id="account-tab" href="#account">
                                                <i class="fa fa-user fs-16" aria-hidden="true"></i>
                                                Tài khoản
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab" href="#information">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                Thông tin
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="mb-3 divider"></div>

                                    <div class="row">
                                        <form id="users-form" action="{!! route('users.process_insert') !!}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="col s12" id="account">
                                                <div class="row">
                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col s12 input-field">
                                                                <label for="user_name">Tên tài khoản</label>
                                                                <input
                                                                    id="user_name"
                                                                    name="user_name"
                                                                    type="text"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="col s12 input-field">
                                                                <label for="password">Mật khẩu</label>
                                                                <input
                                                                    id="password"
                                                                    name="password"
                                                                    type="password"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="col s12 input-field">
                                                                <label for="email">E-Mail</label>
                                                                <input
                                                                    id="email"
                                                                    name="email"
                                                                    type="text"
                                                                    class="form-control"
                                                                    rules="required|email"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col s12 input-field">
                                                                <label for="full_name">Họ và tên</label>
                                                                <input
                                                                    id="full_name"
                                                                    name="full_name"
                                                                    type="text"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="col s12 input-field">
                                                                <label for="password_confirmation">Xác nhận mật khẩu</label>
                                                                <input
                                                                    id="password_confirmation"
                                                                    type="password"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="col s12 input-field">
                                                                <span>Phân vai trò</span>

                                                                <select class="select2 browser-default form-control" multiple name="roles[]">
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s12" id="information">
                                                <div class="row">
                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col s12 input-field">
                                                                <label for="address">Địa chỉ</label>
                                                                <input
                                                                    id="address"
                                                                    name="address"
                                                                    type="text"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="file-field input-field col s12">
                                                                <div class="btn">
                                                                    <span>Hình ảnh</span>
                                                                    <input type="file" name="avatar" accept=".jpg,.jpeg,.png"
                                                                        class="form-control pname">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col s12 input-field">
                                                                <label for="phone">Số điện thoại</label>
                                                                <input
                                                                    id="phone"
                                                                    name="phone"
                                                                    type="text"
                                                                    class="form-control"
                                                                    rules="required"
                                                                />
                                                                <span class="input-message"></span>
                                                            </div>

                                                            <div class="col s12 input-field">
                                                                <span>Giới tính</span>
                                                                <div class="m-t-10">
                                                                    <label>
                                                                        <input name="gender" type="radio" value="1">
                                                                        <span>Nam</span>
                                                                    </label>
                                                                    <label>
                                                                        <input name="gender" type="radio" value="0">
                                                                        <span>Nữ</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 col s12 display-flex justify-content-end">
                                                        <button type="submit" class="btn indigo">
                                                            Lưu
                                                        </button>
                                                        <button type="reset" class="btn btn-light">
                                                            Hủy
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- START RIGHT SIDEBAR NAV -->
                   {{-- @include('admin.theme.rightsidebar') --}}
                    <!-- END RIGHT SIDEBAR NAV -->
                    {{-- <div style="bottom: 50px; right: 19px" class="fixed-action-btn direction-top">
                        <a class=" btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                                class="material-icons">add</i></a>
                        <ul>
                            <li>
                                <a href="css-helpers.html" class="btn-floating blue"><i
                                        class="material-icons">help_outline</i></a>
                            </li>
                            <li>
                                <a href="cards-extended.html" class="btn-floating green"><i
                                        class="material-icons">widgets</i></a>
                            </li>
                            <li>
                                <a href="app-calendar.html" class="btn-floating amber"><i
                                        class="material-icons">today</i></a>
                            </li>
                            <li>
                                <a href="app-email.html" class="btn-floating red"><i
                                        class="material-icons">mail_outline</i></a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="content-overlay"></div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- VALIDATE -->
    <script src="{!! asset('public/backend/app-assets/js/validator.js') !!}"></script>

    <script>
        Validator('#users-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>
@endpush
