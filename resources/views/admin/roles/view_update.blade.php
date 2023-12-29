@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật vai trò')

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
    @include('admin.theme.sidebar.user.roles')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Vai trò</span>
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
                                    <a href="{{ route('roles.view_all') }}"> Danh sách vai trò người dùng</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thêm vai trò người dùng
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div id="input-fields" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col s12 m6 l12">
                                                <h4 class="card-title">CẬP NHẬT VAI TRÒ NGƯỜI DÙNG</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="roles-form" action="{!! route('roles.process_update', ['id' => $role->id]) !!}" method="post" class="row">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="name">Định danh</label>
                                                        <input name="name" type="text"
                                                            rules="required" class="form-control" value="{{ $role->name }}">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="display_name">Tên vai trò</label>
                                                        <input name="display_name" type="text"
                                                            rules="required" class="form-control" value="{{ $role->display_name }}">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right m-l-5" type="submit">
                                                            Cập nhật
                                                            <span class="material-icons right m-l-10 p-tb-9">
                                                               <i class="fa fa-send-o"></i>
                                                            </span>
                                                        </button>

                                                        <button class="btn waves-effect waves-light right bg-danger" type="reset">
                                                            Hủy
                                                            <span class="material-icons right m-l-10 p-tb-9">
                                                                <i class="fa fa-times"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- START RIGHT SIDEBAR NAV -->
                    {{-- @include('admin.theme.rightsidebar') --}}
                    <!-- END RIGHT SIDEBAR NAV -->

                    {{-- @include('admin.theme.bottomsidebar') --}}

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
        Validator('#roles-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

@endpush
