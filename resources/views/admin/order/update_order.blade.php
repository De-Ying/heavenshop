@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Câp nhật đơn hàng')

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
                                <li class="breadcrumb-item">
                                    <a href="{!! route('m-order.manage_order') !!}">Danh sách đơn hàng</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Câp nhật đơn hàng
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
                                                            <td class="uppercase" style="width: 200px;">{{ $ordDetail->product_name }}</td>
                                                            <td class="text-center">{{ $ordDetail->product_quantity }}</td>
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
                                                            <td class="text-center" style="width: 150px;">
                                                                <span>
                                                                    <input type="number" min="1"
                                                                            {{ $order_status == 2 || $order_status == 3  ? 'disabled' : '' }}
                                                                            name="product_sales_qty"
                                                                            class="order_qty_{{ $ordDetail->product_id }}"
                                                                            value="{{ $ordDetail->product_sales_quantity }}">
                                                                        <input type="hidden" name="order_qty_storage"
                                                                            class="order_qty_storage_{{ $ordDetail->product_id }}"
                                                                            value="{{ $ordDetail->product_quantity }}">
                                                                        <input type="hidden" name="order_code"
                                                                            class="order_code"
                                                                            value="{{ $ordDetail->order_code }}">
                                                                        <input type="hidden" name="order_product_id"
                                                                            class="order_product_id"
                                                                            value="{{ $ordDetail->product_id }}">
                                                                </span>

                                                                @if ($order_status != 2)
                                                                    <button class="update_quantity_order btn btn-grd-info"
                                                                        name="update_quantity_order"
                                                                        data-product_id="{{ $ordDetail->product_id }}"><i
                                                                            class="fa fa-save"></i></button>
                                                                @endif
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
                                                    @foreach ($orders as $order)
                                                        @if ($order->order_status == 1)
                                                            <form>
                                                                @csrf
                                                                <select class="form-control js-custom-select order_status">
                                                                    <option value="" selected disabled>--Chọn hình thức đơn hàng--</option>
                                                                    <option id={{ $order->order_id }} selected value="1">Đang chờ xử lý</option>
                                                                    <option id={{ $order->order_id }} value="2">Đã xử lý / Đang giao hàng</option>
                                                                    <option id={{ $order->order_id }} {{ $order_status == 1 ? 'disabled' : '' }} value="3">Hủy đơn hàng</option>
                                                                </select>
                                                            </form>
                                                        @elseif ($order->order_status == 2)
                                                            <form>
                                                                @csrf
                                                                <select class="form-control js-custom-select order_status">
                                                                    <option value="" selected disabled>--Chọn hình thức đơn hàng--</option>
                                                                    <option id={{ $order->order_id }} {{ $order_status == 2 ? 'disabled' : '' }} value="1">Đang chờ xử lý</option>
                                                                    <option id={{ $order->order_id }} selected value="2">Đã xử lý / Đang giao hàng</option>
                                                                    <option id={{ $order->order_id }} value="3">Hủy đơn hàng</option>
                                                                </select>
                                                            </form>
                                                        @elseif ($order->order_status == 3)
                                                            <form>
                                                                @csrf
                                                                <select class="form-control js-custom-select order_status">
                                                                    <option value="" selected disabled>--Chọn hình thức đơn hàng--</option>
                                                                    <option id={{ $order->order_id }} {{ $order_status == 3 ? 'disabled' : '' }} value="1">Đang chờ xử lý</option>
                                                                    <option id={{ $order->order_id }} {{ $order_status == 3 ? 'disabled' : '' }} value="2">Đã xử lý / Đang giao hàng</option>
                                                                    <option id={{ $order->order_id }} selected value="3">Hủy đơn hàng</option>
                                                                </select>
                                                            </form>
                                                        {{-- @else --}}

                                                        @endif
                                                    @endforeach
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
                    {{-- @include('admin.theme.bottomsidebar') --}}
                    <!-- END RIGHT SIDEBAR NAV -->
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Cập nhật số lượng theo mã hóa đơn (order_code) và mã sản phẩm  --}}
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+product_id).val();
            // Xử lý khi có nhiều người mua thì phân biệt dựa mã hóa đơn (order_code)
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('m-order.update_order_qty') }}',
                method: 'POST',
                data: {product_id:product_id, order_qty:order_qty, order_code:order_code, _token:_token},
                success:function (data) {
                    toastr.success('Cập nhật số lượng đơn hàng thành công!', 'Success');
                    setTimeout(function(){
                        location.reload();
                    }, 1000)
                }
            });
        });
    </script>

    {{-- Cập nhật trạng thái hóa đơn theo mã hóa đơn (order_id) và tính toán sl theo mã sản phẩm & số lượng mua --}}
    <script type="text/javascript">
        $('.order_status').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            // Lấy ra số lượng dựa vào mảng
            var quantity = [];
            $("input[name='product_sales_qty']").each(function () {
                quantity.push($(this).val());
            });
            // Lấy ra product_id đem so sánh
            var order_product_id = [];
            $("input[name='order_product_id']").each(function () {
                order_product_id.push($(this).val());
            });
            var j = 0;
            for( var i = 0; i < order_product_id.length; i++ ){
                // Số lượng khách đặt
                var order_qty = $('.order_qty_'+order_product_id[i]).val();
                // Số lượng tồn kho
                var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();

                if(parseInt(order_qty) > parseInt(order_qty_storage)){
                    j = j + 1;
                    // Chạy duy nhất 1 lần số lượng khách đặt > số lượng kho tồn
                    if(j == 1){
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_'+order_product_id[i]).css('background', '#000');
                    $('.color_qty_'+order_product_id[i]).css('color', '#fff');
                }
                // TH: Nếu else vào đây thì nó sẽ lặp và trừ hết số lượng tồn kho
            }
            // THĐB: Nếu mà số lượng tồn kho > số lượng khách đặt
            if(j == 0){
                $.ajax({
                    url: '{{ route('m-order.update_status_order') }}',
                    method: 'POST',
                    data: {order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id , _token:_token},
                    success:function (data) {
                        swal("Hoàn tất!", "Thay đổi tình trạng đơn hàng thành công!", "success");

                        setTimeout(function(){
                            location.reload();
                        }, 1000)
                    }
                });
            }
        });
    </script>
@endpush
