@extends('layout')

@push('css')
    <style>
        .bg-contact {
            background-image: url('public/frontend/images/bg-02.jpg');
        }
    </style>
@endpush

@section('main')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 bg-contact">
        <h2 class="ltext-105 cl0 txt-center">
            Liên hệ
        </h2>
    </section>

    <section class="bg0 p-t-104 p-b-50">
        <div class="container">
            <div class="flex-w">
                @foreach ($contacts as $contact)
                    <div class="bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                        {!! $contact->contact_map !!}
                    </div>

                    <div class="bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                        <div class="w-full flex-w p-b-42">
                            <span class="fs-18 cl5 txt-center size-211">
                                <span class="lnr lnr-map-marker"></span>
                            </span>

                            <div class="size-212 p-t-2">
                                <span class="mtext-110 cl2">
                                    Địa chỉ
                                </span>

                                <p class="stext-115 cl6 size-213 p-t-18">
                                    {{ $contact->contact_address }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full flex-w p-b-42">
                            <span class="fs-18 cl5 txt-center size-211">
                                <span class="lnr lnr-phone-handset"></span>
                            </span>

                            <div class="size-212 p-t-2">
                                <span class="mtext-110 cl2">
                                    Số điện thoại
                                </span>

                                <p class="stext-115 cl1 size-213 p-t-18">
                                    + {{ $contact->contact_phone }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full flex-w p-b-42">
                            <span class="fs-18 cl5 txt-center size-211">
                                <span class="lnr lnr-envelope"></span>
                            </span>

                            <div class="size-212 p-t-2">
                                <span class="mtext-110 cl2">
                                    E-Mail hỗ trợ
                                </span>

                                <p class="stext-115 cl1 size-213 p-t-18">
                                    <a href="mailto:'.{{ $contact->contact_email }}.'">{{ $contact->contact_email }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="w-full flex-w">
                            <span class="fs-18 cl5 txt-center size-211">
                                <i class="icofont icofont-social-friendfeed"></i>
                            </span>

                            <div class="size-212 p-t-2">
                                <span class="mtext-110 cl2">
                                    Fanpage
                                </span>

                                <p class="stext-115 cl1 size-213 p-t-18">
                                    <a href="{{ $contact->contact_url_fanpage }}" target="_blank">Fanpage Gucci Shop - Web bán hàng thời trang</a>
                                </p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
@endsection
