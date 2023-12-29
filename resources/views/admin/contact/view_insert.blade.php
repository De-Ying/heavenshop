@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thêm thông tin liên hệ')

@section('admin_content')
    @include('admin.theme.sidebar.contact')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Liện hệ</span>
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
                                    <a href="{{ route('category.view_all') }}">Liệt kê thông tin liên hệ</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thêm thông tin liên hệ
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
                                                <h4 class="card-title">THÊM THÔNG TIN LIÊN HỆ</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="contact-form" action="{!! route('contact.process_insert') !!}" method="post" class="row">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="contact_address">Địa chỉ</label>
                                                        <input name="contact_address" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="contact_phone">Số điện thoại</label>
                                                        <input name="contact_phone" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="contact_email">E-Mail</label>
                                                        <input name="contact_email" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="contact_url_fanpage">Đường dẫn Fanpage</label>
                                                        <input name="contact_url_fanpage" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="contact_map" class="fs-20 m-t-10 m-l-3">Map</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="contact_map"
                                                            id="ckeditor"
                                                            placeholder="Map"
                                                        ></textarea>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="contact_fanpage" class="fs-20 m-t-10 m-l-3">Fanpage</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="contact_fanpage"
                                                            id="my-editor"
                                                            placeholder="Fanpage"
                                                        ></textarea>
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
        Validator('#contact-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

    <!-- CKeditor -->
    <script type="text/javascript" src="{!! asset('public/backend/ckeditor/ckeditor.js') !!}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            filebrowserImageUploadUrl : "{{ url('admin/product/uploads-ckeditor?_token='.csrf_token()) }}",
            filebrowserBrowseUrl      : "{{ url('admin/product/file-browser?_token='.csrf_token()) }}",
            filebrowserUploadMethod   : 'form'
        });
    </script>

    <!-- File Manager -->
    <script>
    var options = {
        filebrowserImageBrowseUrl: "{{ url('admin/laravel-filemanager?type=Images') }}",
        filebrowserImageUploadUrl: "{{ url('admin/laravel-filemanager/upload?type=Images&_token=') }}",
        filebrowserBrowseUrl: "{{ url('admin/laravel-filemanager?type=Files') }}",
        filebrowserUploadUrl: "{{ url('admin/laravel-filemanager/upload?type=Files&_token=') }}",
    };
    </script>

    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
@endpush
