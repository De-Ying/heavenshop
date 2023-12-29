@extends('layout')

@section('main')
    <section class="section-slide hide-on-mobile-tablet p-b-50">
        <div class="wrap-slick1 rs1-slick1">
            <div class="slick1">
                @foreach ($sliders as $slider)
                    <div class="item-slick1"
                        style="background-image: url({{ asset('public/uploads/slider/' . $slider->slider_image) }})">
                        <div class="container h-full">
                            <div class="h-full flex-col-l-m p-t-100 p-b-30">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        {{ $slider->slider_name }}
                                    </span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {!! $slider->slider_description !!}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href="{{ route('product') }}"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Mua sắm ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-banner bg0 p-t-30">
        <div class="container">
            <div class="row">
                @foreach ($banners as $banner)
                    <div class="m-6 col l-4 c-12 p-b-16">
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset('public/uploads/slider/' . $banner->slider_image) }}" alt="IMG-BANNER">
                            <a href="{{ route('product') }}"
                                class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        {{ $banner->slider_name }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04">
                                        {!! $banner->slider_description !!}
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Mua sắm ngay
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="sec-product bg0 p-b-50">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Tổng quan về cửa hàng
                </h3>
            </div>

            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#new-product" role="tab">Sản phẩm mới</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#featured-product" role="tab">Sản phẩm nổi bật</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#selling-product" role="tab">Sản phẩm bán chạy</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-50">
                    <div class="tab-pane fade show active" id="new-product" role="tabpanel">
                        <!-- Slide2 -->
                        <div class="wrap-slick2">
                            <div class="slick2">
                                @foreach ($new_product as $product)
                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <form>
                                                @csrf
                                                <input type="hidden" class="customer_id_{{ $product->product_id }}"
                                                    value="{{ Session::get('customer_id') }}">
                                                <input type="hidden" value="{{ $product->product_quantity }}"
                                                    class="product_quantity_{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_name }}"
                                                    class="wishlist_product_name_{{ $product->product_id }}">
                                                <input type="hidden"
                                                    value="{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}"
                                                    class="wishlist_product_price_{{ $product->product_id }}">


                                                <a
                                                    href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}">
                                                    <div class="block2-pic hov-img0">
                                                        <img style="height: auto;"
                                                            class="wishlist_product_image_{{ $product->product_id }}"
                                                            src="{{ url('public/uploads/product/' . $product->product_image) }}"
                                                            alt="{{ $product->product_name }}">

                                                        <a href="#"
                                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick-view"
                                                            onclick="quickView({{ $product->product_id }})"
                                                            data-toggle="modal" data-target="#xemnhanh">
                                                            Xem nhanh
                                                        </a>

                                                        <button type="button" class="icon-cart add-to-cart"
                                                            name="add-to-cart"
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
                                                <div class="block2-txt-child1 flex-col-l ">
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
                        </div>
                    </div>

                    <div class="tab-pane fade" id="featured-product" role="tabpanel">
                        <!-- Slide2 -->
                        <div class="wrap-slick2">
                            <div class="slick2">
                                @foreach ($featured_product as $product)
                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <form>
                                                @csrf
                                                <input type="hidden" class="customer_id_{{ $product->product_id }}"
                                                    value="{{ Session::get('customer_id') }}">
                                                <input type="hidden" value="{{ $product->product_quantity }}"
                                                    class="product_quantity_{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_name }}"
                                                    class="wishlist_product_name_{{ $product->product_id }}">
                                                <input type="hidden"
                                                    value="{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}"
                                                    class="wishlist_product_price_{{ $product->product_id }}">


                                                <a
                                                    href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}">
                                                    <div class="block2-pic hov-img0">
                                                        <img style="height: auto;"
                                                            class="wishlist_product_image_{{ $product->product_id }}"
                                                            src="{{ url('public/uploads/product/' . $product->product_image) }}"
                                                            alt="{{ $product->product_name }}">

                                                        <a href="#"
                                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick-view"
                                                            onclick="quickView({{ $product->product_id }})"
                                                            data-toggle="modal" data-target="#xemnhanh">
                                                            Xem nhanh
                                                        </a>

                                                        <button type="button" class="icon-cart add-to-cart"
                                                            name="add-to-cart"
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
                                                <div class="block2-txt-child1 flex-col-l ">
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
                        </div>
                    </div>

                    <div class="tab-pane fade" id="selling-product" role="tabpanel">
                        <!-- Slide2 -->
                        <div class="wrap-slick2">
                            <div class="slick2">
                                @foreach ($selling_product as $product)
                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <form>
                                                @csrf
                                                <input type="hidden" class="customer_id_{{ $product->product_id }}"
                                                    value="{{ Session::get('customer_id') }}">
                                                <input type="hidden" value="{{ $product->product_quantity }}"
                                                    class="product_quantity_{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_name }}"
                                                    class="wishlist_product_name_{{ $product->product_id }}">
                                                <input type="hidden"
                                                    value="{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}"
                                                    class="wishlist_product_price_{{ $product->product_id }}">

                                                <a
                                                    href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}">
                                                    <div class="block2-pic hov-img0">
                                                        <img style="height: auto;"
                                                            class="wishlist_product_image_{{ $product->product_id }}"
                                                            src="{{ url('public/uploads/product/' . $product->product_image) }}"
                                                            alt="{{ $product->product_name }}">

                                                        <a href="#"
                                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick-view"
                                                            onclick="quickView({{ $product->product_id }})"
                                                            data-toggle="modal" data-target="#xemnhanh">
                                                            Xem nhanh
                                                        </a>

                                                        <button type="button" class="icon-cart add-to-cart"
                                                            name="add-to-cart"
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
                                                <div class="block2-txt-child1 flex-col-l ">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-blog bg0 p-t-50 p-b-90">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Tin tức
                </h3>
            </div>

            <div class="row">
                <div class="owl-carousel">
                    @foreach ($posts as $post)
                        <div class="col l-4 p-b-40">
                            <div class="blog-item" style="width: 410px;">
                                <div class="hov-img0">
                                    <a href="">
                                        <img src="{{ asset('public/uploads/blog/'.$post->post_image) }}" alt="IMG-BLOG">
                                    </a>
                                </div>

                                <div class="p-t-15">
                                    <div class="stext-107 flex-w p-b-14">
                                        <span class="m-r-3">
                                            <span class="cl4">
                                                By
                                            </span>

                                            <span class="cl5">
                                                {{ $post->post_author }}
                                            </span>
                                        </span>

                                        <span>
                                            <span class="cl4">
                                                on
                                            </span>

                                            <span class="cl5">
                                                {{ date('M', strtotime($post->post_date)) }}  {{ date('d', strtotime($post->post_date)) }}, {{ date('Y', strtotime($post->post_date)) }}
                                            </span>
                                        </span>
                                    </div>

                                    <h4 class="p-b-12 blog-title">
                                        <a href="" class="mtext-101 cl2 hov-cl1 trans-04">
                                            {{ $post->post_title }}
                                        </a>
                                    </h4>

                                    <p class="stext-108 cl6 blog-desc">
                                        {!! $post->post_description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
