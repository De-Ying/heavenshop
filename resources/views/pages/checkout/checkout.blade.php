@extends('layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/customs/checkout.css') }}">
@endpush

@section('main')
    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('view_cart') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Giỏ hàng của bạn
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Thanh toán
            </span>
        </div>
    </div>

    <?php if (Session::get('cart') && count(Session::get('cart')) > 0) {
    $arr_cart = Session::get('cart'); ?>
    <div class="bg0 p-t-40 p-b-85">
        @if (session()->has('message'))
            <div class="alert alert-success icons-alert" role="alert" style="margin: 0 174px 15px 158px;">
                <li style="display: block">
                    {!! session()->get('message') !!}
                </li>
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col l-8 m-b-50">
                    <div class="wrap-table-shopping-cart">
                        <form action="{{ route('update_all_num_cart_checkout') }}" method="POST">
                            @csrf
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1" style="font-family: Roboto,sans-serif;">Hình ảnh</th>
                                    <th class="column-2" style="font-family: Roboto,sans-serif;">Tên sản phẩm</th>
                                    <th class="column-3" style="font-family: Roboto,sans-serif;">Giá</th>
                                    <th class="column-4" style="font-family: Roboto,sans-serif;">Số lượng</th>
                                    <th class="column-5" style="font-family: Roboto,sans-serif;">Tổng tiền</th>
                                    <th class="column-6"></th>
                                </tr>

                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($arr_cart as $item)

                                    @php
                                        $subtotal = $item['price'] * $item['num'];
                                        $total += $subtotal;
                                    @endphp

                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1 header-cart-item-img" data-del_id="{{ $item['id'] }}">
                                                <img src="{{ URL::to('public/uploads/product/' . $item['image']) }}"
                                                    alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-3">
                                            {{ number_format($item['price'], 0, ',', '.') . ' ' . '₫' }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <a href="{{ URL::to('/checkout/update-num-cart-checkout/'.$item['id'].'/'.'minus') }}"
                                                    class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m fs-14">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </a>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="cart_quantity[{{ $item['session_id'] }}]"
                                                    value="{{ $item['num'] }}">

                                                <a href="{{ URL::to('/checkout/update-num-cart-checkout/'.$item['id'].'/'.'plus') }}"
                                                    class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m fs-14"
                                                    style="border-right: 1px solid #e6e6e6;">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="column-5" style="padding-left: 10px;">
                                            {{ number_format($subtotal, 0, ',', '.') . ' ' . '₫' }}
                                        </td>
                                        <td class="column-6">
                                            <button type="button" onclick="confirmDelete({{ $item['id'] }})"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <button type="submit"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor3 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 m-lr-15 c-hover"
                                style="font-family: Roboto,sans-serif; float: left;">
                                Cập nhật giỏ hàng
                            </button>

                            <button type="button"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor3 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 c-hover"
                                onclick="confirmDeleteAll()" style="font-family: Roboto,sans-serif; float: left;">
                                Xoá toàn bộ giỏ hàng
                            </button>
                        </form>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-lr-40 p-lr-15-sm">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 p-b-10" style="border-bottom: 1px dashed #dedede;">
                            <div class="size-209 fl">
                                <span class="stext-110 cl2">
                                    Tổng tiền:
                                </span>
                            </div>

                            <div class="size-208 fl">
                                <span class="mtext-110 cl2">
                                    {{ number_format($total, 0, ',', '.') . ' ' . '₫' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                            @if ($cou['coupon_condition'] == 1)
                                @php
                                    $total_coupon = ($total * $cou['coupon_number'])/100;
                                    $total_after_coupon = $total - $total_coupon;
                                @endphp

                                <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4 p-b-10" style="border-bottom: 1px dashed #dedede;">
                                        <div class="size-209 fl">
                                            <span class="stext-110 cl2">
                                                Mã giảm:
                                            </span>
                                        </div>

                                        <div class="size-208 fl">
                                            <span class="mtext-110 cl2">
                                                <img src="{{ asset('public/frontend/images/cart/coupon.png') }}" alt=""> {{ number_format($total_coupon, 0,',','.') . ' ' . '₫' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            @elseif($cou['coupon_condition'] == 2)
                                @php
                                    $total_coupon = $total - $cou['coupon_number'];
                                    $total_after_coupon = $total_coupon;
                                @endphp

                                <div class="flex-w flex-sb-m bor15 p-t-18 p-lr-40 p-lr-15-sm">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4 p-b-10" style="border-bottom: 1px dashed #dedede;">
                                        <div class="size-209 fl">
                                            <span class="stext-110 cl2">
                                                Mã giảm:
                                            </span>
                                        </div>

                                        <div class="size-208 fl">
                                            <span class="mtext-110 cl2">
                                                <img src="{{ asset('public/frontend/images/cart/coupon.png') }}" alt=""> {{ number_format($cou['coupon_number'], 0,',','.') . ' ' . '₫' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @if(Session::get('fee'))
                        @foreach(Session::get('fee') as $key => $fee)
                            @php
                                $total_after_fee = $total + $fee['fee_feeship'];
                            @endphp

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-lr-40 p-lr-15-sm">
                                <div class="col-md-8"></div>
                                <div class="col-md-4 p-b-10" style="border-bottom: 1px dashed #dedede;">
                                    <div class="size-209 fl">
                                        <span class="stext-110 cl2">
                                            Phí vận chuyển:
                                        </span>
                                    </div>

                                    <div class="size-208 fl">
                                        <span class="mtext-110 cl2">
                                            <img src="{{ asset('public/frontend/images/cart/free-delivery.png') }}" alt=""> {{ number_format($fee['fee_feeship'], 0,',','.') . ' ' . '₫' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @php
                        if (Session::get('fee') && !Session::get('coupon')) {
                            $total_after = $total_after_fee;
                        } elseif (!Session::get('fee') && Session::get('coupon')) {
                            $total_after = $total_after_coupon;
                        } elseif (Session::get('fee') && Session::get('coupon')) {
                            $total_after = $total_after_coupon;
                            $total_after = $total_after + $fee['fee_feeship'];
                        } elseif (!Session::get('fee') && !Session::get('coupon')) {
                            $total_after = $total;
                        }
                    @endphp

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="border-bottom: 1px solid #e6e6e6 !important">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 p-b-10">
                            <div class="size-209 fl">
                                <span class="mtext-110 cl2">
                                    Thành tiền:
                                </span>
                            </div>

                            <div class="size-208 fl">
                                <span class="mtext-110 cl2">
                                    {{ number_format($total_after, 0,',','.') . ' ' . '₫' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l-4 m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-lr-40 m-lr-0-xl p-lr-15-sm">
                        <form>
                            @csrf
                            <h4 class="mtext-109 cl2 p-b-30">
                                Thông tin người nhận
                            </h4>

                            <div class="relative flex-w flex-t p-b-13">
                                <i class="icofont icofont-ui-user icon-right"></i>
                                <input type="text" class="form-control shipping_name" name="shipping_name" value="{{ Session::get('customer_name') }}" placeholder="Họ và tên">
                            </div>

                            <div class="relative flex-w flex-t p-b-13">
                                <i class="icofont icofont-iphone icon-right"></i>
                                <input type="text" class="form-control shipping_phone" name="shipping_phone" value="{{ Session::get('customer_phone') }}" placeholder="Số điện thoại">
                            </div>

                            <div class="relative flex-w flex-t p-b-13">
                                <i class="icofont icofont-address-book icon-right"></i>
                                <input type="text" class="form-control shipping_address" name="shipping_address" value="{{ Session::get('customer_address') }}" placeholder="Địa chỉ">
                            </div>

                            <div class="relative flex-w flex-t p-b-13">
                                <i class="icofont icofont-envelope icon-right"></i>
                                <input type="text" class="form-control shipping_email" name="shipping_email" value="{{ Session::get('customer_email') }}" placeholder="E-Mail">
                            </div>

                            <div class="relative flex-w flex-t p-b-13">
                                <textarea class="form-control shipping_notes" name="shipping_notes" cols="30" rows="6" placeholder="Ghi chú đơn hàng..."></textarea>
                            </div>

                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="{{ $cou['coupon_code'] }}">
                                @endforeach
                            @else
                                <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                            @endif

                            @if(Session::get('fee'))
                                @foreach(Session::get('fee') as $key => $fee)
                                    <input type="hidden" name="order_fee" class="order_fee" value="{{ $fee['fee_feeship'] }}">
                                @endforeach
                            @else
                                <input type="hidden" name="order_fee" class="order_fee" value="25000">
                            @endif

                            <select name="payment_select" class="m-b-15 form-control payment_select">
                                <optgroup label="Tiền mặt">
                                    <option value="1">Tiền mặt</option>
                                </optgroup>
                                <optgroup label="Thẻ">
                                     <option value="2">Thẻ ATM</option>
                                    <option value="3">Thẻ ghi nợ</option>
                                </optgroup>
                            </select>

                            {{-- @php
                                $vnd_to_usd = $total_after/23052;
                            @endphp
                            <div id="paypal-button"></div>
                            <input type="hidden" id="vnd_to_usd" value="{{ round($vnd_to_usd, 2) }}"> --}}

                            <button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer send_order" name="send_order">
                                Đặt hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    } else {
        Session::forget('coupon');
        Session::forget('fee');
        $url_link = route('product');
        echo '
            <div class="bg0 p-t-40 p-b-85">
                <div class="container">
                    <div class="row">
                        <p class="col fs-20 p-b-13">Giỏ hàng của bạn đang trống</p>
                    </div>
                    <div class="row">
                        <p class="col fs-15 p-b-13">Hiện tại không có sản phẩm nào. Quay lại <a
                                href="'.$url_link.'">cửa hàng</a> để tiếp tục mua sắm.</p>
                    </div>
                </div>
            </div>
        ';
    } ?>
@endsection

@push('js')
    <!-- Checkout -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.send_order').click(function () {

                swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn tiếp tục đặt không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Cảm ơn, đặt hàng!",
                    cancelButtonText: "Đóng, xem tiếp",
                    cancelButtonClass: "btn-danger",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                },

                function(isConfirm){
                    if (isConfirm) {
                        var shipping_name = $('.shipping_name').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_email = $('.shipping_email').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();

                        var order_coupon = $('.order_coupon').val();
                        var order_fee = $('.order_fee').val();
                        var _token = $('input[name="_token"]').val();

                        if (shipping_name=='') {
                            swal("", "Hãy bổ sung tên người đặt hàng!", "error");
                        }else if(shipping_phone==''){
                            swal("", "Hãy bổ sung số điện thoại!", "error");
                        }else if(shipping_address==''){
                            swal("", "Hãy bổ sung địa chỉ!", "error");
                        }else if(shipping_email==''){
                            swal("", "Hãy bổ sung địa chỉ E-Mail!", "error");
                        }else{
                            $.ajax({
                                url: '{{ route('confirm_order') }}',
                                method: 'POST',
                                data:{shipping_name:shipping_name, shipping_phone:shipping_phone, shipping_address:shipping_address,
                                    shipping_email:shipping_email, shipping_notes:shipping_notes, shipping_method:shipping_method,
                                    order_coupon:order_coupon, order_fee:order_fee, _token:_token},
                                success:function(){
                                    swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                                }
                            });

                            window.setTimeout(function(){
                                document.location.href = "{{ route('purchase') }}";
                            }, 5000);
                        }
                    } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                    }
                });
            });
        });
    </script>
@endpush
