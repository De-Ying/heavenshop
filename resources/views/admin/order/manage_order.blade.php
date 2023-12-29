@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê đơn hàng')

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
    @include('admin.theme.sidebar.order')

    {!! Toastr::message() !!}
    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Đơn hàng</span>
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
                                    Danh sách đơn hàng
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
                                <div class="col s12 m6 l3">
                                    <label for="users-list-verified">Từ ngày</label>
                                    <div class="input-field">
                                        <input type="text" name="bill_from" id="bill_from" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col s12 m6 l3">
                                    <label for="users-list-role">Đến ngày</label>
                                    <div class="input-field">
                                        <input type="text" name="bill_to" id="bill_to" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col s12 m6 l3">
                                    <label for="users-list-status">Trạng thái</label>
                                    <div class="input-field">
                                        <select class="select2 browser-default form-control" name="bill_status" id="bill_status">
                                            <option value="">Hãy chọn trạng thái</option>
                                            <option value="1">Đang chờ xử lý</option>
                                            <option value="2">Đã xử lý / Đang giao hàng</option>
                                            <option value="3">Hủy đơn hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m6 l3 display-flex align-items-center show-btn m-t-50">
                                    <button type="button"
                                        class="btn btn-block indigo waves-effect waves-light" id="filter">Lọc</button>
                                </div>
                            </div>
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
                                                            <th>Mã hóa đơn</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Phương thức</th>
                                                            <th>Trạng thái</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Mã hóa đơn</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Phương thức</th>
                                                            <th>Trạng thái</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            fill_datatable();

            function fill_datatable(bill_from = '', bill_to = '', bill_status = '') {
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
                        "sProcessing": 'Loading <i class="fa fa-spinner" style="transition: 2s;"></i>',
                        "oPaginate": {
                            "sNext": "Trang sau",
                            "sPrevious": "Trang trước",
                        }
                    },
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8]
                            },
                            text: '<i class="fas fa-print"></i> Print',
                        },
                    ],
                    ajax: {
                        url: "{{ route('m-order.manage_order') }}",
                        data: {
                            bill_from: bill_from,
                            bill_to: bill_to,
                            bill_status: bill_status
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex' },
                        { data: 'order_code' },
                        { data: 'customer.customer_name' },
                        { data: 'order_date' },
                        { data: 'shipping.shipping_method',
                            "render": function (data, type, row) {
                                if (data == 1) {
                                    return 'Tiền mặt';
                                } else if (data == 2) {
                                    return 'Thẻ ATM';
                                } else {
                                    return 'Thẻ ghi nợ'
                                }
                            }
                        },
                        { data: 'order_status',
                            "render": function (data, type, row) {
                                if (data == 1) {
                                    return '<span class="chip lighten-5 orange orange-text">Đang chờ xử lý</span>';
                                } else if (data == 2) {
                                    return '<span class="chip lighten-5 green green-text">Đã xử lý / Đang giao hàng</span>';
                                } else {
                                    return '<span class="chip lighten-5 red red-text">Hủy đơn hàng</span>'
                                }
                            }
                        },
                        {
                            data: 'action', name: 'action',
                            orderable: true,
                            searchable: true,
                        },
                    ]
                });
            }

            $('#filter').click(function () {
                var bill_from   = $('#bill_from').val();
                var bill_to     = $('#bill_to').val();
                var bill_status = $('#bill_status').val();

                if (bill_from !== '' && bill_to !== '' || bill_status !== '') {
                    $('#page-length-option').DataTable().destroy();
                    fill_datatable(bill_from, bill_to, bill_status);
                } else {
                    alert('Hãy lựa chọn phù hợp để lọc');
                    $('#page-length-option').DataTable().destroy();
                    fill_datatable();
                }
            });
        });
    </script>

@endpush
