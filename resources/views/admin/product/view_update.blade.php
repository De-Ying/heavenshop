@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Cập nhật sản phẩm')

@push('css')
      <!-- Tagsinput.css -->
      <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/bootstrap-tagsinput.css') !!}">

      <style>
          .bootstrap-tagsinput .tag{
              margin-left: 5px;
          }

          .bootstrap-tagsinput {
            padding: 12px 6px;
          }
      </style>
@endpush

@section('admin_content')
    @include('admin.theme.sidebar.product')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Sản phẩm</span>
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
                                    <a href="{{ route('product.view_all') }}">Liệt kê sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cập nhật sản phẩm
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
                                                <h4 class="card-title">CẬP NHẬT SẢN PHẨM</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-input-fields">
                                        <div class="row">
                                            <form id="product-form" action="{!! route('product.process_update', ['product_id' => $product->product_id]) !!}" method="post" class="row" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" class="form-control" name="product_id" value="{{ $product->product_id}}">

                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label for="product_name">Tên sản phẩm</label>
                                                        <input
                                                            name="product_name"
                                                            onkeyup="ChangeToSlug();"
                                                            id="slug" type="text"
                                                            rules="required"
                                                            class="form-control"
                                                            value="{{ $product->product_name }}"
                                                        >
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_slug" id="label_slug" class="">Slug</label>
                                                        <input
                                                            name="product_slug"
                                                            type="text"
                                                            id="convert_slug"
                                                            rules="required"
                                                            class="form-control"
                                                            value="{{ $product->product_slug }}"
                                                        >
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_quantity">Số lượng</label>
                                                        <input
                                                            name="product_quantity"
                                                            type="number"
                                                            min="1"
                                                            max="100"
                                                            rules="required"
                                                            class="form-control"
                                                            value="{{ $product->product_quantity }}"
                                                        >
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_cost_price">Giá gốc</label>
                                                        <input
                                                            name="product_cost_price"
                                                            type="text"
                                                            rules="required"
                                                            class="form-control price_format"
                                                            value="{{ $product->product_cost_price }}"
                                                        >
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_cost_price">Giá bán</label>
                                                        <input
                                                            name="product_price"
                                                            type="text"
                                                            rules="required"
                                                            class="form-control price_format"
                                                            value="{{ $product->product_price }}"
                                                        >
                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_content" class="fs-20 m-t-10 m-l-3">Nội dung sản phẩm</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="product_content"
                                                            id="my_editor"
                                                            placeholder="Nội dung sản phẩm"
                                                        >{{ $product->product_content }}</textarea>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="product_description" class="fs-20 m-t-10 m-l-3">Mô tả sản phẩm</label>
                                                        <textarea
                                                            style="resize: none"
                                                            rows="8"
                                                            class="form-control pname"
                                                            name="product_description"
                                                            id="ckeditor"
                                                            placeholder="Mô tả sản phẩm"
                                                        >{{ $product->product_description }}</textarea>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <div class="flex wrap flex-dr-c">
                                                            <label for="product_tags" class="fs-16 m-b-5">Tags sản phẩm</label>
                                                            <input type="text" data-role="tagsinput" name="product_tags"
                                                        class="form-control" value="{{ $product->product_tags }}">
                                                        </div>
                                                    </div>

                                                    <div class="file-field input-field col s12">
                                                        <div class="btn">
                                                            <span>Hình ảnh</span>
                                                            <input type="file" name="product_image" accept="image/*"
                                                                class="form-control pname">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="100" width="100" alt="{{ $product->product_name }}"/>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="product_cate">
                                                            @foreach ($categories as $category)
                                                                @if($category->category_id == $product->category_id)
                                                                    <option selected value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                                @else
                                                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="product_brand">
                                                            @foreach ($brands as $brand)
                                                                @if($brand->brand_id == $product->brand_id)
                                                                    <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                                                @else
                                                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                        <span class="input-message"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <select class="select2 browser-default form-control" name="product_supplier">
                                                            @foreach ($suppliers as $supplier)
                                                                @if($supplier->supplier_id == $product->supplier_id)
                                                                    <option selected value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                                                @else
                                                                    <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>

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
        Validator('#product-form', {
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
