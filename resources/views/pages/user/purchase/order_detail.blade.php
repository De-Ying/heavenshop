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

            <a href="{{ route('purchase') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Lịch sử đơn hàng
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="uppercase stext-109 cl4 text-red">
                Chi tiết đơn hàng
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

                <div class="m-12 col l-9 c-12 p-b-30">
                    <h5 class="fs-16">Chi tiết đơn hàng</h5>

                    <div class="data_table_main table-responsive dt-responsive m-t-15">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col l-12">
                                    <table id="simpletable"
                                        class="table table-striped table-bordered nowrap dataTable fs-14">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Hình ảnh</th>
                                                <th>Số lượng đặt</th>
                                                <th>Mã giảm giá</th>
                                                <th>Phí ship</th>
                                                <th>Giá</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $stt = 1;
                                                $total = 0;
                                            @endphp

                                            @foreach ($orderDetails as $ordDetail)
                                                @php
                                                    $subtotal = $ordDetail->product_price * $ordDetail->product_sales_quantity;
                                                    $total += $subtotal;
                                                @endphp

                                                <tr>
                                                    <td>{{ $stt++ }}</td>
                                                    <td style="width: 210px;">
                                                        {{ $ordDetail->product->product_name }}</td>
                                                    <td><img width="60px" height="60px"
                                                            src="{{ url('public/uploads/product/' . $ordDetail->product->product_image) }}"
                                                            alt=""></td>
                                                    <td>
                                                        <input type="hidden" name="product_sales_qty"
                                                            class="order_qty_{{ $ordDetail->product_id }}"
                                                            value="{{ $ordDetail->product_sales_quantity }}">
                                                        <input type="hidden" name="order_qty_storage"
                                                            class="order_qty_storage_{{ $ordDetail->product_id }}"
                                                            value="{{ $ordDetail->product->product_quantity }}">
                                                        <input type="hidden" name="order_code"
                                                            class="order_code"
                                                            value="{{ $ordDetail->order_code }}">
                                                        <input type="hidden" name="order_product_id"
                                                            class="order_product_id"
                                                            value="{{ $ordDetail->product_id }}">

                                                        {{ $ordDetail->product_sales_quantity }}
                                                    </td>
                                                    <td>
                                                        @if ($ordDetail->product_coupon != 'no')
                                                            {{ $ordDetail->product_coupon }}
                                                        @else
                                                            Không có mã giảm giá
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ordDetail->product_feeship != 0)
                                                            {{ number_format($ordDetail->product_feeship, 0, ',', '.') . ' ' . '₫' }}
                                                        @else
                                                            Không có phí ship
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ number_format($ordDetail->product_price, 0, ',', '.') . ' ' . '₫' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($subtotal, 0, ',', '.') . ' ' . '₫' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col l-8">
                                    @if ($order_status != 1 && $order_status != 3)
                                        <button type="button" class="btn btn-danger m-t-10 m-l-33"
                                            data-toggle="modal" data-target="#{{ $order_id }}"><i
                                                class="icofont icofont-ui-close"></i>
                                            Hủy đơn hàng</button>
                                    @endif
                                </div>

                                <div id="{{ $order_id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog m-t-200">
                                        <form>
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><textarea name="order_reason" required=""
                                                            class="form-control order_reason" rows="5"
                                                            placeholder="Hãy điền lý do hủy đơn hàng... (Bắt buộc)"></textarea>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Đóng lại</button>
                                                    <button type="button" class="btn btn-success"
                                                        data-dismiss="modal" id="{{ $order_id }}"
                                                        onclick="cancel_order(this.id)">Gửi lý do
                                                        hủy</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col l-4">
                                    <table class="table table-responsive invoice-table invoice-total fs-14">
                                        <tbody>
                                            <tr>
                                                <th>Tổng phụ:</th>
                                                <td>{{ number_format($total, 0, ',', '.') . ' ' . '₫' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Phiếu giảm:</th>
                                                <td>
                                                    @if ($coupon_condition == 1)
                                                        @php
                                                            $total_after_coupon = ($total * $coupon_number) / 100;
                                                            echo number_format($total_after_coupon, 0, ',', '.') . ' ' . '₫';
                                                            $total_coupon = $total - $total_after_coupon + $ordDetail->product_feeship;
                                                        @endphp
                                                    @else
                                                        @php
                                                            if ($coupon_number != 0) {
                                                                echo number_format($coupon_number, 0, ',', '.') . ' ' . '₫';
                                                                $total_coupon = $total - $coupon_number + $ordDetail->product_feeship;
                                                            } else {
                                                                echo 0 . ' ' . '₫';
                                                                $total_coupon = $total - $coupon_number + $ordDetail->product_feeship;
                                                            }
                                                        @endphp
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Phí vận chuyển:</th>
                                                <td>
                                                    @php
                                                        if ($ordDetail->product_feeship != 0) {
                                                            echo number_format($ordDetail->product_feeship, 0, ',', '.') . ' ' . '₫';
                                                        } else {
                                                            echo 0 . ' ' . '₫';
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr class="text-info">
                                                <th class="text-danger" style="font-size: 17px">Tổng đơn
                                                    hàng:</th>
                                                <td>
                                                    <h4 class="text-danger">
                                                        {{ number_format($total_coupon, 0, ',', '.') . ' ' . '₫' }}
                                                    </h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                filterAccount[i].className = "order-link-active";
            }
        }
    </script>
@endpush
