@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Phí vận chuyển')

@section('admin_content')
    @include('admin.theme.sidebar.delivery')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Vận chuyển</span>
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
                                    Thêm phí vận chuyển
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
                                <form>
                                    @csrf
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-verified">Tỉnh / Thành phố</label>
                                        <div class="input-field">
                                            <select id="city" class="select2 browser-default form-control stock choose city" name="city">
                                                <option value="">---- Chọn tỉnh/thành phố ----</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <label for="users-list-role">Quận / Huyện</label>
                                        <div class="input-field">
                                            <select id="district" class="select2 browser-default form-control stock choose district" name="district">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Phường / Xã</label>
                                        <div class="input-field">
                                            <select id="commune" class="select2 browser-default form-control stock commune" name="commune">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Phí vận chuyển</label>
                                        <div class="input-field">
                                            <input
                                                name="fee_ship"
                                                type="text"
                                                rules="required"
                                                class="form-control fee_ship"
                                                placeholder="Phí vận chuyển"
                                                style="border: 1px solid #aaa;
                                                border-radius: 5px;
                                                padding: 0 5px;
                                                margin: 0 -5px;"
                                            >
                                            <span class="input-message"></span>
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l12 display-flex align-items-center show-btn m-t-30">
                                        <button type="button"
                                            class="btn btn-block indigo waves-effect waves-light add_delivery" name="add_delivery">Thêm phí vận chuyển</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-header" style="padding: 12px 24px 0;">
                                        <h5>Dữ liệu vận chuyển</h5>
                                    </div>

                                    <div class="card-content" id="load_delivery">

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

    {{-- Ajax -=- quận/xã/phường--}}
    <script type="text/javascript">
        $(document).ready(function (){
            // 1. Chọn tỉnh/thành phố đổ ra quận/huyện, xã phường
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action=='city'){
                    result = 'district';
                }else{
                    result = 'commune';
                }
                $.ajax({
                    url: '{{ route('delivery.select_delivery') }}',
                    method: 'POST',
                    data: {action:action, ma_id:ma_id, _token:_token},
                    success:function (data) {
                        $('#'+result).html(data);
                    }
                });
            });
            // 2. Thêm vận chuyển
            $('.add_delivery').click(function () {
                var city_id = $('.city').val();
                var district_id = $('.district').val();
                var commune_id = $('.commune').val();
                var fee_feeship = $('.fee_ship').val();

                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('delivery.insert_delivery') }}',
                    method: 'POST',
                    data: {city_id:city_id, district_id:district_id, commune_id:commune_id, fee_feeship:fee_feeship , _token:_token},
                    success:function (data) {
                        toastr.success('Thêm phí vận chuyển thành công', 'Hoàn tất');
                        fetch_delivery();
                    },
                    error: function (data) {
                        $('.city').val('');
                        $('.district').val('');
                        $('.commune').val('');
                        $('.fee_ship').val('');
                        toastr.error('Thêm phí vận chuyển thất bại', 'Thất bại');
                    }
                });
            });
            // 3. Load dữ liệu đổ lên view
            fetch_delivery();

            function fetch_delivery() {
                $.ajax({
                    url: '{{ route('delivery.select_feeship') }}',
                    method: 'GET',
                    success:function (data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            // 4. Cập nhật tiền vận chuyển -// blur
            $(document).on('blur', '.fee_feeship_edit', function () {
                var feeship_id = $(this).data('feeship_id');
                var feeship_price = $(this).text();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('delivery.update_feeship') }}',
                    method: 'POST',
                    data: {feeship_id:feeship_id, feeship_price:feeship_price, _token:_token},
                    success:function (data) {
                        toastr.success('Cập nhật phí vận chuyển thành công', 'Success')
                        fetch_delivery();
                    }
                });
            });
        });
    </script>
@endpush
