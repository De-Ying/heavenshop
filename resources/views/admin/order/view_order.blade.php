@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê đơn hàng')

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
                                <li class="breadcrumb-item">
                                    <a href="{!! route('m-order.manage_order') !!}">Danh sách đơn hàng</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Xem đơn hàng
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper-before blue-grey lighten-5"></div>
            <div class="col s12">
                <div class="container">
                    <!-- app invoice View Page -->
                    <section class="invoice-view-wrapper section">
                        <div class="row">
                            <!-- invoice view page -->
                            <div class="col xl9 m8 s12">
                                <div class="card">
                                    <div class="card-content invoice-print-area">
                                        <!-- header section -->
                                        <div class="row invoice-date-number">
                                            <div class="col xl4 s12">
                                                <span class="mr-1 invoice-number">HÓA ĐƠN#</span>
                                                <span>{{ $order_code }}</span>
                                            </div>
                                            <div class="col xl8 s12">
                                                <div class="flex-wrap invoice-date display-flex align-items-center flex-end">
                                                    <div class="mr-3">
                                                        <small>Ngày đặt:</small>
                                                        <span>{{ $order_date }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="mt-3 row invoice-logo-title">
                                            <div class="mt-1 col m6 s12 display-flex invoice-logo push-m6 flex-end">
                                                <img src="{{ asset('public/backend/app-assets/images/logo/logo-order.png') }}" alt="logo"
                                                    height="50" width="165" />
                                            </div>
                                            <div class="col m6 s12 pull-m6">
                                                <h4 class="indigo-text">HÓA ĐƠN</h4>
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-3 divider"></div>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col m4 s12">
                                                <h6 class="invoice-from">Thông tin khách hàng</h6>
                                                <div class="invoice-address">
                                                    <span>{{ $customer->customer_name }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $customer->customer_address }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $customer->customer_email }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $customer->customer_phone }}</span>
                                                </div>
                                            </div>

                                            <div class="col m4 s12">
                                                <div class="mb-3 divider show-on-small hide-on-med-and-up"></div>
                                                <h6 class="invoice-to">Thông tin vận chuyển</h6>
                                                <div class="invoice-address">
                                                    <span>{{ $shipping->shipping_name }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $shipping->shipping_address }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $shipping->shipping_email }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>{{ $shipping->shipping_phone }}</span>
                                                </div>
                                                <div class="invoice-address">
                                                    <span>Phương thức thanh toán:
                                                        @if ($shipping->shipping_method == 1)
                                                            Tiền mặt
                                                        @elseif ($shipping->shipping_method == 2)
                                                            Thẻ ATM
                                                        @elseif ($shipping->shipping_method == 3)
                                                            Thẻ ghi nợ
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col m4 s12">
                                                <h6 class="invoice-from">Thông tin đặt hàng</h6>
                                                <div class="invoice-address">
                                                    <span>
                                                        <label for="" class="block fs-16 m-b-5">Trạng thái</label>
                                                        @if ($order_status == 1)
                                                            <span class="btn btn-grd-warning fs-12" style="padding: 0 5px;">Đang chờ xử lý</span>
                                                        @elseif ($order_status == 2)
                                                            <span class="btn btn-grd-success fs-12" style="padding: 0 5px;">Đã xử lý / Đang giao hàng</span>
                                                        @elseif ($order_status == 3)
                                                            <span class="btn btn-grd-danger fs-12">Đã hủy</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-3 divider"></div>
                                        <!-- product details table-->
                                        <div class="invoice-product-details">
                                            <table class="striped responsive-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Số lượng kho</th>
                                                        <th>Mã giảm giá</th>
                                                        <th>Phí ship hàng</th>
                                                        <th>Số lượng khách đặt</th>
                                                        <th>Giá</th>
                                                        <th class="right-align">Tổng tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                    @endphp

                                                    @foreach ($orderDetails as $key => $ordDetail)
                                                        @php
                                                            $subtotal = $ordDetail->product_price * $ordDetail->product_sales_quantity;
                                                            $total += $subtotal;
                                                        @endphp

                                                        <tr class="color_qty_{{ $ordDetail->product_id }}">
                                                            <td class="uppercase">{{ $ordDetail->product_name }}</td>
                                                            <td>{{ $ordDetail->product_quantity }}</td>
                                                            <td>
                                                                @if ($ordDetail->product_coupon != 'no')
                                                                    {{ $ordDetail->product_coupon }}
                                                                @else
                                                                    Không có mã giảm giá
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($ordDetail->product_feeship != 0)
                                                                    {{ number_format($ordDetail->product_feeship, 0, ',', '.') }}
                                                                @else
                                                                    Không có phí ship
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <span>
                                                                    {{ $ordDetail->product_sales_quantity }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <label>
                                                                    {{ number_format($ordDetail->product_price, 0, ',', '.') }}
                                                                </label>
                                                            </td>
                                                            <td class="indigo-text right-align">
                                                                {{ number_format($subtotal, 0, ',', '.') . ' ' . '₫' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- invoice subtotal -->
                                        <div class="mt-3 mb-3 divider"></div>
                                        <div class="invoice-subtotal">
                                            <div class="row">
                                                <div class="col m5 s12">
                                                </div>
                                                <div class="col xl4 m7 s12 offset-xl3">
                                                    <ul>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Tổng phụ</span>
                                                            <h6 class="invoice-subtotal-value">{{ number_format($total, 0, ',', '.') . ' ' . '₫' }}</h6>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Phiếu giảm</span>
                                                            <h6 class="invoice-subtotal-value">
                                                                @if($coupon_condition == 1)
                                                                    @php
                                                                        $total_after_coupon = ($total*$coupon_number)/100;
                                                                        echo number_format($total_after_coupon,0,',','.') . ' ' . '₫';
                                                                        $total_coupon = $total - $total_after_coupon + $ordDetail->product_feeship;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        if ($coupon_number != 0){
                                                                            echo number_format($coupon_number,0,',','.') . ' ' . '₫';
                                                                            $total_coupon = $total - $coupon_number + $ordDetail->product_feeship;
                                                                        }else{
                                                                            echo 0 . ' ' . '₫';
                                                                            $total_coupon = $total - $coupon_number + $ordDetail->product_feeship;
                                                                        }
                                                                    @endphp
                                                                @endif
                                                            </h6>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Phí vận chuyển</span>
                                                            <h6 class="invoice-subtotal-value">
                                                                @php
                                                                    if($ordDetail->product_feeship != 0){
                                                                        echo number_format($ordDetail->product_feeship,0,',','.') . ' ' . '₫';
                                                                    }else{
                                                                        echo 0 . ' ' . '₫';
                                                                    }
                                                                @endphp
                                                            </h6>
                                                        </li>
                                                        <li class="mt-2 mb-2 divider"></li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Tổng đơn hàng</span>
                                                            <h6 class="invoice-subtotal-value">{{ number_format($total_coupon,0,',','.') . ' ' . '₫' }}</h6>
                                                        </li>
                                                        {{-- <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Paid to date</span>
                                                            <h6 class="invoice-subtotal-value">
                                                                - $ 00.00
                                                            </h6>
                                                        </li>
                                                        <li class="display-flex justify-content-between">
                                                            <span class="invoice-subtotal-title">Balance (USD)</span>
                                                            <h6 class="invoice-subtotal-value">$ 10,953</h6>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- invoice action  -->
                            <div class="col xl3 m4 s12">
                                <div class="card invoice-action-wrapper">
                                    <div class="card-content">
                                        <div class="invoice-action-btn m-b-10">
                                            <a href="{{ route('m-order.print_order', ['check_code' => $order_code]) }}"
                                                class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                                <span>In đơn háng</span>
                                            </a>
                                        </div>
                                        <div class="invoice-action-btn m-b-10">
                                            <a href="{{ route('m-order.update_order', ['order_code' => $order_code]) }}"
                                                class=" btn-block btn btn-light-indigo waves-effect waves-light">
                                                <span>Cập nhật đơn hàng</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- START RIGHT SIDEBAR NAV -->
                    {{-- @include('admin.theme.rightsidebar') --}}

                    <!-- END RIGHT SIDEBAR NAV -->
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
@endsection
