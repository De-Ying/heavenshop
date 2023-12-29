@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thống kê hóa đơn')

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
    @include('admin.theme.sidebar.statistic.bill')

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
                                    Thống kê hóa đơn
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
                            <form action="{{ route('statistic.bill.pdf-bill') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l4">
                                        <label for="users-list-verified">Từ ngày</label>
                                        <div class="input-field">
                                            <input type="text" name="order_from" id="order_from" class="form-control datepicker">
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Đến ngày</label>
                                        <div class="input-field">
                                            <input type="text" name="order_to" id="order_to" class="form-control datepicker">
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Khách hàng</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control customer_id" name="customer_id" id="customer_id"
                                                style="width: 60%;" readonly>
                                                <option selected value="">--- Chọn khách hàng ---</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->customer_id }}">
                                                        [{{ $customer->customer_phone }}] - {{ $customer->customer_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="button" name="bill-filter" id="bill-filter"
                                            class="btn btn-grd-inverse indigo waves-effect waves-light">
                                            <i class="fa fa-filter"></i>
                                            Lọc</button>
                                    </div>

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="button" class="btn btn-grd-info btn-sm m-r-5" name="refresh" id="refresh"><i class="fa fa-refresh"></i></button>
                                    </div>

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="submit" class="btn btn-grd-info btn-sm m-r-5" name="bill-pdf" id="bill-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
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
                                                            <th>#</th>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Khách hàng</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Mã giảm giá</th>
                                                            <th>Phí ship</th>
                                                            <th>Ngày tạo</th>
                                                            <th>Trạng thái</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Khách hàng</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Mã giảm giá</th>
                                                            <th>Phí ship</th>
                                                            <th>Ngày tạo</th>
                                                            <th>Trạng thái</th>
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

            function fill_datatable(order_from = '', order_to = '', customer_id = '') {
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            },
                            text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            },
                            text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            },
                            text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print',
                        }
                    ],
                    ajax: {
                        url: "{{ route('statistic.bill.bill') }}",
                        data: {
                            order_from: order_from,
                            order_to: order_to,
                            customer_id: customer_id
                        }
                    },
                    columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'order_code',
                        },
                        {
                            data: 'customer_name',
                        },
                        {
                            data: 'sales',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                        {
                            data: 'product_coupon',
                            render: function(data) {
                                if (data != 'no') {
                                    return formatNumber(data);
                                } else {
                                    return data;
                                }

                            }
                        },
                        {
                            data: 'product_feeship',
                            render: function(data) {
                                return formatNumber(data);
                            }
                        },
                        {
                            data: 'order_date',
                        },
                        {
                            data: 'order_status',
                            render: function (data) {
                                if (data == 1) {
                                    return '<span class="chip lighten-5 orange orange-text">Đang chờ xử lý</span>';
                                }else if(data == 2){
                                    return '<span class="chip lighten-5 green green-text">Đã xử lý / Đã thanh toán</span>';
                                }else{
                                    return '<span class="chip lighten-5 red red-text">Đã hủy</span>';
                                }
                            }
                        },
                    ]
                });
            }

            $('#bill-filter').click(function() {
                var order_from = $('#order_from').val();
                var order_to = $('#order_to').val();
                var customer_id = $('#customer_id').val();

                if (order_from != '' && order_to != '' || customer_id != '') {
                    $('#page-length-option').DataTable().destroy();
                    fill_datatable(order_from, order_to, customer_id);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#order_from').val('');
                $('#order_to').val('');
                $('#customer_id').val('');
                $('#page-length-option').DataTable().destroy();
                fill_datatable();
            });

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }
        });
    </script>

@endpush
