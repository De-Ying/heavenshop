@extends('layout')
@section('main')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('http://heavenshop.vn/public/frontend/images/bg-01.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Thông tin
        </h2>
    </section>

    <style>
        .stext-113{
            font-family: Roboto,sans-serif;
            font-size: 16px;
        }
    </style>

    <section class="bg0 p-t-75 p-b-80">
        <div class="container">
            <div class="row p-b-148">
                <div class="col l-7 m-7 c-12">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            Giới thiệu
                        </h3>

                        <p class="stext-113 cl6 p-b-26">
                            HEAVEN SHOP <br>

                            Với niềm tin luôn mang đến những sản phẩm với chất lượng tốt nhất <br>

                            Và sự tinh tế trong từng sản phẩm mà chúng tôi mang lại <br>

                            Sẽ đáp ứng được trải nghiệm nhu cầu mua sắm của tất cả quý khách hàng <br>

                            TRÂN TRỌNG  ...
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            ------------------- <br>

                            HEAVEN SHOP <br>

                            Cửa hàng: 126 Lê Lợi, P. Nguyễn Trãi, Hà Đông, Hà Nội<br>

                            Liên hệ: + (033) 261-8888 <br>

                            Website: http://heavenshop.vn/ <br>

                            Facebook: https://www.facebook.com/heaven.unio69 <br>
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            Bạn có câu hỏi nào không? Hãy cho chúng tôi biết tại cửa hàng tại địa chỉ 177 Tổ 6, P.Mộ Lao, Q.Hà Đông, TP.Hà Nội hoặc gọi cho chúng tôi theo số + (033) 261-8888
                        </p>
                    </div>
                </div>

                <div class="m-5 col l-4">
                    <div class="how-bor1">
                        <div class="hov-img0">
                            <img src="{{ asset('public/frontend/images/about-01.jpg') }}" alt="IMG">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
