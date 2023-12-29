@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thêm bài viết')

@section('admin_content')
    @include('admin.theme.sidebar.posts')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Bài viết</span>
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
                                    <a href="{{ route('category-post.view_category_post') }}">Liệt kê bài viết</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thêm bài viết
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
                                                <h4 class="card-title">THÊM BÀI VIẾT</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="post-form" action="{!! route('posts.process_insert_post') !!}" method="post" class="row" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="post_title">Tên bài viết</label>
                                                        <input  name="post_title" onkeyup="ChangeToSlug();" id="slug" type="text"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="post_slug" id="label_slug" class="">Slug</label>
                                                        <input  name="post_slug" type="text" id="convert_slug"
                                                            rules="required" class="form-control">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="post_content" class="fs-20 m-t-10 m-l-3">Nội dung bài viết</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="post_content"
                                                            id="my_editor"
                                                            placeholder="Nội dung bài viết"
                                                        ></textarea>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="post_content" class="fs-20 m-t-10 m-l-3">Mô tả bài viết</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="post_content"
                                                            id="ckeditor"
                                                            placeholder="Mô tả bài viết"
                                                        ></textarea>
                                                    </div>

                                                    <div class="file-field input-field col s12">
                                                        <div class="btn">
                                                            <span>Hình ảnh</span>
                                                            <input type="file" name="post_image" accept="image/*"
                                                                rules="required" class="form-control pname">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="category_post_id">
                                                            <option value="">Hãy chọn danh mục bài viết</option>
                                                            @foreach ($category_post as $cate_post)
                                                                <option value="{{ $cate_post->category_post_id }}">{{ $cate_post->category_post_name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <span class="input-message"></span>
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
        Validator('#post-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

    <!-- CKEDITOR -->
    <script type="text/javascript" src="{!! asset('public/backend/ckeditor/ckeditor.js') !!}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            filebrowserImageUploadUrl: "{{ url('admin/product/uploads-ckeditor?_token=' . csrf_token()) }}",
            filebrowserBrowseUrl: "{{ url('admin/product/file-browser?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
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
        CKEDITOR.replace('my_editor', options);
    </script>

@endpush
