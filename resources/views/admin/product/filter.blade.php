@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Lọc sản phẩm')

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
                                <li class="breadcrumb-item active">
                                    Lọc sản phẩm
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="users-list-filter section">
                        <div class="card-panel">
                            <div class="row">
                                <form action="{{ route('product.filter') }}" method="POST">
                                    @csrf
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-verified">Danh mục</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control" name="filterCate">
                                                <option selected disabled>Hãy chọn danh mục</option>
                                                @foreach ($categories as $category)
                                                    @if ($category->category_parent == 0)
                                                        <option value="{{ $category->category_id }}" disabled
                                                            style="color: blue">[
                                                            {{ $category->category_name }} ]</option>
                                                    @endif

                                                    @foreach ($categories as $category2)
                                                        @if ($category2->category_parent == $category->category_id)
                                                            <option
                                                                {{ $category2->category_id == $filterCate ? 'selected' : '' }}
                                                                value="{{ $category2->category_id }}">
                                                                {{ $category2->category_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-role">Thương hiệu</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control" name="filterBrand">
                                                <option selected disabled>Hãy chọn thương hiệu</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->brand_id }}"
                                                        {{ $brand->brand_id == $filterBrand ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Trạng thái</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control" name="filterStatus">
                                                <option value="1" {{ $filterStatus == 1 ? 'selected' : '' }}>Hiện</option>
                                                <option value="0" {{ $filterStatus == 0 ? 'selected' : '' }}>Ẩn</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 display-flex align-items-center show-btn m-t-50">
                                        <button type="submit"
                                            class="btn btn-block indigo waves-effect waves-light">Lọc</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h4 class="card-title m-b-20">
                                            <a href="{{ route('product.view_insert') }}"
                                                class="form-control btn btn-mat btn-info m-l-5"><i
                                                    class="fa fa-plus-square"></i> Thêm</a>

                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ảnh sản phẩm</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Thư viện ảnh</th>
                                                            <th>Đánh giá</th>
                                                            <th>Số lượng xem</th>
                                                            <th>Hiển thị</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($products as $product)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-list-img">
                                                                    <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                                        height="100" width="100"
                                                                        alt="{{ $product->product_name }}" />
                                                                </td>
                                                                <td class="pro-name">
                                                                    <a href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}"
                                                                        target="_blank"
                                                                        class="text-current">{{ $product->product_name }}</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('gallery', ['product_id' => $product->product_id]) }}"
                                                                        class="block text-center">
                                                                        <i class="text-darkslategray fa fa-image fs-25"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('gallery', ['product_id' => $product->product_id]) }}"
                                                                        class="block text-center">
                                                                        <i
                                                                            class="text-darkslategray fa fa-comment-o fs-25"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="block text-center">{{ $product->product_view }}</span>
                                                                </td>
                                                                <td>
                                                                    <?php if ($product->product_status == 1) { ?>
                                                                    <a href="{{ route('product.unactive_product', ['product_id' => $product->product_id]) }}"
                                                                        class="green-text">
                                                                        <span class="chip green lighten-5">
                                                                            Hiện
                                                                        </span>
                                                                    </a>

                                                                    <?php } else { ?>
                                                                    <a href="{{ route('product.active_product', ['product_id' => $product->product_id]) }}"
                                                                        class="orange-text">
                                                                        <span class="chip orange lighten-5">
                                                                            Ẩn
                                                                        </span>
                                                                    </a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="action-icon">
                                                                    <button type="button"
                                                                        class="m-r-5 btn btn-grd-info btn-sm modal-trigger"
                                                                        href="#modal_{{ $product->product_id }}"><i
                                                                            class="fa fa-eye"
                                                                            aria-hidden="true"></i></button>
                                                                    @if ($product->product_status == 1)
                                                                        <a href="{!! route('product.view_update', ['product_id' => $product->product_id]) !!}"
                                                                            class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                                class="fa fa-edit fa-fw"></i></a>
                                                                    @endif
                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deleteProduct({{ $product->product_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>

                                                            <div id="modal_{{ $product->product_id }}"
                                                                class="modal modal-fixed-footer">
                                                                <div class="modal-content">
                                                                    <h5>{{ $product->product_name }}</h5>

                                                                    <div class="row">
                                                                        <div class="m-4 col s5 m-t-5">
                                                                            <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                                            alt="{{ $product->product_name }}" class="modal-img"/>
                                                                        </div>
                                                                        <div class="m-8 col s7 m-t-5">
                                                                            <ul>
                                                                                <li style="list-style-type: disclosure-closed;">Danh mục: - {{ $product->category->category_name }}</li>
                                                                                <li style="list-style-type: disclosure-closed;">Thương hiệu: - {{ $product->brand->brand_name }}</li>
                                                                                <li style="list-style-type: disclosure-closed;">Nhà cung cấp: - {{ $product->supplier->supplier_name }}</li>
                                                                            </ul>

                                                                            <hr>
                                                                            <p>{!! $product->product_description !!}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#!"
                                                                        class="modal-action modal-close waves-effect waves-red btn-flat btn-grd-danger">Đóng</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ảnh sản phẩm</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Thư viện ảnh</th>
                                                            <th>Đánh giá</th>
                                                            <th>Số lượng xem</th>
                                                            <th>Hiển thị</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
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

                    <!-- users list ends -->
                </div>
                <div class="content-overlay"></div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript" src="{!! asset('public/backend/app-assets/js/jquery.min.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#page-length-option').DataTable({
                "processing": true,
                "oLanguage": {
                    "sSearch": '<span class="fs-14">Tỉm kiếm: </span> ',
                    "sZeroRecords": "Không có dữ liệu nào trong bảng",
                    "sLengthMenu": '<span class="fs-14">Hiển thị</span> <select style="display: none">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Tất cả</option>' +
                        '</select> <span class="fs-14">bản ghi</span>',
                    "sInfo": "Hiển thị _START_ đến _END_ trong tổng số bản ghi là _TOTAL_",
                    "sProcessing": 'Loading <i class="fa fa-spinner" style="transition: 2s;"></i>',
                    "oPaginate": {
                        "sNext": "Trang sau",
                        "sPrevious": "Trang trước",
                    }
                },
            });
        });
    </script>

    <!-- Xóa sản phẩm -->
    <script>
        function deleteProduct(product_id) {
            var _token = $('input[name="_token"]').val();

            swal({
                title: "Bạn có chắc xóa không?",
                text: "Bạn sẽ không thể khôi phục lại tệp này!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('product.delete') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    },
                });
            });
        }
    </script>
@endpush
