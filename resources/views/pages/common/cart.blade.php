<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Giỏ hàng của bạn
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <?php
            if(Session::get('cart') && count(Session::get('cart'))>0){
            $arr_cart = Session::get('cart');
        ?>
        <div class="header-cart-content flex-w js-pscroll">
            @php
                $total = 0;
            @endphp
            <ul class="w-full header-cart-wrapitem">
                @foreach ($arr_cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['num'];
                        $total += $subtotal;
                    @endphp

                    <li class="header-cart-item flex-w flex-t m-b-20">
                        <div class="header-cart-item-img" data-del_id="{{ $item['id'] }}">
                            <img src="{{ URL::to('public/uploads/product/' . $item['image']) }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="{{ route('product_detail', ['product_slug' => $item['slug']]) }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                {{ $item['name'] }}
                            </a>

                            <span class="header-cart-item-info">
                                {{ $item['num'] }} x {{ number_format($item['price'], 0,',','.') . ' ' . '₫' }}
                            </span>
                        </div>


                    </li>
                @endforeach
            </ul>

            <div class="w-full m-t-30">
                <div class="w-full header-cart-total p-b-5">
                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                            @if ($cou['coupon_condition'] == 1)

                                @php
                                    $total_coupon = ($total * $cou['coupon_number'])/100;
                                    $total_after_coupon = $total - $total_coupon;
                                @endphp

                                <span class="header-cart-item-name m-b-5 hov-cl1 trans-04">
                                    Mã giảm giá: {{ number_format($total_coupon, 0,',','.') }} <img src="{{ asset('public/frontend/images/cart/coupon.png') }}" alt="">
                                </span>

                            @elseif($cou['coupon_condition'] == 2)

                                <span class="header-cart-item-name m-b-5 hov-cl1 trans-04">
                                    Mã giảm giá: {{ number_format($cou['coupon_number'], 0,',','.') }} <img src="{{ asset('public/frontend/images/cart/coupon$.png') }}" alt="">
                                </span>

                                @php
                                    $total_coupon = $total - $cou['coupon_number'];
                                    $total_after_coupon = $total_coupon;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                </div>

                <div class="w-full header-cart-total p-b-5">
                    @if (Session::get('fee'))
                        @foreach(Session::get('fee') as $key => $fee)
                            @php
                                $total_after_fee = $total + $fee['fee_feeship'];
                            @endphp

                            <span class="header-cart-item-name m-b-5 hov-cl1 trans-04">
                                Phí ship: {{ number_format($fee['fee_feeship'], 0,',','.') }} <img src="{{ asset('public/frontend/images/cart/fee_feeship.png') }}" alt="">
                            </span>
                        @endforeach
                    @endif
                </div>

                @php
                    if (Session::get('fee') && !Session::get('coupon')) {
                        $total_after = $total_after_fee;
                    } elseif(!Session::get('fee') && Session::get('coupon')) {
                        $total_after = $total_after_coupon;
                    } elseif (Session::get('fee') && Session::get('coupon')) {
                        $total_after = $total_after_coupon;
                        $total_after = $total_after + $fee['fee_feeship'];
                    } elseif (!Session::get('fee') && !Session::get('coupon')) {
                        $total_after = $total;
                    }
                @endphp

                <div class="w-full header-cart-total p-b-40">
                    Thành tiền: {{ number_format($total_after, 0,',','.') . ' ' . '₫' }}
                </div>

                <div class="w-full header-cart-buttons flex-w">
                    <a href="{{ route('view_cart') }}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Giỏ hàng
                    </a>

                    <?php
                    $customer_id = Session::get('customer_id');
                    $shipping_id = Session::get('shipping_id');
                    if ($customer_id != NULL && $shipping_id == NULL) { ?>
                        <a href="{{ route('checkout') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Thanh toán
                        </a>
                    <?php } elseif($customer_id != NULL && $shipping_id != NULL) { ?>
                        <a href="{{ route('payment') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Thanh toán
                        </a>
                    <?php } else { ?>
                        <a href="{{ route('buyer.login') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Thanh toán
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
            }else{
        ?>
        <p class="fs-14">Giỏ hàng của bạn đang trống</p>
        <?php
            }
            ?>
    </div>
</div>
