@extends('layout')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/filter.css') !!}">
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

            <a href="" class="stext-109 cl8 hov-cl1 trans-04">
                Tag
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $tag }}
            </span>
        </div>
    </div>

    <div class="bg0 m-t-30 p-b-80">
        <div class="container">
            <div class="row isotype">
                <div class="col l-12">

                    @foreach ($product_tag as $tags)

                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                            <div class="block2">
                                <form>
                                    @csrf
                                    <input type="hidden" class="customer_id_{{ $product->product_id }}" value="{{ Session::get('customer_id') }}">
                                    <input type="hidden" value="'.$product->product_quantity.'"
                                        class="product_quantity_{{ $tags->product_id }}">
                                    <input type="hidden" value="{{ $tags->product_name }}"
                                        class="wishlist_product_name_{{ $tags->product_id }}">
                                    <input type="hidden" value="{{ number_format($tags->product_price,0,',','.') . ' ' . '₫' }}"
                                        class="wishlist_product_price_{{ $tags->product_id }}">

                                    <a class="wishlist_product_url_{{ $tags->product_id }}" href="{{ route('product_detail', ['product_slug' => $tags->product_slug]) }}">
                                        <div class="block2-pic hov-img0">
                                            <img class="wishlist_product_image_{{ $tags->product_id }}"
                                            src="{{ url('public/uploads/product/'.$tags->product_image) }}" alt="{{ $tags->product_name }}">

                                            <a href="#"
                                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick-view"
                                                onclick="quickView({{ $tags->product_id }})" data-toggle="modal" data-target="#xemnhanh">
                                                Xem nhanh
                                            </a>

                                            <button type="button" class="icon-cart add-to-cart" name="add-to-cart"
                                                onclick="simpleAddCart({{ $tags->product_id }})">
                                                <i class="fa fa-cart-plus cc_pointer cart-plus-icon"></i>
                                            </button>

                                            @if (Session::get('customer_id'))
                                                <button type="button" class="icon-wishlist add-to-wishlist"
                                                    name="add-to-wishlist"
                                                    onclick="addWishList({{ $tags->product_id }})">
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
                                    <div class="block2-txt-child1 flex-col-l">
                                        <a href="{{ route('product_detail', ['product_slug' => $tags->product_slug]) }}"
                                                class="uppercase stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $tags->product_name }}
                                        </a>

                                        <span class="stext-105 cl3" style="font-family: system-ui;">
                                            {{ number_format($tags->product_price,0,',','.') . ' ' . '₫' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                    <div class="justify-center row m-t-50 fs-10 product-link">
                        {{ $product_tag->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.modal')
@endsection


