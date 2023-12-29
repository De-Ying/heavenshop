<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Font awesome -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/font-awesome/css/font-awesome.min.css') !!}">
    <style>
        .coupon {
            border: 5px dotted #bbb; /* Dotted border */
            width: 80%;
            border-radius: 15px; /* Rounded border */
            margin: 0 auto; /* Center the coupon */
            max-width: 600px;
        }

        .container {
            padding: 2px 16px;
            background-color: #f1f1f1;
        }

        .promo {
            background: #ccc;
            padding: 3px;
        }

        a{
            text-decoration: none;
            color: hotpink;
        }

        b{
            text-transform: capitalize;
            font-style: italic;
            text-decoration: underline;
        }

        a:hover{
            color: red;
        }

        .expire{
            display: inline-block;
            text-transform: capitalize;
        }

        #blue{
            color: blue;
        }

        #red{
            color: red;
        }

    </style>
</head>
<body>
    <div class="coupon">
        <div class="container">
            <h3><img src='https://i.postimg.cc/59BxJM3x/HERM-S01.png' alt='HERM-S01'/></h3>
        </div>

        <img src='https://i.postimg.cc/QNFTJmpL/sales.jpg' width="100%" alt='sales'/>

        <div class="container" style="background-color:white">
            <h2>
                @if ($coupon['coupon_condition'] == 1)
                    <b>Giảm {{ $coupon['coupon_number'] }}% cho tổng đơn hàng trên 3 triệu</b>
                @else
                    <b>Giảm {{ number_format($coupon['coupon_number'],0,',','.') }}VNĐ cho tổng đơn hàng trên 3 triệu</b>
                @endif

            </h2>
            <p style="font-size: 17px">
                Quý khách đã từng mua hàng tại shop <a target="_blank" href="http://gucci.com/">Gucci.com</a> nếu đã có tài khoản xin vui lòng
                đăng nhập vào tài khoản để mua hàng và nhập mã code giảm giá phía dưới để được
                giảm giá khi mua hàng. Xin cảm ơn quý khách, chúc quý khách một ngày tốt lành.
            </p>
        </div>

        <div class="container">
            <p>
                Mã Code: <span class="promo">{{ $coupon['coupon_code'] }}</span> / SL: Còn {{ $coupon['coupon_time'] }} mã giảm.
            </p>
            <p><i class="fa fa-paragraph"></i> Hãy nhanh tay để sử dụng mã khuyến mãi đặc biệt hấp dẫn .</p>
            <p class="expire">Ngày bắt đầu: <span id="blue">{{ $coupon['coupon_start_date'] }}</span></p> - <p class="expire">Ngày hết hạn: <span id="red">{{ $coupon['coupon_end_date'] }}</span></p>
        </div>
    </div>
</body>
</html>
