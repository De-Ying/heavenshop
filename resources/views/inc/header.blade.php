@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/fonts/iconic/css/material-design-iconic-font.min.css') }}">
@endpush

<header class="header">

    {!! Toastr::message() !!}

    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="container h-full flex-sb-m">
                <div class="left-top-bar">
                    @lang('lang.slogan')
                </div>

                <ul class="h-full right-top-bar flex-w">
                    <li>
                        <a href="#" class="flex-c-m trans-04 p-lr-25 stb-separate">
                            @lang('lang.help&FAQs')
                        </a>
                    </li>

                    <?php
                        $customer_id = Session::get('customer_id');
                        if ($customer_id != null) { ?>
                            <li>
                                <a href="{{ route('account.profile') }}" class="flex-c-m trans-04 p-lr-25 stb-separate">
                                    @lang('lang.my-account')
                                </a>
                            </li>
                    <?php } else { ?>
                            <li>
                                <a href="{{ route('buyer.login') }}" class="flex-c-m trans-04 p-lr-25 stb-separate">
                                    @lang('lang.login')
                                </a>
                            </li>
                    <?php }
                    ?>

                    <li>
                        <a href="{{ url('lang/vi') }}" class="flex-c-m trans-04 p-lr-25 stb-separate">
                            VI
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('lang/en') }}" class="flex-c-m trans-04 p-lr-25 stb-separate etb-separate">
                            EN
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="container limiter-menu-desktop">

                <!-- Logo desktop -->
                <a href="{{ route('home_page') }}" class="logo">
                    <img src="{{ asset('public/frontend/images/icons/HeavyShopGif.gif') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{ route('home_page') }}" class="menu-link">@lang('lang.home')</a>
                        </li>

                        <li class="label1" data-label1="hot">
                            <a href="{{ route('product') }}" class="menu-link">@lang('lang.product')</a>
                        </li>

                        <li>
                            <a href="{{ route('coupon') }}" class="menu-link">@lang('lang.coupon')</a>
                        </li>

                        <li>
                            <a href="{{ route('blog') }}" class="menu-link">@lang('lang.blog')</a>
                        </li>

                        <li>
                            <a href="{{ route('about') }}" class="menu-link">@lang('lang.about')</a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}" class="menu-link">@lang('lang.contact')</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <?php
                        $numberCart = 0;
                        if(Session::get('cart')){
                            foreach (Session::get('cart') as $key => $val) {
                                $numberCart ++;
                            }
                        }
                    ?>

                    <div class="wrap m-r-20">
                        <form class="search" action="{{ route('search') }}" method="GET" autocomplete="off">
                            <input type="search" name="keyword" class="keywords" placeholder="Nhập dữ liệu tìm kiếm" pattern=".*\S.*" required>
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <div id="search_ajax" style="position: relative; display: none"></div>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="{{ $numberCart }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    {{-- @if ($app_wishlist->count() > 0)
                        @php
                            $count_wishlist = $app_wishlist->count();
                        @endphp

                        <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-wishlist">
                            <strong id="notify_wishList">
                                <span class="icon-header-noti" data-notify="{{ $count_wishlist }}"></span>
                            </strong>

                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    @else
                        <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-wishlist">
                            <strong id="notify_wishList">
                                <span class="icon-header-noti" data-notify="0"></span>
                            </strong>

                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    @endif --}}

                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('home_page') }}"><img src="{{ asset('public/frontend/images/icons/HeavyShopGif.gif') }}"
                    alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <?php
                $numberCart = 0;
                if(Session::get('cart')){
                    foreach (Session::get('cart') as $key => $val) {
                        $numberCart ++;
                    }
                }
            ?>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="{{ $numberCart }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-10 p-r-11 js-show-wishlist">
                <strong id="notify_wishList">
                    <span class="icon-header-noti" data-notify="0"></span>
                </strong>

                <i class="zmdi zmdi-favorite-outline"></i>
            </a>

            <div class="btn-show-search-mobie btn-search-mobie">
                <i class="fa fa-search btn-search-mobie__icon"></i>
            </div>


        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    @lang('lang.slogan')
                </div>
            </li>

            <li>
                <div class="h-full right-top-bar flex-w">
                    <a href="#" class="flex-c-m p-r-10 trans-04">
                        @lang('lang.help&FAQs')
                    </a>

                    <?php
                        $customer_id = Session::get('customer_id');
                        if ($customer_id != null) { ?>
                        <a href="#" class="flex-c-m trans-04 p-lr-10 stb-separate">
                            @lang('lang.my-account')
                        </a>
                    <?php } else { ?>
                        <a href="#" class="flex-c-m trans-04 p-lr-10 stb-separate">
                            @lang('lang.login')
                        </a>
                    <?php }
                    ?>

                    <a href="{{ url('lang/vi') }}" class="flex-c-m trans-04 p-lr-10 stb-separate">
                        VI
                    </a>

                    <a href="{{ url('lang/en') }}" class="flex-c-m trans-04 stb-separate p-lr-10">
                        EN
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ route('home_page') }}" class="menu-link">@lang('lang.home')</a>
            </li>

            <li class="label1" data-label1="hot">
                <a href="{{ route('product') }}" class="menu-link">@lang('lang.product')</a>
            </li>

            <li>
                <a href="{{ route('coupon') }}" class="menu-link">@lang('lang.coupon')</a>
            </li>

            <li>
                <a href="{{ route('blog') }}" class="menu-link">@lang('lang.blog')</a>
            </li>

            <li>
                <a href="{{ route('about') }}" class="menu-link">@lang('lang.about')</a>
            </li>

            <li>
                <a href="{{ route('contact') }}" class="menu-link">@lang('lang.contact')</a>
            </li>
        </ul>
    </div>

    <div class="search-mobile" style="display: none">
        <form class="search" action="{{ route('search') }}" method="GET" autocomplete="off">
            <input type="search" name="keyword" class="keywords" placeholder="Nhập dữ liệu tìm kiếm" pattern=".*\S.*" required>
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <div id="search_ajax" style="position: relative;"></div>
    </div>

</header>


