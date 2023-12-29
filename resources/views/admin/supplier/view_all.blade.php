@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê nhà cung cấp')

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
                                <li class="breadcrumb-item active">
                                    Liệt kê nhà cung cấp
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h4 class="card-title m-b-20">
                                            <a href="{{ route('supplier.view_insert') }}"
                                                    class="form-control btn btn-mat btn-info m-l-5"><i
                                                        class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>

                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Tên nhà cung cấp</th>
                                                            <th>Số điện thoại</th>
                                                            <th>Địa chỉ</th>
                                                            <th>E-Mail</th>
                                                            <th>Trạng thái</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($suppliers as $supplier)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-list-img">
                                                                    <img src="{{ URL::to('public/uploads/supplier/' . $supplier->supplier_image) }}"
                                                                        height="70" width="70"
                                                                        alt="{{ $supplier->supplier_name }}" />
                                                                </td>
                                                                <td class="pro-name">
                                                                    <span>{{ $supplier->supplier_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $supplier->supplier_phone }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $supplier->supplier_address }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $supplier->supplier_email }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-ellipsis">
                                                                        <?php if ($supplier->supplier_status == 1) { ?>
                                                                        <a href="{{ route('supplier.unactive_supplier', ['supplier_id' => $supplier->supplier_id]) }}"
                                                                            type="button"
                                                                            class="text-base btn btn-grd-warning btn-sm"><i
                                                                                class="fa fa-retweet"></i> Ẩn</a>
                                                                        <?php } else { ?>
                                                                        <a href="{{ route('supplier.active_supplier', ['supplier_id' => $supplier->supplier_id]) }}"
                                                                            type="button"
                                                                            class="text-base btn btn-grd-success btn-sm w-46"><i
                                                                                class="fa fa-retweet"></i> Hiện</a>
                                                                        <?php } ?>
                                                                    </span>
                                                                </td>
                                                                <td class="action-icon">
                                                                    @if ($supplier->supplier_status == 1)
                                                                        <a href="{{ route('supplier.view_update', ['supplier_id' => $supplier->supplier_id]) }}" class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                                class="fa fa-edit fa-fw"></i></a>
                                                                    @endif
                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deleteSupplier({{ $supplier->supplier_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Tên nhà cung cấp</th>
                                                            <th>Số điện thoại</th>
                                                            <th>Địa chỉ</th>
                                                            <th>E-Mail</th>
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
                </div>

                {{-- @include('admin.supplier.view_insert') --}}

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

    <script>
        function deleteSupplier(supplier_id) {
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
                    url: '{{ route('supplier.delete') }}',
                    method: 'POST',
                    data: {
                        supplier_id: supplier_id,
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
