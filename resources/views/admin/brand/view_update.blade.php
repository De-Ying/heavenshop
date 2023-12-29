@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật thương hiệu')

@section('admin_content')
    @include('admin.theme.sidebar.brand')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Danh mục</span>
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
                                    <a href="{{ route('supplier.view_all') }}">Liệt kê thương hiệu</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cập nhật thương hiệu
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
                                                <h4 class="card-title">CẬP NHẬT THƯƠNG HIỆU</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="brand-form" action="{!! route('brand.process_update', ['brand_id' => $brand->brand_id]) !!}" method="post" class="row">
                                                @csrf

                                                <div class="col s12">
                                                    <input type="hidden" class="form-control"
                                                    name="brand_id" value="{{ $brand->brand_id }}">


                                                    <div class="input-field col s12">
                                                        <label for="brand_name">Tên thương hiệu</label>
                                                        <input  name="brand_name" onkeyup="ChangeToSlug();" id="slug" type="text"
                                                            rules="required" class="form-control" value="{{ $brand->brand_name }}">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="brand_slug" id="label_slug" class="">Slug</label>
                                                        <input  name="brand_slug" type="text" id="convert_slug"
                                                            rules="required" class="form-control" value="{{ $brand->brand_slug }}">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right m-l-5" type="submit">
                                                            Cập nhật
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
        Validator('#brand-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

@endpush
