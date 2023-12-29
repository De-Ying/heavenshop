    @extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê mã giảm giá')

@section('admin_content')
    @include('admin.theme.sidebar.coupon')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Mã giảm giá</span>
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
                                    Liệt kê mã giảm giá
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
                                            <a href="{{ route('coupon.view_insert') }}"
                                            class="form-control btn btn-mat btn-info m-l-5"><i
                                                class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên mã giảm giá</th>
                                                            <th>Ngày bắt đầu</th>
                                                            <th>Ngày kết thúc</th>
                                                            <th>Mã giảm giá</th>
                                                            <th>Số lượng mã</th>
                                                            <th>Số (%,$) giảm</th>
                                                            <th>Tình trạng</th>
                                                            <th>Gửi Mail</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($coupons as $coupon)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>

                                                                <td class="pro-name">
                                                                    <span>{{ $coupon->coupon_name }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $coupon->coupon_start_date }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $coupon->coupon_end_date }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $coupon->coupon_code }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $coupon->coupon_time }}</span>
                                                                </td>

                                                                <td>
                                                                    <?php if ($coupon->coupon_condition == 1) { ?>
                                                                        <span>
                                                                            Giảm {{ $coupon->coupon_number }} %
                                                                        </span>
                                                                    <?php } else { ?>
                                                                        <span>
                                                                            Giảm
                                                                            {{ number_format($coupon->coupon_number, 0, ',', '.') }}
                                                                            ₫
                                                                        </span>
                                                                    <?php } ?>
                                                                </td>

                                                                <td>
                                                                    <?php if ($coupon->coupon_end_date >= $today) { ?>
                                                                        <span class="chip green lighten-5">
                                                                            Còn hạn
                                                                        </span>
                                                                    <?php } else { ?>
                                                                        <span class="chip red lighten-5">
                                                                            Hết hạn
                                                                        </span>
                                                                    <?php } ?>
                                                                </td>

                                                                <td>
                                                                    <button
                                                                        onclick="location.href='{{ route('send_coupon_normal', ['coupon_code' => $coupon->coupon_code]) }}'"
                                                                        class="p-5 btn-xs btn-grd-primary m-b-5 brd-5"
                                                                        style="outline: none; border: none">Thường</button>
                                                                    <button
                                                                        onclick="location.href='{{ route('send_coupon_vip', ['coupon_code' => $coupon->coupon_code]) }}'"
                                                                        class="p-5 btn-xs btn-grd-warning brd-5"
                                                                        style="outline: none; border: none">Vip</button>
                                                                </td>

                                                                <td class="action-icon">
                                                                    <a href="{!! route('coupon.view_update', ['coupon_id' => $coupon->coupon_id]) !!}"
                                                                        class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                            class="fa fa-edit fa-fw"></i></a>

                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deleteCoupon({{ $coupon->coupon_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên mã giảm giá</th>
                                                            <th>Ngày bắt đầu</th>
                                                            <th>Ngày kết thúc</th>
                                                            <th>Mã giảm giá</th>
                                                            <th>Số lượng mã</th>
                                                            <th>Số (%,$) giảm</th>
                                                            <th>Tình trạng</th>
                                                            <th>Gửi Mail</th>
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

    <!-- Xóa mã giảm giá -->
    <script>
        function deleteCoupon(coupon_id) {
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
                    url: '{{ route('coupon.delete') }}',
                    method: 'POST',
                    data: {
                        coupon_id: coupon_id,
                        _token: _token
                    },
                    dataType: "html",

                    success: function() {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                });
            });
        }
    </script>

@endpush
