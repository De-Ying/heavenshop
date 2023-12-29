@extends('layout')

@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/details.css') !!}">
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/rating.css') !!}">
    @endpush

    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg fs-14">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('product') }}" class="stext-109 cl8 hov-cl1 trans-04">
                @lang('lang.product')
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('product_category_slug', [$category_slug]) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $breadcrumb_category }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $product_name }}
            </span>
        </div>
    </div>

    @foreach ($product_details as $item)
        <section class="sec-product-detail bg0 p-t-60 p-b-60">
            <div class="container">
                <div class="row">
                    <div class="col l-6 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w column-reverse">
                                <div class="wrap-slick3-dots m-t-30"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <!-- Gallery -->
                                    @foreach ($gallery as $gal)
                                        <div class="item-slick3"
                                            data-thumb="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">

                                            <div class="wrap-pic-w pos-relative">
                                                @if ($item->product_quantity > 0)
                                                    <div class="imgBox">
                                                        <img src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                                                            alt="{{ $gal->gallery_name }}"
                                                            data-origin="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                                                    </div>
                                                @else
                                                    <div class="imgBox">
                                                        <img src="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}"
                                                            alt="{{ $gal->gallery_name }}"
                                                            data-origin="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                                                        <span
                                                            style="position: absolute; opacity: 1; top: 15px; width: 120px; height: 120px; left: 10px;">
                                                            <img src="{{ asset('public/frontend/images/cart/sold-out.png') }}"
                                                                alt="#">
                                                        </span>
                                                    </div>
                                                @endif

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="{{ URL::to('public/uploads/gallery/' . $gal->gallery_image) }}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l-6 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="text-3xl mtext-105 cl2 js-name-detail p-b-14"
                                style="clear: both; padding-top: 10px; text-transform: uppercase">
                                {{ $item->product_name }}
                            </h4>

                            <div class="group-status">
                                <span class="first_status">
                                    <span class="a_name">Danh mục:</span>
                                    <span class="uppercase status_name">
                                        {{ $item->category->category_name }}
                                    </span>
                                    <span class="hidden-xs m-r-5 m-l-5">|</span>
                                </span>

                                <span class="first_status">
                                    <span class="a_name">Thương hiệu:</span>
                                    <span class="uppercase status_name">
                                        {{ $item->brand->brand_name }}
                                    </span>
                                    <span class="hidden-xs m-r-5 m-l-5">|</span>
                                </span>

                                <span class="first_status">
                                    <span class="a_name">Tình trạng:</span>
                                    <span class="status_name availabel">
                                        @if ($item->product_quantity > 0)
                                            Còn hàng
                                        @else
                                            Tạm thời hết hàng
                                        @endif
                                    </span>
                                </span>

                                <ul class="list-inline" style="display: flex;">
                                    @for ($count = 1; $count <= 5; $count++)
                                        @php
                                            if ($count <= $rating) {
                                                $color = '#ffcc00;';
                                            } else {
                                                $color = '#ccc;';
                                            }

                                        @endphp

                                        <li style="color: {{ $color }} font-size:20px;">&#9733;</li>
                                    @endfor
                                </ul>
                            </div>


                            <p class="product-price cl2 both">
                                {{ number_format($item->product_price, 0, ',', '.') . ' ' . '₫' }}
                            </p>

                            <p class="stext-102 cl3 p-t-23 ">
                                {!! $item->product_content !!}
                            </p>

                            <div class="p-t-33">
                                {{-- <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Size S</option>
                                                <option>Size M</option>
                                                <option>Size L</option>
                                                <option>Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next" style="width: calc(100% - 0px);">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <input type="hidden" class="product_quantity_{{ $item->product_id }}"
                                                value="{{ $item->product_quantity }}">

                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m fs-14">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num"
                                                min="1" id="num" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m fs-14">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        @if ($item->product_quantity > 0)
                                            <button
                                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                                style="height: 43px; border-radius: 3px;"
                                                onclick="multipleAddCart({{ $item->product_id }})">
                                                <i class="icofont icofont-cart-alt f-16"
                                                    style="font-size: 17px; margin-right: 5px;"></i> Thêm giỏ hàng
                                            </button>
                                        @else
                                            <button
                                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                                style="height: 43px; border-radius: 3px;"
                                                onclick="return swal('Sản phẩm tạm thời hết hàng')">
                                                <i class="icofont icofont-cart-alt f-16"
                                                    style="font-size: 17px; margin-right: 5px;"></i> Thêm giỏ hàng
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-m p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>

                            <div class="flex-w flex-m p-t-40 respon7 fs-14">
                                <i class="fa fa-tags"></i> Tags:
                                @php
                                    $tags = $item->product_tags;
                                    $tags = explode(',', $tags);
                                @endphp

                                @foreach ($tags as $tag)
                                    <a href="{{ route('product_tag', ['product_tags' => str_slug($tag)]) }}"
                                        class="tags m-lr-5">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bor10 m-t-50 p-t-43 p-b-40">
                    <div class="tab01">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item p-b-10">
                                <a class="nav-link active" data-toggle="tab" href="#reviews" role="tab"
                                    style="font-family: Roboto,sans-serif;">Đánh giá ({{ $comment }})</a>
                            </li>

                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#description" role="tab"
                                    style="font-family: Roboto,sans-serif;">Mô tả sản phẩm</a>
                            </li>
                        </ul>

                        <div class="tab-content p-t-43">
                            <div class="tab-pane fade" id="description" role="tabpanel">
                                <div class="how-pos2 p-lr-15-md">
                                    <p class="stext-102 cl6">
                                        {!! $item->product_description !!}
                                    </p>
                                </div>
                            </div>

                            <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-10 col-md-8 col-lg-8 m-lr-auto">
                                        <div class="p-b-30 m-lr-15-sm">
                                            <form class="w-full m-b-20">
                                                <h5 class="mtext-108 cl2 p-b-7">
                                                    Viết đánh giá của bạn
                                                </h5>

                                                <p class="stext-102 cl6">
                                                    Hãy đánh giá ( &#9733; ) để chúng tôi thấy sự phản hồi tích cực từ bạn.
                                                </p>

                                                <div class="flex-w p-t-20 p-b-23 ratingAc" style="flex-direction: column">
                                                    {{-- @if (Session::get('customer_id'))
                                                        <ul class="list-inline rating" style="display: flex;">
                                                            @for ($count = 1; $count <= 5; $count++)
                                                                @php
                                                                    if ($count <= $rating) {
                                                                        $color = '#ffcc00;';
                                                                    } else {
                                                                        $color = '#ccc;';
                                                                    }
                                                                @endphp

                                                                <li title="star_rating"
                                                                    id="{{ $item->product_id }}-{{ $count }}"
                                                                    data-index="{{ $count }}"
                                                                    data-product_id="{{ $item->product_id }}"
                                                                    data-customer_id="{{ Session::get('customer_id') }}"
                                                                    data-rating="{{ $rating }}" class="rating"
                                                                    style="cursor:pointer; color: {{ $color }} font-size:20px;">
                                                                    &#9733;
                                                                </li>
                                                            @endfor
                                                            <li style="padding: 3px; margin-left: 5px; font-size: 1.4rem">
                                                                ({{ $counter }})
                                                            </li>
                                                        </ul>
                                                    @else
                                                        @for ($count = 1; $count <= 5; $count++)
                                                            @php
                                                                if ($count <= $rating) {
                                                                    $color = '#ffcc00;';
                                                                } else {
                                                                    $color = '#ccc;';
                                                                }
                                                            @endphp

                                                            <li onclick="confirmRating()" class=""
                                                                style="cursor:pointer; color: {{ $color }} font-size:20px;">
                                                                &#9733;</li>
                                                        @endfor
                                                    @endif --}}

                                                    <div id="cate-rating" class="cate-rating">
                                                        <div class="stars">
                                                            @if (Session::get('customer_id'))
                                                                @for ($count = 1; $count <= 5; $count++)
                                                                    @php
                                                                        if ($count <= $rating) {
                                                                            $color = '#ffcc00';
                                                                        } else {
                                                                            $color = '';
                                                                        }
                                                                    @endphp

                                                                    <a id="star-{{ $count }}"
                                                                        data-product_id="{{ $item->product_id }}"
                                                                        data-customer_id="{{ Session::get('customer_id') }}"
                                                                        class="star">
                                                                        <span class="fa fa-star" style="color: {{ $color }}"></span>
                                                                    </a>
                                                                @endfor

                                                                <p class="starText" style="display: inline-block;
                                                                font-size: 1.4rem;
                                                                vertical-align: text-bottom; margin-left: 15px"></p>
                                                            @else
                                                                @for ($count = 1; $count <= 5; $count++)
                                                                    <a id="star-{{ $count }}"
                                                                        onclick="confirmRating()" class="star">
                                                                        <span class="fa fa-star"></span></a>
                                                                @endfor
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <hr style="border:1px solid #eee">

                                                    <div class="row">
                                                        <div class="col l-10">
                                                            <div class="row">
                                                                <div class="m-12 col l-12 c-12">
                                                                    <div class="side">
                                                                        <div>5 sao</div>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <div class="bar-container progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentStar5 }}%; height: 15px;"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="side right">
                                                                        <div>({{ $star5 }})</div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-12 col l-12 c-12">
                                                                    <div class="side">
                                                                        <div>4 sao</div>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <div class="bar-container progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentStar4 }}%; height: 15px;"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="side right">
                                                                        <div>({{ $star4 }})</div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-12 col l-12 c-12">
                                                                    <div class="side">
                                                                        <div>3 sao</div>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <div class="bar-container progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentStar3 }}%; height: 15px;"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="side right">
                                                                        <div>({{ $star3 }})</div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-12 col l-12 c-12">
                                                                    <div class="side">
                                                                        <div>2 sao</div>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <div class="bar-container progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentStar2 }}%; height: 15px;"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="side right">
                                                                        <div>({{ $star2 }})</div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-12 col l-12 c-12">
                                                                    <div class="side">
                                                                        <div>1 sao</div>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <div class="bar-container progress">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentStar1 }}%; height: 15px;"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="side right">
                                                                        <div>({{ $star1 }})</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col l-2" style="display: flex; flex-direction: column;">
                                                            <div class="totalStar">{{ $ratingScope }}</div>

                                                            <p style="font-size: 13px;" class="m-tb-10">{{ $ratingScope }} trung bình dựa trên
                                                                {{ $counter }} đánh giá.</p>
                                                        </div>

                                                    </div>
                                                </div>

                                                @if (Session::get('customer_id'))
                                                    <div class="row p-b-25">
                                                        <div class="col-12 p-b-20">
                                                            <label class="stext-102 cl3" for="review"
                                                                style="font-size: 16px">Nội dung bình luận</label>
                                                            <textarea
                                                                class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10 comment_content"
                                                                id="comment_content" name="comment_content"
                                                                style="height: 170px"></textarea>
                                                        </div>
                                                        <div class="col-12"
                                                            style="border-bottom: 1px solid gainsboro;">
                                                            <span style="float: left; font-size: 17px"
                                                                class="m-r-15 m-tb-6 counter_comment"
                                                                id="counter_comment"></span>
                                                            <div class="dropdown" style="float: left">
                                                                <select class="form-control comment_date select2">
                                                                    <option value="" selected>--- Lọc ---</option>
                                                                    <option id="7days" value="7days">7 ngày trước</option>
                                                                    <option id="30days" value="30days">1 tháng trước</option>
                                                                    <option id="60days" value="60days">2 tháng trước</option>
                                                                </select>
                                                            </div>

                                                            <button type="button"
                                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-30 send-comment"
                                                                style="float: right">
                                                                <i
                                                                    class="loading-icon fa fa-spinner m-r-5 fa-spin hide"></i>
                                                                <span class="btn-txt">
                                                                    Bình luận
                                                                </span>
                                                            </button>

                                                            <button type="reset"
                                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-30 m-r-5"
                                                                style="float: right">
                                                                <span>
                                                                    Hủy bỏ
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row p-b-25">
                                                        <div class="col-12 p-b-20">
                                                            <label class="stext-102 cl3" for="review"
                                                                style="font-size: 16px">Nội dung đánh giá</label>
                                                            <textarea
                                                                class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10 comment"
                                                                id="comment" name="comment" style="height: 170px" readonly
                                                                onclick="confirmComment()"></textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>

                                            <form>
                                                @csrf
                                                <input type="hidden" class="comment_product_id" name="comment_product_id"
                                                    value="{{ $item->product_id }}">
                                                <input type="hidden" class="comment_customer_id" name="comment_customer_id"
                                                    value="{{ Session::get('customer_id') }}">
                                                @if ($comment > 0)
                                                    <div class="flex-w flex-t p-b-50" id="load_comment">

                                                    </div>
                                                @else
                                                    <div class="flex-w flex-t p-b-50 fs-14">
                                                        <p>Hiện tại chưa có bình luận ! Bạn hãy là người đầu tiên bình luận
                                                            sản phẩm. <i class="ti-hand-point-down"></i></p>
                                                    </div>
                                                @endif

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endforeach

    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Sản phẩm liên quan
                </h3>
            </div>

            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($product_related as $product)
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

                                    <a href="{{ route('product_detail', ['product_slug' => $product->product_slug]) }}">
                                        <div class="block2-pic hov-img0">
                                            <img style="height: auto;"
                                                class="wishlist_product_image_{{ $product->product_id }}"
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
    </section>
@endsection

@push('js')

    <!-- Load comment -->
    <script type="text/javascript">
        $(document).ready(function() {
            // 1. Load comment
            comment_load();

            function comment_load() {
                var product_id = $('.comment_product_id').val();
                var customer_id = $('.comment_customer_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('load_comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        customer_id: customer_id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#load_comment').html(data);
                    }
                });
            }

            $('.comment_date').change(function() {
                var product_id = $('.comment_product_id').val();
                var customer_id = $('.comment_customer_id').val();
                var comment_date = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('load_comment_date') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        customer_id: customer_id,
                        comment_date: comment_date,
                        _token: _token
                    },

                    success: function(data) {
                        $('#load_comment').html(data);
                    }
                });
            });

            // 2. Send comment
            $('.send-comment').click(function() {
                $('.loading-icon').removeClass('hide');
                $('.send-comment').attr('disabled', true);
                $('.btn-txt').text('Gửi đánh giá ...');

                var comment_content = $('.comment_content').val();
                var product_id = $('.comment_product_id').val();
                var customer_id = $('.comment_customer_id').val();
                var _token = $('input[name="_token"]').val();

                if (comment_content == '') {
                    $('.comment_content').css('color', '#B94A48');
                    $('.comment_content').css('background-color', '#F2DEDE');
                    $('.comment_content').css('border', '1px solid red');
                    $('.btn-txt').text('Bình luận');
                    $('.send-comment').attr('disabled', false);
                    $('.loading-icon').addClass('hide');

                    $('.comment_content').keyup(function() {
                        $('.comment_content').css('color', '#000000');
                        $('.comment_content').css('background-color', '#ffffff');
                        $('.comment_content').css('border', '1px solid #e6e6e6');
                    });
                } else {
                    $.ajax({
                        url: '{{ route('send_comment') }}',
                        method: 'POST',
                        data: {
                            comment_content: comment_content,
                            product_id: product_id,
                            customer_id: customer_id,
                            _token: _token
                        },

                        success: function(data) {
                            setTimeout(function() {
                                $('.ratingAc').show();
                                $('.loading-icon').addClass('hide');
                                $('.send-comment').attr('disabled', false);
                                $('.btn-txt').text('Gửi đánh giá');
                                swal("Hoàn tất!", "Bài đánh giá đang chờ duyệt ...",
                                    "success");
                                comment_load();
                                $('.comment_content').val('');
                            }, 3000);
                        }
                    });
                }
            });

            comment_counter();

            function comment_counter() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('counter_comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#counter_comment').html(data);
                        comment_load();
                    }
                });
            }



        });
    </script>

    <script>

        function thumbs_like(comment_id) {
            var product_id = $('.comment_product_id').val();
            var customer_id = $('.comment_customer_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('thumbs_like') }}',
                method: 'POST',
                data: {
                    comment_id: comment_id,
                    product_id: product_id,
                    customer_id: customer_id,
                    _token: _token
                },

                success: function(data) {
                    toastr.success('👍', 'Success');
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 1000)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error('Bạn đã thích bình luận này', 'Error');
                }
            });
        }

        function thumbs_dislike(comment_id) {
            var product_id = $('.comment_product_id').val();
            var customer_id = $('.comment_customer_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('thumbs_dislike') }}',
                method: 'POST',
                data: {
                    comment_id: comment_id,
                    product_id: product_id,
                    customer_id: customer_id,
                    _token: _token
                },

                success: function(data) {
                    toastr.success('👎', 'Success');
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 1000)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error('Bạn đã bỏ thích bình luận này', 'Error');
                }
            });
        }
    </script>

    <script>
        function thumbs_admin_like(comment_id) {
            var product_id = $('.comment_product_id').val();
            var admin_id = $('.admin_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('thumbs_admin_like') }}',
                method: 'POST',
                data: {
                    comment_id: comment_id,
                    product_id: product_id,
                    admin_id: admin_id,
                    _token: _token
                },
                success: function(data) {
                    toastr.success('👍', 'Success');
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 1000)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error('Bạn đã thích bình luận này', 'Error');
                }
            });
        }

        function thumbs_admin_dislike(comment_id) {
            var product_id = $('.comment_product_id').val();
            var admin_id = $('.admin_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('thumbs_admin_dislike') }}',
                method: 'POST',
                data: {
                    comment_id: comment_id,
                    product_id: product_id,
                    admin_id: admin_id,
                    _token: _token
                },

                success: function(data) {
                    toastr.success('👎', 'Success');
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 1000)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error('Bạn đã bỏ thích bình luận này', 'Error');
                }
            });
        }
    </script>

    <script src="{{ asset('public/frontend/js/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        function confirmComment() {
            swal({
                    title: "Hãy đăng nhập?",
                    text: "Để thực hiện chức năng bình luận sản phẩm!",
                    icon: "warning",
                    cancelText: "Huỷ",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Chuyển hướng",
                    buttons: ["Hủy", "Đăng nhập"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Chấp thuận! Đang chuyển hướng tới trang đăng nhập!", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            document.location.href = '{{ route('buyer.login') }}';
                        }, 1000);
                    } else {
                        swal("Từ chối đăng nhập");
                    }
                });
        }
    </script>

    <script>
        function confirmRating() {
            swal({
                    title: "Hãy đăng nhập?",
                    text: "Để thực hiện chức năng đánh giá sản phẩm!",
                    icon: "warning",
                    cancelText: "Huỷ",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Chuyển hướng",
                    buttons: ["Hủy", "Đăng nhập"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Chấp thuận! Đang chuyển hướng tới trang đăng nhập!", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            document.location.href = '{{ route('buyer.login') }}';
                        }, 1000);
                    } else {
                        swal("Từ chối đăng nhập");
                    }
                });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            /*
             * Hiệu ứng khi rê chuột lên ngôi sao
             */
            $('a.star').mouseenter(function() {
                if ($('#cate-rating').hasClass('rating-ok') == false) {

                    var eID = $(this).attr('id');
                    eID = eID.split('-').splice(-1);
                    $('a.star').removeClass('vote-active');

                    for (var i = 1; i <= eID; i++) {
                        if (i == 1) {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("Kinh khủng");
                        } else if (i == 2) {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("Tồi tệ");
                        } else if (i == 3) {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("Trung bình");
                        } else if (i == 4) {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("Tốt");
                        } else if (i == 5) {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("Xuất sắc");
                        } else {
                            $('#star-' + i).addClass('vote-hover');
                            $(".starText").text("");
                        }
                    }
                }
            }).mouseleave(function() {
                if ($('#cate-rating').hasClass('rating-ok') == false) {
                    $('a.star').removeClass('vote-hover');
                    $(".starText").text( "");
                }
            });

            /*
             * Sự kiện khi cho điểm
             */
            $('a.star').click(function() {
                if ($('#cate-rating').hasClass('rating-ok') == false) {
                    var eID = $(this).attr('id');
                    eID = eID.split('-').splice(-1).toString();
                    var customer_id = $(this).data('customer_id');
                    var product_id = $(this).data('product_id');

                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: '{{ route('insert_rating') }}',
                        method: 'POST',
                        data: {
                            eID: eID,
                            customer_id: customer_id,
                            product_id: product_id,
                            _token: _token
                        },
                        success: function(data) {
                            swal("Bạn đã đánh giá " + eID + " trên 5");

                            for (var i = 1; i <= eID; i++) {
                                $('#star-' + i).addClass('vote-active');
                            }

                            $('#cate-rating').addClass('rating-ok');

                            setTimeout(function() {
                                location.reload();
                            }, 1000)
                        },
                        error: function(data) {
                            swal("Thất bại", "Bạn đã đánh giá sản phẩm này!", "error");
                        }
                    });
                }
            });
        });
    </script>

    {{-- <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }

        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');

            remove_background(product_id);

            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);

            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var customer_id = $(this).data('customer_id');
            var product_id = $(this).data('product_id');

            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('insert_rating') }}',
                method: 'POST',
                data: {
                    index: index,
                    customer_id: customer_id,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    swal("Bạn đã đánh giá " + index + " trên 5");

                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                },
                error: function(data) {
                    swal("Thất bại", "Bạn đã đánh giá sản phẩm này!", "error");
                }
            });
        });
    </script> --}}
@endpush
