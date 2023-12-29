@extends('layout')
@section('main')
    <style>
        .accordion {
            background-color: #ffffff;
            color: #444;
            cursor: pointer;
            padding: 10px 0 5px 0;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
            border-bottom: 1px solid #000000;
        }

        .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }
        .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }

        p {
            font-family: "Montserrat", sans-serif;
        }

        .border-b {
            border-bottom: 1px solid #dddddd;
        }

        .boder-tb {
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
        }

        td {
            padding: 5px 0;
        }
    </style>

    <div class="container">
        <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Hình thức thanh toán
            </span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="m-12 col l-3 c-12 m-t-20 m-b-50">
                <ul class="uppercase">
                    <li class="p-b-5 fs-12"><a class="text-666" href="{{ route('transport') }}">Vận chuyển</a></li>
                    <li class="p-b-5 fs-12"><a class="payment-link text-666" href="{{ route('payment_guide') }}">Hình thức thanh toán</a></li>
                </ul>
            </div>

            <div class="m-12 col l-9 c-12 m-t-20 m-b-50">
                <h4 class="uppercase text-bold m-b-20">Hình thức thanh toán</h4>

                <button class="uppercase accordion">I. Thanh toán trả trước</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">Thẻ ATM (thẻ ngân hàng, thẻ thanh toán nội địa), thẻ tín dụng và thẻ thanh toán quốc
                        tế (Visa, Master, JCB, Amex…)
                        <br><br>
                        Quý khách thanh toán trực tiếp tại hệ thống thanh toán trên website sau khi hoàn tất đơn hàng. Hệ
                        thống thanh toán điện tử của HEAVEN được kết nối với cổng thanh toán điện tử NAPAS. Theo đó, các
                        tiêu chuẩn bảo mật thanh toán của HEAVEN đảm bảo tuân thủ theo các tiêu chuẩn bảo mật của NAPAS, đã
                        được Ngân hàng nhà nước Việt Nam thẩm định về độ an toàn bảo mật và cấp phép hoạt động chính thức.
                    </p>
                </div>

                <button class="uppercase accordion">II. Thanh toán trả sau (COD)</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">
                        Là hình thức khách hàng thanh toán tiền mặt trực tiếp cho nhân viên vận chuyển khi nhận hàng.
                        <br><br>
                        Khi hàng được chuyển giao đến bạn có thể kiểm tra tình trang gói hàng còn nguyên vẹn và mở gói hàng
                        kiểm tra sản phẩm trước khi thanh toán. Nếu sản phẩm có bất kỳ lỗi hay khiếm khuyết nào không đúng ý
                        muốn, bạn có thể trả lại nhân viên vận chuyển ngay tại thời điểm đó.
                    </p>
                </div>

                <button class="uppercase accordion">III. Hoàn tiền</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">Đối với thanh toán trước, HEAVEN sẽ hoàn tiền cho bạn trong những trường hợp sau:</p>
                    <ol class="m-l-30">
                        <li class="list-style-initial">Bạn hủy đơn hàng khi HEAVEN chưa đến bước vận chuyển và muốn nhận lại tiền đã thanh toán qua thẻ.</li>
                        <li class="list-style-initial">Bạn muốn trả lại hàng do lỗi sản xuất và không muốn đổi sang sản phẩm khác.</li>
                    </ol>
                    <p class="m-b-10">CANIFA sẽ hoàn tiền lại vào tài khoản cá nhân của bạn. Chúng tôi sẽ cố gắng hoàn tiền nhanh nhất có thể và thời gian hoàn tiền không quá 15 ngày tính từ khi xác nhận hoàn tiền.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>

    <script type="text/javascript">
        const currentLocationPayment = location.href;
        const payment = document.querySelectorAll('.payment-link');
        const paymentLength = payment.length;
        for (let i = 0; i < paymentLength; i++) {
            if (payment[i].href === currentLocationPayment) {
                payment[i].className = "payment-link-active";
            }
        }
    </script>
@endpush
