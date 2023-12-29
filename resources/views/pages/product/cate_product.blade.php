@extends('layout')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/filter.css') !!}">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
    @endpush

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

            <span class="uppercase stext-109 cl4 text-red">
                {{ $breadcrumb_category }}
            </span>
        </div>
    </div>

    <div class="bg0 m-t-30 p-b-140">
        <div class="container">
            <div class="row">

                @include('pages.common.filter')

                <div class="col l-10 c-12">
                    <div class="row p-b-25">
                        <div class="col l-12 text-end">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle orderBtn" type="button" data-toggle="dropdown">@lang('lang.arrange')
                                </button>
                                <ul class="dropdown-menu" style="min-width: 13.5rem;">
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=default">@lang('lang.default')</a></li>
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=alpha-asc">A → Z</a></li>
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=alpha-desc">Z → A</a></li class="p-tb-5">
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=price-asc">@lang('lang.rising-prices')</a></li class="p-tb-5">
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=price-desc">@lang('lang.falling-prices')</a></li class="p-tb-5">
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=created-asc">@lang('lang.latest-goods')</a></li class="p-tb-5">
                                  <li class="p-tb-5"><a class="text-black-33 m-l-10 sort-link fs-14" href="?sortBy=created-desc">@lang('lang.oldest-goods')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row isotype">

                        @foreach ($products as $product)
                            <div class="m-6 col l-2-4 lg-4 c-12 p-b-35 p-tb-8">
                                <div class="block2">
                                    <form>
                                        @csrf
                                        <input type="hidden" class="customer_id_{{ $product->product_id }}" value="{{ Session::get('customer_id') }}">
                                        <input type="hidden" value="{{ $product->product_quantity }}"
                                            class="product_quantity_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->product_name }}"
                                            class="wishlist_product_name_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ number_format($product->product_price, 0,',','.') . ' ' . '₫' }}"
                                            class="wishlist_product_price_{{ $product->product_id }}">

                                        <a class="wishlist_product_url_{{ $product->product_id }}" href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}">
                                            <div class="block2-pic hov-img0">
                                                <img
                                                    class="wishlist_product_img wishlist_product_image_{{ $product->product_id }}"
                                                    src="{{ url('public/uploads/product/' . $product->product_image) }}"
                                                    alt="{{ $product->product_name }}">

                                                <a href="#"
                                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick-view"
                                                    onclick="quickView({{ $product->product_id }})" data-toggle="modal"
                                                    data-target="#xemnhanh">
                                                    Xem nhanh
                                                </a>

                                                <button type="button" class="icon-cart add-to-cart" name="add-to-cart"
                                                    onclick="simpleAddCart({{ $product->product_id }})">
                                                    <i class="fa fa-cart-plus cc_pointer cart-plus-icon"></i>
                                                </button>

                                                @if (Session::get('customer_id'))

                                                    <button type="button" class="icon-wishlist add-to-wishlist"
                                                        name="add-to-wishlist"
                                                        onclick="addWishList({{ $product->product_id }})">
                                                        <i class="fa fa-heart"></i>
                                                    </button>

                                                @else

                                                    <button type="button" class="icon-wishlist add-to-wishlist"
                                                        name="add-to-wishlist" onclick="checkWishList()">
                                                        <i class="fa fa-heart"></i>
                                                    </button>

                                                @endif
                                            </div>
                                        </a>
                                    </form>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="flex-col-l">
                                            <a href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}"
                                                class="uppercase stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $product->product_name }}
                                            </a>

                                            <span class="stext-105 cl3" style="font-family: system-ui;">
                                                {{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="justify-center row m-t-50 fs-10 product-link">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('pages.common.modal')
@endsection

@push('js')

    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.classList.toggle("caret-down");
            });
        }
    </script>

@endpush
