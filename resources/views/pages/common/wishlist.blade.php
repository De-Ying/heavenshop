<div class="wrap-header-wishlist js-panel-wishlist">
    <div class="s-full js-hide-wishlist"></div>

    <div class="header-wishlist flex-col-l p-l-65 p-r-25">
        <div class="header-wishlist-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Danh sách yêu thích
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wishlist">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-wishlist-content flex-w js-pscroll">
            <ul class="w-full header-wishlist-wrapitem">
                {{-- @if ($app_wishlist->count() > 0)
                    @foreach ($app_wishlist as $wishlist)
                        <li class="header-wishlist-item flex-w flex-t m-b-30">
                            <div class="header-wishlist-item-img" data-del_id="{{ $wishlist->wishlist_id }}" data-product_name="{{ $wishlist->product->product_name }}">
                                <img src="{{ url('public/uploads/product/'.$wishlist->product->product_image) }}" alt="IMG">
                            </div>

                            <div class="header-wishlist-item-txt">
                                <a href="{{ route('product_detail', ['product_slug' => $wishlist->product->product_slug]) }}" class="header-wishlist-item-name m-b-10 hov-cl1 trans-04">
                                    {{ $wishlist->product->product_name }}
                                </a>
                            </div>

                            <div class="p-t-8">

                            </div>
                        </li>
                    @endforeach
                    <div class="justify-center w-full header-cart-buttons flex-w p-t-50">
                        <a href="{{ route('wishlist') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Danh sách yêu thích
                        </a>
                    </div>
                @else
                    <li class="header-wishlist-item flex-w flex-t m-b-12 fs-14">
                        Sản phẩm yêu thích đang rỗng
                    </li>
                @endif --}}
            </ul>
        </div>
    </div>
</div>
