@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Danh sách khách hàng')

@section('admin_content')
    @include('admin.theme.sidebar.customer')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Khách hàng</span>
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
                                    Danh sách khách hàng
                                </li>
                                <li class="breadcrumb-item active">
                                    Thông tin khách hàng
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section users-view">
                        <div class="card-panel">
                            <div class="row">
                                <div class="col s12 m7">
                                    <div class="display-flex media">
                                        <a href="#" class="avatar m-r-20">
                                            <img src="{{URL::to('public/uploads/customer/'.$customer->customer_image)}}" height="64" width="64" alt="{{ $customer->customer_name }}"/>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <span class="users-view-name">{{ $customer->customer_name }}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{ $customer->customer_id }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="pt-2 col s12 m5 quick-action-btns display-flex justify-content-end align-items-center">
                                    <a href="app-email.html" class="btn-small btn-light-indigo"><i
                                            class="material-icons">mail_outline</i></a>
                                    <a href="user-profile-page.html" class="btn-small btn-light-indigo">Profile</a>
                                    <a href="page-users-edit.html" class="btn-small indigo">Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <h6 class="mt-2 mb-2"><i class="fa fa-info-circle"></i> Thông tin cá nhân
                                        </h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>Họ tên:</td>
                                                    <td class="users-view-name">{{ $customer->customer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>E-mail:</td>
                                                    <td class="users-view-email">{{ $customer->customer_email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ:</td>
                                                    <td>{{ $customer->customer_address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại:</td>
                                                    <td>{{ $customer->customer_phone }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h6 class="mt-2 mb-2"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Thông tin mở rộng
                                        </h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>VIP:</td>
                                                    <td class="users-view-name">
                                                        @if ($customer->customer_vip == 1)
                                                            <span>Có</span>
                                                        @else
                                                            <span>Không</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>LOG IN:</td>
                                                    <td class="users-view-name">
                                                        @if ($customer->customer_social == 1)
                                                            <span>Mạng xã hội</span>
                                                        @else
                                                            <span>Tài khoản website</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Trạng thái:</td>
                                                    <td class="users-view-name">
                                                        @if ($customer->customer_status == 1)
                                                            <span class="users-view-status chip green lighten-5 green-text">Hoạt động</span>
                                                        @else
                                                            <span class="users-view-status chip red lighten-5 red-text">Bị khóa</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
