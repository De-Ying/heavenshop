@push('css')

    <style>
        .stext-107{
            font-size: 1.4rem;
        }
    </style>

@endpush
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">

        {{-- @foreach ($app_contact as $contact)
            <div class="row">
                <div class="l-4 m-6 c-12 col p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Liên hệ
                    </h4>

                    <ul>
                        <li class="stext-107 p-b-10 cl7">
                            Cửa hàng: {{ $contact->contact_address }}
                        </li>

                        <li class="stext-107 p-b-10 cl7">
                            Liên hệ: {{ $contact->contact_phone  }}
                        </li>

                        <li class="stext-107 p-b-10 cl7">
                            Website: <a class="stext-107 cl7 hov-cl1 trans-04" target="_blank" href="http://heavenshop.vn/">http://heavenshop.vn/</a>
                        </li>

                        <li class="stext-107 p-b-10 cl7">
                            Facebook: <a class="stext-107 cl7 hov-cl1 trans-04" target="_blank" href="{{ $contact->contact_url_fanpage  }}">{{ $contact->contact_url_fanpage  }}</a>
                        </li>
                    </ul>
                </div>

                <div class="l-4 m-6 c-12 col p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Hỗ trợ
                    </h4>

                    <ul>
                        <li class="p-b-10">
                            <a href="{{ route('transport') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                Chính sách vận chuyển
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="{{ route('payment_guide') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                Hướng dẫn thanh toán
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="l-4 m-6 c-12 col p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Fanpage
                    </h4>
                    {!! $contact->contact_fanpage  !!}
                </div>
            </div>
        @endforeach --}}

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="{{ asset('public/frontend/images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('public/frontend/images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('public/frontend/images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('public/frontend/images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('public/frontend/images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());

                </script> Bản quyền © 2021 Bảo lưu mọi quyền | Mẫu này được tạo <i class="fa fa-heart-o"
                    aria-hidden="true"></i> bởi Sin Đăng.
            </p>
        </div>
    </div>
</footer>
