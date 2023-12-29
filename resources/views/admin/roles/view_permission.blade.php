@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật mã giảm giá')
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
                                    <a href="{{ route('category.view_all') }}">Danh sách người dùng</a>
                                </li>
                                <li class="breadcrumb-item active">
                                   Phân quyền
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
                                                <h4 class="card-title">PHÂN QUYỀN</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="permissions-form" action="{!! route('roles.process_permission', ['id' => $role->id]) !!}" method="post" class="row">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <span for="display_name">Quyền</span>

                                                        <select class="select2 browser-default form-control m-t-5" multiple name="permissions[]">
                                                            @foreach ($permissions as $permission)
                                                                <option
                                                                        {{ $getAllPermissionOfRole->contains($permission->id) ? 'selected' : '' }}
                                                                        value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right m-l-5" type="submit">
                                                            Cấp quyền
                                                            <span class="material-icons right m-l-10" style="line-height: 2.4rem">
                                                               <i class="fa fa-send-o"></i>
                                                            </span>
                                                        </button>

                                                        <button class="btn waves-effect waves-light right bg-danger" type="reset">
                                                            Hủy
                                                            <span class="material-icons right m-l-10" style="line-height: 2.4rem">
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

    <!-- Datapicker -->
    <script src="{!! asset('public/backend/assets/js/jquery-ui.js') !!}"></script>

    <!-- VALIDATE -->
    <script src="{!! asset('public/backend/app-assets/js/validator.js') !!}"></script>

    <script>
        Validator('#permissions-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>
@endpush
