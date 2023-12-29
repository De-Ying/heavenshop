@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Danh sách khách hàng')


@section('admin_content')
    @include('admin.theme.sidebar.customer')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Khách hàng</span>
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
                                    Danh sách khách hàng
                                </li>
                                <li class="breadcrumb-item active">
                                    Lịch sử hóa đơn
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div id="popout" class="row">
                            <div class="col s12">
                                <h4 class="header">LỊCH SỬ ĐƠN HÀNG</h4>
                            </div>

                            <div class="col s12">
                                <ul class="collapsible popout">
                                    @foreach ($orders as $order)
                                        <?php
                                            switch ($order->order_status) {
                                                case '1':
                                                    $color = 'primary';
                                                    break;
                                                case '2':
                                                    $color = 'green';
                                                    break;
                                                case '3':
                                                    $color = 'red';
                                                    break;
                                                default:
                                                    $color = 'default';
                                                    break;
                                            }
                                        ?>

                                        <li class="active">
                                            <div class="collapsible-header light-{{ $color }} light-{{ $color }}-text text-lighten-5 m-b-5" tabindex="0">
                                                Đơn hàng số {{ $order->order_id }} | Tình trạng:

                                                @if ($order->order_status == 1)
                                                    Đang chờ xử lý
                                                @elseif ($order->order_status == 2)
                                                    Đã xử lý / Đang giao hàng
                                                @else
                                                    Đã hủy
                                                @endif
                                            </div>
                                            <div class="collapsible-body" style="display: block;">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">Thông tin khách hàng
                                                                </h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><b>Tên khách hàng</b>
                                                                                </td>
                                                                                <td>{!! $customer->customer_name !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Số điện thoại</b>
                                                                                </td>
                                                                                <td>{!! $customer->customer_phone !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Email</b></td>
                                                                                <td>{!! $customer->customer_email !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Địa chỉ</b></td>
                                                                                <td>{!! $customer->customer_address !!}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">Thông tin giao hàng
                                                                </h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><b>Người nhận hàng</b>
                                                                                </td>
                                                                                <td>{!! $order->shipping->shipping_name !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Số điện thoại</b>
                                                                                </td>
                                                                                <td>{!! $order->shipping->shipping_phone !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Email</b></td>
                                                                                <td>{!! $order->shipping->shipping_email !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Địa chỉ</b></td>
                                                                                <td>{!! $order->shipping->shipping_address !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Ghi chú</b></td>
                                                                                <td>
                                                                                    @if (!asset($order->shipping_notes))
                                                                                        {{ $order->shipping_notes }}
                                                                                    @else
                                                                                        Không có ghi chú
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h2 class="panel-title"><b>Danh sách sản
                                                                        phẩm</b></h2>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="col-lg-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hovered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>STT</th>
                                                                                    <th>Sản phẩm</th>
                                                                                    <th>Đơn giá</th>
                                                                                    <th>Số lượng</th>
                                                                                    <th>Thành tiền</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $details = DB::table('order_details')
                                                                                        ->where('order_id', $order->order_id)
                                                                                        ->get();
                                                                                @endphp
                                                                                <?php
                                                                                    $count = 0;
                                                                                    $total = 0;
                                                                                ?>
                                                                                @foreach ($details as $detail)
                                                                                    @php
                                                                                        $subtotal = $detail->product_price * $detail->product_sales_quantity;
                                                                                        $total += $subtotal;
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td>{!! $count = $count + 1 !!}
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            $sp = DB::table('products')
                                                                                                ->where('product_id', $detail->product_id)
                                                                                                ->first();
                                                                                                ?>
                                                                                                {{ $sp->product_name }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {!! number_format($detail->product_price, 0, ',','.') !!} đ
                                                                                        </td>
                                                                                        <td>
                                                                                            {!! $detail->product_sales_quantity !!}
                                                                                        </td>
                                                                                        <td>
                                                                                            {!! number_format($subtotal, 0, ',','.') !!} đ
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                <tr>
                                                                                    <td colspan="5">
                                                                                        <b style="float: right;
                                                                                        margin-right: 79px;">Tổng tiền :
                                                                                            {!! number_format($total, 0, ',','.') !!} đ
                                                                                        </b>
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
                                        </li>
                                    @endforeach
                                </ul>
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
