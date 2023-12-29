@extends('layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/customs/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/customs/coupon.css') }}">
@endpush

@section('main')
    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('product') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Sản phẩm
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Giỏ hàng của bạn
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
                <div class="m-12 col l-8 c-12 m-b-50">
                    <div class="wrap-table-shopping-cart">
                        <form action="{{ route('update_all_num_cart') }}" method="POST">
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
                                            <div class="how-itemcart1 header-cart-item-img"
                                                data-del_id="{{ $item['id'] }}">
                                                <img src="{{ URL::to('public/uploads/product/' . $item['image']) }}"
                                                    alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-3">
                                            {{ number_format($item['price'], 0, ',', '.') . ' ' . '₫' }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <a href="{{ route('update_num_cart', ['product_id' => $item['id'], 'type' => 'minus']) }}"
                                                    class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m fs-14">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </a>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="cart_quantity[{{ $item['session_id'] }}]"
                                                    value="{{ $item['num'] }}">

                                                <a href="{{ route('update_num_cart', ['product_id' => $item['id'], 'type' => 'plus']) }}"
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
                                                    class="fa fa-times fs-12"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <button type="submit"
                                class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5"
                                style="font-family: Roboto,sans-serif; margin: 20px 0 0 40px;">
                                Cập nhật giỏ hàng
                            </button>
                        </form>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        @if (Session::get('customer_id'))
                            <form action="{{ route('check_coupon') }}" method="post">
                                @csrf
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 coupon"
                                        type="text" name="coupon" placeholder="Mã giảm giá" value="">

                                    <button type="submit"
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5 coupon"
                                        style="min-width: 0px">
                                        Áp dụng
                                    </button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('check_coupon') }}" method="post">
                                @csrf
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 coupon"
                                        type="text" name="coupon" placeholder="Mã giảm giá">

                                    <button type="button"
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5"
                                        onclick="CheckCouponLogin('{{ route('buyer.login') }}')" style="min-width: 0px">
                                        Áp dụng
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if (Session::get('coupon'))
                            <a href="{{ route('unset_coupon') }}"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 c-hover">
                                Xoá mã giảm giá
                            </a>
                        @endif

                        <button
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 c-hover"
                            onclick="confirmDeleteAll()">
                            Xoá toàn bộ giỏ hàng
                        </button>
                    </div>

                    <!-- Coupon -->
                    <div class="couponTip" style="background: #fff; width: 100%; margin-top: 10px">
                        <div class="row">
                            @foreach ($coupons as $coupon)
                            @if ($coupon->coupon_end_date >= $today)
                                <div class="m-6 col l-4 c-12">
                                    <div class="couponCard">
                                        <div class="main">
                                            <div class="co-img">
                                                <img src="{{ asset('public/backend/app-assets/images/icon/couponTip.png') }}"
                                                    alt="#"/>
                                            </div>
                                            <div class="vertical"></div>
                                            <div class="content">
                                                <h2>
                                                    {{ $coupon->coupon_name }}
                                                    <span class="coupon_time">{{ $coupon->coupon_time }}</span>
                                                </h2>
                                                <h1>
                                                    @if ($coupon->coupon_condition == 1)
                                                        {{ $coupon->coupon_number }} %
                                                    @elseif ($coupon->coupon_condition == 2)
                                                        <span style="font-size: 21px; color: #565656; font-weight: 600">{{ $coupon->coupon_number }} đ</span>
                                                    @endif

                                                    <span>Coupon</span>
                                                </h1>
                                                <p>Hiệu lực {{ \Carbon\Carbon::parse($coupon->coupon_end_date)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="copy-button">
                                            <input id="copyvalue_{{ $coupon->coupon_id }}" type="text" readonly value="{{ $coupon->coupon_code }}" />
                                            <button onclick="copyIt({{ $coupon->coupon_id }})" class="copybtn" id="copybtn_{{ $coupon->coupon_id }}">COPY</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- <div class="m-6 col l-4 c-12">
                                    <div class="couponCard" style="background-color: #eee">
                                        <div class="main">
                                            <div class="co-img">
                                                <img src="{{ asset('public/backend/app-assets/images/icon/couponTip.png') }}"
                                                    alt="#"/>
                                            </div>
                                            <div class="vertical"></div>
                                            <div class="content">
                                                <h2>{{ $coupon->coupon_name }}</h2>
                                                <h1>
                                                    @if ($coupon->coupon_condition == 1)
                                                        {{ $coupon->coupon_number }} %
                                                    @elseif ($coupon->coupon_condition == 2)
                                                        <span style="font-size: 21px; color: #565656; font-weight: 600">{{ $coupon->coupon_number }} đ</span>
                                                    @endif

                                                    <span>Coupon</span>
                                                </h1>
                                                <p>Hiệu lực {{ \Carbon\Carbon::parse($coupon->coupon_end_date)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="copy-button" style="background-color: #eee">
                                            <input id="copyvalue1" type="text" readonly value="{{ $coupon->coupon_code }}" style="background: #eee"/>
                                            <button onclick="copyIt()" class="copybtn">COPY</button>
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="m-12 col c-12 l-4 m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-30 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Tổng giỏ hàng
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Tổng tiền:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format($total, 0, ',', '.') . ' ' . '₫' }}
                                </span>
                            </div>
                        </div>

                        @if (Session::get('coupon'))
                            @foreach (Session::get('coupon') as $key => $cou)
                                @if ($cou['coupon_condition'] == 1)
                                    <div class="flex-w flex-t bor12 p-b-13">
                                        <div class="size-208">
                                            <span class="stext-110 cl2">
                                                Số % giảm:
                                            </span>
                                        </div>

                                        <div class="size-209">
                                            <span class="mtext-110 cl2">
                                                {{ $cou['coupon_number'] }} <img
                                                    src="{{ asset('public/frontend/images/icons/discount.png') }}">
                                            </span>
                                        </div>
                                    </div>


                                    @php
                                        $total_coupon = ($total * $cou['coupon_number']) / 100;
                                        $total_after_coupon = $total - $total_coupon;
                                    @endphp

                                    <div class="flex-w flex-t bor12 p-b-13">
                                        <div class="size-208">
                                            <span class="stext-110 cl2">
                                                Mã giảm:
                                            </span>
                                        </div>

                                        <div class="size-209">
                                            <span class="mtext-110 cl2">
                                                {{ number_format($total_coupon, 0, ',', '.') . ' ' . '₫' }}
                                            </span>
                                        </div>
                                    </div>
                                @elseif($cou['coupon_condition'] == 2)
                                    <div class="flex-w flex-t bor12 p-b-13">
                                        <div class="size-208">
                                            <span class="stext-110 cl2">
                                                Mã giảm:
                                            </span>
                                        </div>

                                        <div class="size-209">
                                            <span class="mtext-110 cl2">
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') . ' ' . '₫' }}
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                        $total_coupon = $total - $cou['coupon_number'];
                                        $total_after_coupon = $total_coupon;
                                    @endphp

                                @endif
                            @endforeach
                        @endif

                        @if (Session::get('fee'))
                            @foreach (Session::get('fee') as $key => $fee)

                                <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                    <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Vận chuyển:
                                        </span>
                                    </div>

                                    <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                        <p class="stext-111 cl6 p-t-2">
                                            Hãy chọn đơn vị trực thuộc để chúng tôi vận chuyển hàng
                                        </p>

                                        <div class="p-t-15">
                                            <span class="stext-112 cl8">
                                                Tính toán vận chuyển
                                            </span>

                                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                                <select class="js-select2 choose city" name="city" id="city">
                                                    <option value="">{{ $fee['city_name'] }}</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>

                                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                                <select class="js-select2 choose district" name="district" id="district">
                                                    <option>{{ $fee['district_name'] }}</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>

                                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                                <select class="js-select2 commune" name="commune" id="commune">
                                                    <option>{{ $fee['commune_name'] }}</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>

                                            <div class="flex-w">
                                                <button type="button"
                                                    class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer calculate_delivery"
                                                    name="calculate_delivery">
                                                    Xác nhận
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Vận chuyển:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <p class="stext-111 cl6 p-t-2">
                                        Hãy chọn đơn vị trực thuộc để chúng tôi vận chuyển hàng
                                    </p>

                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Tính toán vận chuyển
                                        </span>

                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <select class="js-select2 choose city" name="city" id="city">
                                                <option value="">Chọn tỉnh/thành phố</option>
                                                @foreach ($city as $c)
                                                    <option value="{{ $c->city_id }}">{{ $c->city_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <select class="js-select2 choose district" name="district" id="district">
                                                <option>Hãy chọn tỉnh/thành phố</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <select class="js-select2 commune" name="commune" id="commune">
                                                <option>Hãy chọn quận/huyện</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="flex-w">
                                            <button type="button"
                                                class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer calculate_delivery"
                                                name="calculate_delivery">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (Session::get('fee'))
                            @foreach (Session::get('fee') as $key => $fee)
                                @php
                                    $total_after_fee = $total + $fee['fee_feeship'];
                                @endphp
                                <div class="flex-w flex-t bor12 p-b-13">
                                    <div class="size-208" style="margin-top: 5px;">
                                        <span class="stext-110 cl2">
                                            Phí vận chuyển:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            {{ number_format($fee['fee_feeship'], 0, ',', ',') }} ₫
                                            <a href="{{ route('unset_delivery') }}" style="margin: 25px;width: 41px;"><i
                                                    class="fa fa-times"
                                                    style="width: 45px; text-align: center;"></i></a>
                                        </span>
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
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Thành tiền:
                                </span>
                            </div>
                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    {{ number_format($total_after, 0, ',', '.') . ' ' . '₫' }}
                                </span>
                            </div>
                        </div>


                        @if (Session::get('customer_id'))
                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                                onclick="window.location.href='{{ route('checkout') }}'">
                                Thanh toán
                            </button>
                        @else
                            <button type="button"
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                                onclick="CheckCheckoutLogin('{{ route('buyer.login') }}')">
                                Thanh toán
                            </button>
                        @endif

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
                <p class="col fs-15 p-b-13">Hiện tại không có sản phẩm nào. Quay lại <a href="' .$url_link . '">cửa hàng</a> để tiếp tục mua sắm.</p>
            </div>
        </div>
    </div>
    ';
    } ?>
@endsection

@push('js')
    <script type="text/javascript">
        $('.coupon').focus(function() {
            $('.couponTip').hide();

            var i = 0;

            $('.coupon').each(function() {
                if ($(this).is(':focus')) {
                    $($('.couponTip')[i]).show();
                }
                i++;
            })

            $(document).bind('focusin.couponTip click.couponTip', function(e) {
                if ($(e.target).closest('.couponTip, .coupon').length) return;
                $(document).unbind('.tip');
                $('.couponTip').fadeOut('medium');
            });
        });

        $('.couponTip').hide();
    </script>

    <script type="text/javascript">
        function copyIt(id){
            let copybtn = document.querySelector("#copybtn_" + id);

            let copyInput = document.querySelector('#copyvalue_' + id);

            copyInput.select();

            document.execCommand("copy");

            copybtn.textContent = "COPIED";

            setTimeout(function() {
                copybtn.textContent = "COPY";
            }, 3000)
        }
    </script>
@endpush
