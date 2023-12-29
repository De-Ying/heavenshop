@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật nhà cung cấp')

@section('admin_content')
    @include('admin.theme.sidebar.supplier')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Nhà cung cấp</span>
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
                                    <a href="{{ route('supplier.view_all') }}">Liệt kê nhà cung cấp</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cập nhật nhà cung cấp
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col s12">
                            <div id="input-fields" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col s12 m6 l12">
                                                <h4 class="card-title">CẬP NHẬT NHÀ CUNG CẤP</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="supplier-form" action="{!! route('supplier.process_update', ['supplier_id' => $supplier->supplier_id]) !!}" method="post" class="row" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="supplier_name">Tên Nhà Cung Cấp</label>
                                                        <input id="supplier_name" name="supplier_name" type="text"
                                                            rules="required" class="form-control" value="{{ $supplier->supplier_name }}">
                                                        <span class="input-message"></span>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="supplier_phone">Số điện thoại</label>
                                                        <input id="supplier_phone" name="supplier_phone" type="text"
                                                            rules="required" class="form-control" value="{{ $supplier->supplier_phone }}">
                                                        <span class="input-message"></span>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="supplier_address">Địa chỉ</label>
                                                        <input id="supplier_address" name="supplier_address" type="text"
                                                            rules="required" class="form-control" value="{{ $supplier->supplier_address }}">
                                                        <span class="input-message"></span>
                                                    </div>
                                                    <div class="input-field col s12">
                                                        <label for="supplier_email">E-Mail</label>
                                                        <input id="supplier_email" name="supplier_email" type="email"
                                                            rules="required|email" class="form-control" value="{{ $supplier->supplier_email }}">
                                                        <span class="input-message"></span>
                                                    </div>
                                                    <div class="file-field input-field col s12">
                                                        <div class="btn">
                                                            <span>Hình ảnh</span>
                                                            <input type="file" name="supplier_image" id="supplier_image" accept="image/*"
                                                                 class="form-control">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <img src="{{URL::to('public/uploads/supplier/'.$supplier->supplier_image)}}" height="100" width="100" alt="{{ $supplier->supplier_name }}"/>
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
        Validator('#supplier-form', {
            onSubmit: function(data) {
                console.log(data);
            }
        });
    </script>

@endpush
