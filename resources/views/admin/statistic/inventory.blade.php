@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thống kê doanh số')

@push('css')
    <style>
        .select2-container--default .select2-selection--single {
            border-bottom: 1px solid #aaa;
            border-top: unset;
            border-left: unset;
            border-right: unset;
        }

    </style>

@endpush

@section('admin_content')
    @include('admin.theme.sidebar.statistic.inventory')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Thống kê</span>
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
                                    Giá trị tồn kho
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
                            <form action="{{ route('statistic.inventory.pdf-inventory') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l4">
                                        <label for="users-list-verified">Danh mục</label>
                                        <select class="select2 browser-default form-control m-l-20 category_id" name="category_id" id="category_id"
                                            style="width: 60%;" readonly>
                                            <option selected disabled>--- Chọn danh mục ---</option>
                                            @foreach ($categories as $category)
                                                @if ($category->category_parent == 0)
                                                    <option value="{{ $category->category_id }}" disabled style="color: blue">
                                                        [
                                                        {{ $category->category_name }} ]</option>
                                                @endif

                                                @foreach ($categories as $category2)
                                                    @if ($category2->category_parent == $category->category_id)
                                                        <option
                                                            {{ $category2->category_id == $category->category_id ? 'selected' : '' }}
                                                            value="{{ $category2->category_id }}">
                                                            {{ $category2->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Thương hiệu</label>
                                        <select class="select2 browser-default form-control m-l-20 brand_id" name="brand_id" id="brand_id"
                                            style="width: 60%;" readonly>
                                            <option selected disabled>--- Chọn thương hiệu ---</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand_id }}">
                                                    {{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Nhà cung cấp</label>
                                        <select class="select2 browser-default form-control m-l-20 supplier_id" name="supplier_id" id="supplier_id"
                                            style="width: 60%;" readonly>
                                            <option selected disabled>--- Chọn nhà cung cấp ---</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->supplier_id }}">
                                                    {{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-50">
                                        <button type="button" name="inventory-filter" id="inventory-filter"
                                            class="btn btn-grd-inverse indigo waves-effect waves-light">
                                            <i class="fa fa-filter"></i>
                                            Lọc</button>
                                    </div>

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-50">
                                        <button type="button" class="btn btn-grd-info btn-sm m-r-5" name="refresh" id="refresh"><i class="fa fa-refresh"></i></button>
                                    </div>

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-50">
                                        <button type="submit" class="btn btn-grd-info btn-sm m-r-5" name="inventory-pdf" id="inventory-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>Ảnh</th>
                                                            <th>Tên</th>
                                                            <th>SL tồn</th>
                                                            <th>SL đã bán</th>
                                                            <th>Giá mua vào</th>
                                                            <th>Giá bán ra</th>
                                                            <th>Giá trị</th>
                                                            <th>Tổng giá bán SP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Ảnh</th>
                                                            <th>Tên</th>
                                                            <th>SL tồn</th>
                                                            <th>SL đã bán</th>
                                                            <th>Giá mua vào</th>
                                                            <th>Giá bán ra</th>
                                                            <th>Giá trị</th>
                                                            <th>Tổng giá bán SP</th>
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

    <script type="text/javascript">
        $(document).ready(function() {
            fill_datatable();

            function fill_datatable(category_id = '', brand_id = '', supplier_id = '') {
                $('#page-length-option').DataTable({
                    "processing": true,
                    "serverSide": true,
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
                        "sProcessing": 'Loading <i class="fa fa-spinner" style="transition: 5s;"></i>',
                        "oPaginate": {
                            "sNext": "Trang sau",
                            "sPrevious": "Trang trước",
                        }
                    },
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                            },
                            text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                            },
                            text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                            },
                            text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print',
                        }
                    ],
                    ajax: {
                        url: "{{ route('statistic.inventory.inventory') }}",
                        data: {
                            category_id: category_id,
                            brand_id: brand_id,
                            supplier_id: supplier_id
                        }
                    },
                    columns: [
                        {
                            data: 'product_image',
                            render: function(data) {
                                var img = 'http://yumishop.com/public/uploads/product/' + data;
                                return '<img src="' + img +
                                    '" alt="error" style="width:60px; height:60px">';
                            }
                        },
                        {
                            data: 'product_name',
                        },
                        {
                            data: 'product_quantity',
                        },
                        {
                            data: 'product_sold',
                        },
                        {
                            data: 'product_cost_price',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                        {
                            data: 'product_price',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                        {
                            data: 'totalCostPrice',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                        {
                            data: 'totalPrice',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                    ]
                });
            }

            $('#inventory-filter').click(function() {
                var category_id = $('.category_id').val();
                var brand_id = $('.brand_id').val();
                var supplier_id =  $('.supplier_id').val();

                if (category_id != '' && brand_id != '' && supplier_id != '') {
                    $('#page-length-option').DataTable().destroy();
                    fill_datatable(category_id, brand_id, supplier_id);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('.category_id').val('');
                $('.brand_id').val('');
                $('.supplier_id').val('');
                $('#page-length-option').DataTable().destroy();
                fill_datatable();
            });

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }
        });
    </script>

@endpush
