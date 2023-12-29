@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật bài viết')

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
                                    <a href="{{ route('category.view_all') }}">Liệt kê bài viết</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cập nhật bài viết
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
                                                <h4 class="card-title">CẬP NHẬT BÀI VIẾT</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="post-form" action="{!! route('posts.process_update_post', ['post_id' => $posts->post_id]) !!}" method="post" class="row" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col s12">
                                                    <input type="hidden" class="form-control"
                                                    name="post_id" value="{{ $posts->post_id }}">

                                                    <div class="input-field col s12">
                                                        <label for="post_title">Tên bài viết</label>
                                                        <input  name="post_title" onkeyup="ChangeToSlug();" id="slug" type="text"
                                                            rules="required" class="form-control" value="{{ $posts->post_title }}">
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="post_slug" id="label_slug" class="">Slug</label>
                                                        <input  name="post_slug" type="text" id="convert_slug"
                                                            rules="required" class="form-control" value="{{ $posts->post_slug }}">
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
                                                        >{{ $posts->post_content }}</textarea>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="post_description" class="fs-20 m-t-10 m-l-3">Mô tả bài viết</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="post_description"
                                                            id="ckeditor"
                                                            placeholder="Mô tả bài viết"
                                                        >{{ $posts->post_description }}</textarea>
                                                    </div>

                                                    <div class="file-field input-field col s12">
                                                        <div class="btn">
                                                            <span>Hình ảnh</span>
                                                            <input type="file" name="post_image" accept="image/*"
                                                                class="form-control pname">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <img src="{{URL::to('public/uploads/blog/'.$posts->post_image)}}" height="150" width="250" alt="{{ $posts->post_title }}"/>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="category_post_id">
                                                            @foreach ($category_post as $cate_post)
                                                                @if($cate_post->category_post_id == $posts->category_post_id)
                                                                    <option selected value="{{ $cate_post->category_post_id }}">{{ $cate_post->category_post_name }}</option>
                                                                @else
                                                                    <option value="{{ $cate_post->category_post_id }}">{{ $cate_post->category_post_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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

                    <!-- Date Picker -->
                    {{-- <div class="row">
                        <div class="col s12">
                            <div id="date-picker" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <h4 class="card-title">Date Picker</h4>
                                            </div>
                                            <div class="col s12 m6 l6">
                                                <ul class="tabs">
                                                    <li class="p-0 tab col s4"><a class="p-0 active"
                                                            href="#view-date-picker">View</a></li>
                                                    <li class="p-0 tab col s4"><a class="p-0"
                                                            href="#html-date-picker">Html</a></li>
                                                    <li class="p-0 tab col s4"><a class="p-0"
                                                            href="#js-date-picker">JS</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-date-picker">
                                        <p>We use a modified version of pickadate.js to create a materialized date picker.
                                            Test it out below! </p>
                                        <label for="birthdate">Birthdate</label>
                                        <input type="text" class="datepicker" id="birthdate">
                                    </div>
                                    <div id="html-date-picker">
                                        <pre><code class="language-markup">
        &lt;input type="text" class="datepicker">
        </code></pre>
                                    </div>
                                    <div id="js-date-picker">
                                        <pre><code class="language-javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.datepicker');
          var instances = M.Datepicker.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function(){
          $('.datepicker').datepicker();
        });

        </code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Character counter -->

                    {{-- <div class="row">
                        <div class="col s12">
                            <div id="autoComplete2" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <h4>Character Counter</h4>
                                            </div>
                                            <div class="col s12 m6 l6">
                                                <ul class="tabs">
                                                    <li class="p-0 tab col s4">
                                                        <a href="#view-counter" class="p-0 active">View</a>
                                                    </li>
                                                    <li class="p-0 tab col s4">
                                                        <a href="#view-counter-html" class="p-0">HTML</a>
                                                    </li>
                                                    <li class="p-0 tab col s4">
                                                        <a href="#view-counter-js" class="p=0">JS</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-counter">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="row">
                                                    <form class="col s12">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input id="input_text" type="text" data-length="10">
                                                                <label for="input_text">Input text</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <textarea id="textarea1" class="materialize-textarea"
                                                                    data-length="120"></textarea>
                                                                <label for="textarea1">Textarea</label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-counter-html">
                                        <pre class="language-markup">
        <code class="language-markup">
      &lt;div class=&quot;row&quot;&gt;
      &lt;form class=&quot;col s12&quot;&gt;
        &lt;div class=&quot;row&quot;&gt;
          &lt;div class=&quot;input-field col s6&quot;&gt;
            &lt;input id=&quot;input_text&quot; type=&quot;text&quot; data-length=&quot;10&quot;&gt;
            &lt;label for=&quot;input_text&quot;&gt;Input text&lt;/label&gt;
          &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;row&quot;&gt;
          &lt;div class=&quot;input-field col s12&quot;&gt;
            &lt;textarea id=&quot;textarea1&quot; class=&quot;materialize-textarea&quot; data-length=&quot;120&quot;&gt;&lt;/textarea&gt;
            &lt;label for=&quot;textarea1&quot;&gt;Textarea&lt;/label&gt;
          &lt;/div&gt;
        &lt;/div&gt;
      &lt;/form&gt;
      &lt;/div&gt;
        </code>
      </pre>
                                    </div>
                                    <div id="view-counter-js">
                                        <pre class="language-javascript">
        <code class="language-javascript">
          $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
          });
        </code>
      </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

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
        Validator('#category-form', {
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
