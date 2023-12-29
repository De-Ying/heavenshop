<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: pink;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: pink;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 50px;
            font-size: 85%;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white,
        .btn.btn-white.disabled,
        .btn.btn-white.disabled:focus,
        .btn.btn-white.disabled:hover,
        .btn.btn-white[disabled],
        .btn.btn-white[disabled]:focus,
        .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        .pull-right {
            float: right
        }

        .pull-left {
            float: left
        }

        .fa.pull-left {
            margin-right: .3em
        }

        .fa.pull-right {
            margin-left: .3em
        }

    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <div class="invoice-company text-inverse f-w-600">
                    <img src="https://i.postimg.cc/L69mN1CC/2.png" alt="HEAVEN SHOP">
                </div>

                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>Từ</small>
                        <address style="font-style: normal">
                            <strong class="text-inverse">HEAVEN SHOP</strong><br>
                            126 Lê Lợi<br>
                            Hà Đông, Hà Nội<br>
                            Số điện thoại: (033) 261-8488<br>
                            E-Mail: heavenshopx69@gmail.com
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>Đến</small>
                        <address style="font-style: normal">
                            <strong class="text-inverse">
                                @if ($shipping_array['shipping_name'] == '')
                                    Không có
                                @else
                                    <span>{{ $shipping_array['shipping_name'] }}</span>
                                @endif
                            </strong>
                            <br>
                            @if ($shipping_array['shipping_address'] == '')
                                Không có
                            @else
                                <span>{{ $shipping_array['shipping_address'] }}</span>
                            @endif
                            <br>
                            Số điện thoại:
                            @if ($shipping_array['shipping_phone'] == '')
                                Không có
                            @else
                                <span>{{ $shipping_array['shipping_phone'] }}</span>
                            @endif
                            <br>
                            E-Mail:
                            @if ($shipping_array['shipping_email'] == '')
                                Không có
                            @else
                                <span>{{ $shipping_array['shipping_email'] }}</span>
                            @endif
                            <br>
                            Hình thức thanh toán:
                            <strong class="text-white uppercase">
                                @if ($shipping_array['shipping_method'] == 1)
                                    Tiền mặt
                                @elseif ($shipping_array['shipping_method'] == 2)
                                    Thẻ ATM
                                @elseif ($shipping_array['shipping_method'] == 3)
                                    Thẻ ghi nợ
                                @endif
                            </strong>
                            <br>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Hóa đơn</small>
                        <div class="date text-inverse m-t-5">August 3,2012</div>
                        <div class="invoice-detail">
                            #{{ $code_mail['order_code'] }}<br>
                            Dịch vụ: Đặt hàng trực tuyến
                        </div>
                    </div>
                </div>

                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice" style="
                    width: 100%;
                    max-width: 100%;
                    min-height: .01%;
                    overflow-x: auto;
                    margin: 25px 0 20px 0;">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                    <th>Sản phẩm</th>
                                    <th class="text-center" width="10%">Giá tiền</th>
                                    <th class="text-center" width="10%">Số lượng đặt</th>
                                    <th class="text-right" width="20%">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 1;
                                    $subTotal = 0;
                                    $total = 0;
                                @endphp

                                @foreach ($cart_array as $cart)
                                    @php
                                        $subTotal = $cart['product_sales_quantity'] * $cart['product_price'];
                                        $total += $subTotal;
                                    @endphp

                                    <tr>
                                        <td
                                            style="text-align: center; padding: 10px 8px; line-height: 1.4; vertical-align: top; border-top: 1px solid #ddd;">
                                            {{ $stt++ }}
                                        </td>
                                        <td
                                            style="text-align: center; padding: 10px 8px; line-height: 1.4; vertical-align: top; border-top: 1px solid #ddd;">
                                            {{ $cart['product_name'] }}
                                        </td>
                                        <td
                                            style="text-align: center; padding: 10px 8px; line-height: 1.4; vertical-align: top; border-top: 1px solid #ddd;">
                                            {{ number_format($cart['product_price'], 0, ',', '.') }} ₫
                                        </td>
                                        <td
                                            style="text-align: center; padding: 10px 8px; line-height: 1.4; vertical-align: top; border-top: 1px solid #ddd;">
                                            {{ $cart['product_sales_quantity'] }}
                                        </td>
                                        <td
                                            style="text-align: center; padding: 10px 8px; line-height: 1.4; vertical-align: top; border-top: 1px solid #ddd;">
                                            {{ number_format($subTotal, 0, ',', '.') }} ₫
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>TỔNG TIỀN PHỤ</small>
                                    <span class="text-inverse">{{ number_format($total, 0, ',', '.') }} ₫</span>
                                </div>

                                @foreach ($coupon_array as $cou)
                                    @if ($cou['coupon_condition'] == 1)
                                        @php
                                            $total_coupon = ($total * $cou['coupon_number']) / 100;
                                            $total_after_coupon = $total_coupon;
                                        @endphp

                                        @if ($total_after_coupon > 0)
                                            <div class="sub-price">
                                                <img src="https://i.postimg.cc/Bv5YghXz/minus-sign.png" alt="">
                                            </div>
                                            <div class="sub-price">
                                                <small>PHÍ KHUYẾN MÃI</small>
                                                <span
                                                    class="text-inverse">{{ number_format($total_after_coupon, 0, ',', '.') }}
                                                    ₫</span>
                                            </div>
                                        @else

                                        @endif

                                    @elseif($cou['coupon_condition'] == 2)
                                        @php
                                            $total_after_coupon = $cou['coupon_number'];
                                        @endphp

                                        @if ($total_after_coupon > 0)
                                            <div class="sub-price">
                                                <img src="https://i.postimg.cc/Bv5YghXz/minus-sign.png" alt="">
                                            </div>
                                            <div class="sub-price">
                                                <small>PHÍ KHUYẾN MÃI</small>
                                                <span
                                                    class="text-inverse">{{ number_format($total_after_coupon, 0, ',', '.') }}
                                                    ₫</span>
                                            </div>
                                        @else

                                        @endif

                                    @endif
                                @endforeach

                                @php
                                    $total_after_fee = $total + $code_mail['fee_ship'];
                                @endphp

                                <div class="sub-price">
                                    <img src="https://i.postimg.cc/RFrtNGgP/add.png" alt="">
                                </div>
                                <div class="sub-price">
                                    <small>PHÍ VẬN CHUYỂN</small>
                                    <span
                                        class="text-inverse">{{ number_format($code_mail['fee_ship'], 0, ',', '.') }}
                                        ₫</span>
                                </div>

                            </div>
                        </div>
                        <div class="invoice-price-right">
                            @php
                                $total_after = $total_after_fee - $total_after_coupon;
                            @endphp

                            <small>Thành tiền</small>
                            <span
                                class="f-w-600">{{ number_format($total_after, 0, ',', '.') }} ₫
                            </span>
                        </div>
                    </div>
                </div>
                <div class="invoice-note">
                    * Thanh toán tất cả séc cho HEAVEN SHOP<br>
                    * Thanh toán đến hạn trong vòng 30 ngày<br>
                    * Nếu bạn có bất kỳ câu hỏi nào liên quan đến hóa đơn này, hãy liên hệ với <br>
                    [ Tên: Nguyễn Đức Anh, Số điện thoại: 0332618488, Email: sin2k.dev@gmail.com ]
                </div>
                <div class="invoice-footer">
                    <p class="f-w-600" style="font-size: 13px">
                        Cảm ơn quý khách đã đặt hàng shop chúng tôi
                    </p>
                    <p class="text-center">
                        <span style="margin-right: 5px; font-size: 13px">
                            <a class="font-bold text-darkmagenta" target="_blank"
                                href="http://www.guccishop.com/guccishop/">
                                <img src="https://i.postimg.cc/MT9JT3DR/global.png" alt="#"> Heaven Shop
                            </a>
                        </span>
                        <span style="margin-right: 5px; font-size: 13px">☎ 0332618888</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
