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
                Vận chuyển
            </span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="m-12 col l-3 c-12 m-t-20 m-b-50">
                <ul class="uppercase fs-12">
                    <li class="p-b-5"><a class="transport-link text-666" href="{{ route('transport') }}">Vận chuyển</a></li>
                    <li class="p-b-5"><a class="text-666"href="{{ route('payment_guide') }}">Hình thức thanh toán</a></li>
                </ul>
            </div>

            <div class="m-12 col l-9 c-12 m-t-20 m-b-50">
                <h4 class="uppercase text-bold m-b-20">Vận chuyển</h4>

                <button class="uppercase accordion">1. Cước phí vận chuyển</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">Miễn phí giao hàng với tất cả đơn hàng có giá trị từ 499,000 vnđ trở lên tại tất cả
                        tỉnh thành trên
                        toàn quốc.<br><br>
                        Đối với những đơn hàng có giá trị dưới 499,000 vnđ, CANIFA áp dụng biểu phí giao hàng theo từng khu
                        vực được quy định dưới đây. Biểu phí này áp dụng từ 24/08/2017 cho đến khi có thay đổi.</p>

                    <table style="width: 100%;">
                        <tbody>
                            <tr class="boder-tb">
                                <td colspan="2" style="background: #fafafa;"><strong>HÀ NỘI</strong></td>
                            </tr>
                            <tr class="border-b">
                                <td>Đống Đa, Hoàn Kiếm, Ba Đình, Hai Bà Trưng, Cầu Giấy, Thanh Xuân</td>
                                <td style="width: 15%;">10.000đ</td>
                            </tr>
                            <tr>
                                <td>Hà Đông, Tây Hồ, Hoàng Mai, Long Biên, Bắc Từ Liêm, Nam Từ Liêm, Ba Vì, Chương Mỹ, Đan
                                    Phượng, Đông Anh, Gia Lâm, Hoài Đức, Mê Linh, Mỹ Đức, Phúc Thọ, Phú Xuyên, Quốc Oai, Sóc
                                    Sơn, Thạch Thất, Thanh Oai, Thanh Trì, Thường Tín, Ứng Hòa, Thị Xã Sơn Tây.</td>
                                <td style="width: 15%;">20.000đ</td>
                            </tr>
                            <tr class="boder-tb">
                                <td colspan="2" style="background: #fafafa;"><strong>TP HỒ CHÍ MINH</strong></td>
                            </tr>
                            <tr>
                                <td>Tất cả các quận</td>
                                <td style="width: 15%;">30.000đ</td>
                            </tr>
                            <tr class="boder-tb">
                                <td colspan="2" style="background: #fafafa;"><strong>ĐÀ NẴNG</strong></td>
                            </tr>
                            <tr>
                                <td>Tất cả các quận</td>
                                <td style="width: 15%;">30.000đ</td>
                            </tr>
                            <tr class="boder-tb">
                                <td colspan="2" style="background: #fafafa;"><strong>TẤT CẢ CÁC TỈNH THÀNH KHÁC</strong>
                                </td>
                            </tr>
                            <tr class="boder-b">
                                <td>Bắc Giang, Bắc Ninh, Hà Nam, Hải Dương, Hải Phòng, Hưng Yên, Hòa Bình, Nam Định, Phú
                                    Thọ, Thái Nguyên, Vĩnh Phúc, Hòa Bình,Bắc Kan, Lạng Sơn, Nghệ An, Ninh Bình, Quảng Ninh,
                                    Thái Bình, Thanh Hóa, Tuyên Quang, Yên Bái, Nghệ An</td>
                                <td style="width: 15%;">20.000đ</td>
                            </tr>
                            <tr>
                                <td>Điện Biên, Lào Cai, Hà Giang, Sơn La, Cao Bằng,Huế, Quảng Trị, Gia Lai, Đắc Lắc, Kom
                                    Tum, Đắc Nông, Phú Yên, Khánh Hòa, Hà Tình, Tiền Giang, Bến Tre, Tây Ninh, Đồng Tháp,
                                    Trà Vinh, Vĩnh Long, Đồng Nai, Bình Dương, Vũng Tàu, Long An, Quảng Bình, Quy Nhơn, Bình
                                    Thuận, Ninh Thuận, Bình Phước, Cần Thơ, Hậu Giang, Kiên Giang, An Giang, Long An, Sóc
                                    Trăng, Bạc Liêu, Cà Mau, Quảng Ngãi</td>
                                <td style="width: 15%;">30.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button class="uppercase accordion">2. THỜI GIAN VẬN CHUYỂN</button>
                <div class="panel m-t-10 fs-14">
                    <ol class="m-l-30">
                        <li class="list-style-initial">Hà Nội : giao hàng từ 1 đến 3 ngày kể từ khi hệ thống xác nhận qua
                            sms/email</li>
                        <li class="list-style-initial">Tuyến Đà Nẵng, TP.HCM: giao hàng trong vòng 3 ngày kể từ khi hệ thống
                            xác nhận qua sms/email.</li>
                        <li class="list-style-initial">Tất cả thành phố khác: giao hàng trong vòng từ 3- 7 ngày kể từ khi hệ
                            thống xác nhận qua sms/ email.</li>
                        <li class="list-style-initial">Thời gian giao hàng không tính thứ bảy, chủ nhật hay các ngày lễ tết.
                        </li>
                    </ol>
                </div>

                <button class="uppercase accordion">3. ĐƠN HÀNG ĐƯỢC GIAO TỐI ĐA MẤY LẦN ?</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">Đơn hàng được giao tối đa 3 lần (Nếu lần 1 đơn hàng giao không thành công, nhân viên
                        vận chuyển sẽ liên hệ lại bạn lần 2 sau 1-2 ngày làm việc kế tiếp . Như vậy sau 3 lần giao dịch
                        không thành công đơn hàng sẽ hủy).</p>
                </div>

                <button class="uppercase accordion">4. KIỂM TRA TÌNH TRẠNG ĐƠN HÀNG</button>
                <div class="panel m-t-10 fs-14">
                    <p class="m-b-10">Để kiểm tra thông tin hoặc tình trạng đơn hàng bạn vui lòng sử dụng MÃ ĐƠN HÀNG đã
                        được gửi trong
                        email xác nhận hoặc tin nhắn xác nhận để thông báo tới bộ phận Chăm sóc khách hàng (tổng đài miễn
                        phí cước gọi 1800 6061 nhánh 1).</p>
                </div>

                <button class="uppercase accordion">5. KHI NHẬN ĐƠN HÀNG CÓ ĐƯỢC XEM SẢN PHẨM TRƯỚC KHI THANH TOÁN
                    ?</button>
                <div class="panel m-t-10 fs-14">
                    <p>Bạn hoàn toàn có thể mở gói hàng kiểm tra sản phẩm trước khi thanh toán hoặc trước khi vận chuyển rời
                        đi.<br><br>
                        Trong trường hợp bạn gặp vấn đề phát sinh bạn liên hệ ngay đến chúng tôi 1800 6061 nhánh 1 để được
                        hỗ trợ kịp thời.</p>
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
        const currentLocationTransport = location.href;
        const transport = document.querySelectorAll('.transport-link');
        const transportLength = transport.length;
        for (let i = 0; i < transportLength; i++) {
            if (transport[i].href === currentLocationTransport) {
                transport[i].className = "transport-link-active";
            }
        }
    </script>
@endpush
