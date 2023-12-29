@extends('layout')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/profile.css') !!}">
    @endpush

    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                @lang('lang.home')
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="uppercase stext-109 cl4 text-red">
                Lịch sử mua hàng
            </span>
        </div>
    </div>

    <div class="bg0 m-t-30 p-b-80">
        <div class="container">
            <div class="row">
                <div class="m-12 col l-3 c-12 p-b-30">
                    <div class="row">
                        <div class="m-12 col l-12 c-12">
                            <div class="order-user">
                                @if (Session::has('customer_image'))
                                    <img class="img-radius img-40 radius-50 w-70 h-70"
                                        src="{{ url('public/uploads/customer/' . Session::get('customer_image')) }}"
                                        alt="profile-user">
                                @elseif (Session::has('customer_image_social'))
                                    <img class="img-radius img-40 radius-50"
                                        src="{{ Session::get('customer_image_social') }}" alt="profile-user">
                                @endif

                                <div class="m-t-30 m-l-50">
                                    <h5 class="m-b-5 fs-20">
                                        @if (Session::get('customer_id') != null)
                                            {{ Session::get('customer_name') }}
                                        @endif
                                    </h5>

                                    <span>
                                        <a class="text-black-36 fs-14" href="{{ route('account.profile') }}"><i
                                                class="icofont icofont-edit"></i> Sửa hồ sơ</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="m-12 col l-12 c-12">
                            <div class="p-t-50">
                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                    class="uppercase text-black-36 fs-14" href="#account" id="profile">
                                                    <span class="caret"></span>
                                                    <i class="icofont icofont-user-alt-2"></i> Tài khoản của tôi
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="account" class="panel-collapse collapse">
                                            <div class="panel-body m-b-5 m-l-15">
                                                <ul>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.profile') }}">Hồ sơ</a>
                                                    </li>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.password') }}">Đổi mật khẩu</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('purchase') }}"><i class="zmdi zmdi-assignment"></i>
                                                    Lịch sử
                                                    mua hàng</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 wishlist-link fs-14"
                                                    href="{{ route('wishlist') }}"><i class="fa fa-heart-o"
                                                        aria-hidden="true"></i> Danh sách yêu thích</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('buyer.logout') }}"><i
                                                        class="icofont icofont-logout"></i> Đăng
                                                    xuất</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-12 col l-9 c-12 p-b-20">
                    <h5 class="fs-16">Lịch sử mua hàng</h5>

                    <div class="data_table_main table-responsive dt-responsive m-t-15">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="l-12">
                                    <form autocomplete="off" class="h-130">
                                        @csrf
                                        <div class="float-left col l-3 m-t-10 m-b-20 m-r-20 fs-14">
                                            Từ ngày: <input type="text" id="filter_start_order"
                                                class="form-control filter_start_order m-t-5">
                                        </div>

                                        <div class="float-left col l-3 m-t-10 m-b-20 m-r-20 fs-14">
                                            Đến ngày: <input type="text" id="filter_end_order"
                                                class="form-control filter_end_order m-t-5">
                                        </div>

                                        <div class="float-left col l-3 m-b-20">
                                            <input type="button" id="filter_order_btn"
                                                class="btn btn-primary fs-15 filter_order_btn" value="Lọc kết quả">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col l-12">
                                    @if ($count_order > 0)
                                        <table id="simpletable"
                                            class="table table-striped table-bordered nowrap dataTable fs-14"></table>
                                    @else
                                        <div class="col-sm-12 purchase_order">
                                            <img class="order_img"
                                                src="{{ url('public/frontend/images/icons/order.png') }}" alt="#">
                                            <p class="text-black m-t-20 fs-16">Chưa có đơn hàng</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        const currentLocationAccount = location.href;
        const filterAccount = document.querySelectorAll('.order-link');
        const filterLengthAccount = filterAccount.length;
        for (let i = 0; i < filterLengthAccount; i++) {
            if (filterAccount[i].href === currentLocationAccount) {
                filterAccount[i].classList.add('order-link-active');
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {
            $("#filter_start_order").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "d/m/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow",
                showOtherMonths: true,
                selectOtherMonths: true
            });

            $("#filter_end_order").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "d/m/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow",
                showOtherMonths: true,
                selectOtherMonths: true
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            order1months();

            function order1months() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('show_order_date') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },

                    success: function(data) {
                        $('#simpletable').html(data);
                    }
                });
            }

            $('#filter_order_btn').click(function() {
                var filter_start_order = $('#filter_start_order').val();
                var filter_end_order = $('#filter_end_order').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('filter_order_date') }}',
                    method: 'POST',
                    data: {
                        filter_start_order: filter_start_order,
                        filter_end_order: filter_end_order,
                        _token: _token
                    },

                    success: function(data) {
                        $('#simpletable').html(data);

                        document.getElementById('filter_start_order').innerHTML =
                            filter_start_order;
                        document.getElementById('filter_end_order').innerHTML =
                        filter_end_order;
                    }
                });
            });
        });
    </script>
@endpush
