@extends('layout')

@push('css')
    <style>
        .bg-coupon {
            background-image: url('public/frontend/images/promotionpanel.jpg');
        }
    </style>
@endpush

@section('main')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 bg-coupon">
        <h2 class="ltext-105 cl0 txt-center">
            Khuyến mãi
        </h2>
    </section>

    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="p-0 row m-b-40">
                <div class="coupon-select col l-12 p-r-35 text-end">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle orderBtn" type="button" data-toggle="dropdown">Tình trạng mã
                        </button>
                        <ul class="dropdown-menu" style="min-width: 23rem;">
                          <li><a class="coupon-link" href="?status=due">Còn hạn</a></li>
                          <li><a class="coupon-link" href="?status=expired">Hết hạn</a></li>
                          <li><a class="coupon-link" href="?status=used">Đã sử dụng</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12" id="couponList">
                    @if ($coupons->count() > 0)
                        @foreach ($coupons as $coupon)
                            @if ($coupon->coupon_end_date >= $today)
                                <div class="card">
                                    <div class="image"><img src="{{ asset('public/frontend/images/discount.png') }}" width="150"></div>
                                    <div class="image2"><img src="{{ asset('public/frontend/images/discount.png') }}" width="150"></div>
                                    <h1>
                                        @if ($coupon->coupon_condition == 1)
                                            {{ $coupon->coupon_number }}% OFF
                                        @else
                                            {{ number_format($coupon->coupon_number, 0, ',','.') . 'đ' }}
                                        @endif
                                    </h1>
                                    <span class="d-block">On Everything</span><span class="d-block">Today</span>
                                    <div class="mt-4 coupon_code">
                                        <small>Mã nhập code :
                                            <p id="{{ $coupon->coupon_id }}" style="display: inline-block">{{ $coupon->coupon_code }}</p>
                                        </small>
                                        <a href="#" class="copy_coupon_{{ $coupon->coupon_id  }}" onclick="CopyToClipboard({{ $coupon->coupon_id }});"> Copy</a></div>
                                    <i class="coupon_date fs-14">{{ date('d', strtotime($coupon->coupon_start_date)) }}/{{ date('m', strtotime($coupon->coupon_start_date)) }} - {{ date('d', strtotime($coupon->coupon_end_date)) }}/{{ date('m', strtotime($coupon->coupon_end_date)) }}</i>
                                </div>
                            @else
                                <div class="card" style="background: darkgray">
                                    <span><img src="{{ asset('public/frontend/images/expired.jpg') }}" alt="" style="width: 41px;
                                        position: absolute;
                                        top: 10px;
                                        right: 10px;
                                        border-radius: 25px;"></span>
                                    <div class="image"><img src="{{ asset('public/frontend/images/discount.png') }}" width="150"></div>
                                    <div class="image2"><img src="{{ asset('public/frontend/images/discount.png') }}" width="150"></div>
                                    <h1>
                                        @if ($coupon->coupon_condition == 1)
                                            {{ $coupon->coupon_number }}% OFF
                                        @else
                                            {{ number_format($coupon->coupon_number, 0, ',','.') . 'đ' }}
                                        @endif
                                    </h1>
                                    <span class="d-block">On Everything</span><span class="d-block">Today</span>
                                    <div class="mt-4 coupon_code">
                                        <small>Mã nhập code : {{ $coupon->coupon_code }} </small>
                                    </div>

                                    <i class="coupon_date fs-14">{{ date('d', strtotime($coupon->coupon_start_date)) }}/{{ date('m', strtotime($coupon->coupon_start_date)) }} - {{ date('d', strtotime($coupon->coupon_end_date)) }}/{{ date('m', strtotime($coupon->coupon_end_date)) }}</i>
                                </div>
                            @endif

                        @endforeach
                    @else
                        <div class="fs-14">Hiện tại cửa hàng chưa có chương trình khuyến mãi...</div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="justify-center m-12 flex-w l-12 c-12 p-b-80 fs-14">
                    {!! $coupons->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
    function CopyToClipboard(id)
    {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        $('.copy_coupon_'+id).text("Copied");
        window.getSelection().removeAllRanges();
    }
    </script>
@endpush
