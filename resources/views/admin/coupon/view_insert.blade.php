@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thêm mã giảm giá')

@section('admin_content')
    @include('admin.theme.sidebar.coupon')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Mã Giảm Giá</span>
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
                                    <a href="{{ route('category.view_all') }}">Mã Giảm Giá</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thêm mã giảm giá
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
                                                <h4 class="card-title">THÊM MÃ GIẢM GIÁ</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="coupon-form" action="{!! route('coupon.process_insert') !!}" method="post" class="row">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="coupon_name">Tên mã giảm giá</label>
                                                        <input  name="coupon_name" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="coupon_start_date">Ngày bắt đầu</label>
                                                        <input type="text" name="coupon_start_date" id="coupon_start_date" class="form-control datepicker">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="coupon_end_date">Ngày kết thúc</label>
                                                        <input type="text" name="coupon_end_date" id="coupon_end_date" class="form-control datepicker">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="coupon_code">Mã giảm giá</label>
                                                        <input type="text" name="coupon_code" rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="coupon_time">Số lượng mã</label>
                                                        <input type="number" min="1" max="100" name="coupon_time" rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="coupon_number">Nhập số phần trăm/tiền giảm</label>
                                                        <input type="number" min="1" name="coupon_number" rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="coupon_condition">
                                                            <option value="">Chọn % giảm</option>
                                                            <option value="1">Giảm theo phần trăm</option>
                                                            <option value="2">Giảm theo tiền</option>
                                                        </select>
                                                    </div>


                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right m-l-5" type="submit">
                                                            Thêm
                                                            <span class="material-icons right m-l-10">
                                                               <i class="fa fa-send-o"></i>
                                                            </span>
                                                        </button>

                                                        <button class="btn waves-effect waves-light right bg-danger" type="reset">
                                                            Hủy
                                                            <span class="material-icons right m-l-10">
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
        Validator('#coupon-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

@endpush
