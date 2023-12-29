@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Dashboard')
@section('admin_content')

    <!-- BEGIN: SideNav-->
    @include('admin.theme.sidebar.dashboard')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <!--card stats start-->
                        <div id="card-stats" class="pt-0">
                            <div class="row">
                                <div class="col s12 m6 l6 xl3">
                                    <div
                                        class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <span class="mt-5 material-icons background-round fs-21 p-lr-16">
                                                        <i class="fa fa-cart-plus"></i>
                                                    </span>
                                                    <p>TỔNG SỐ ĐƠN HÀNG</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <h5 class="mb-0 white-text counter">{{ $totalOrder }}</h5>
                                                    <p class="no-margin">-</p>
                                                    <p>{{ $timer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div
                                        class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <span class="mt-5 material-icons background-round fs-21 p-lr-17">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <p>KHÁCH HÀNG</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <h5 class="mb-0 white-text counter">{{ $totalCustomer }}</h5>
                                                    <p class="no-margin">-</p>
                                                    <p>{{ $timer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div
                                        class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <span class="mt-5 material-icons background-round fs-20">
                                                        <i class="fa fa-bar-chart-o"></i>
                                                    </span>
                                                    <p>DOANH SỐ</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <div style="display: flex; margin-left: 30%; align-items: end">
                                                        <h5 class="mb-0 white-text counter m-r-5">{{ $percent }}</h5>
                                                        <span class="fs-20">%</span>
                                                    </div>
                                                    <p class="no-margin">-</p>
                                                    <p>{{ $timer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div
                                        class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <span class="mt-5 material-icons background-round fs-20 p-lr-20">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                    <p>LỢI NHUẬN</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <h5 class="mb-0 white-text counter">{{ $totalProfit }}</h5>
                                                    <p class="no-margin">-</p>
                                                    <p>{{ $timer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--card stats end-->
                        <!--yearly & weekly revenue chart start-->
                        <div id="sales-chart">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div id="revenue-chart" class="card animate fadeUp">
                                        <div class="card-content">
                                            <h4 class="mt-0 header">
                                                DOANH THU NĂM 2021
                                                <span class="ml-1 purple-text small text-darken-1 percent">
                                                </span>
                                                <a href="{{ route('statistic.sales.timer') }}"
                                                    class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Chi tiết</a>
                                            </h4>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="yearly-revenue-chart">
                                                        <div id="revenueChart" style="height: 415px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m8 l8">
                                    <div id="weekly-earning" class="card animate fadeUp">
                                        <div class="card-content">
                                            <h4 class="m-0 header">
                                                Lợi nhuận
                                                <span class="material-icons right grey-text lighten-3">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </span>
                                            </h4>
                                            <p class="no-margin grey-text lighten-3 medium-small">
                                                <span id="profit_start"></span> - <span id="profit_end"></span>
                                            </p>
                                            <h3 id="sumProfit">
                                                <span class="counter">0</span>
                                            </h3>

                                            <div class="center-align">
                                                <div id="profitChart" style="height: 292px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4">
                                    <div id="weekly-earning" class="card animate fadeUp">
                                        <div class="card-content">
                                            <h4 class="m-0 header">
                                                <span>
                                                    Đơn hàng
                                                </span>
                                                <span>
                                                    <a href="{{ route('m-order.manage_order') }}"
                                                        class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">
                                                        Chi tiết
                                                    </a>
                                                </span>
                                            </h4>
                                            <form>
                                                @csrf
                                                <div class="row">
                                                    <div class="col s12 m5 l5">
                                                        <div class="input-field">
                                                            <input type="text" name="order_status_from" id="order_status_from"
                                                                class="form-control datepicker" placeholder="Từ ngày">
                                                        </div>
                                                    </div>

                                                    <div class="col s12 m5 l5">
                                                        <div class="input-field">
                                                            <input type="text" name="order_status_to" id="order_status_to"
                                                                class="form-control datepicker" placeholder="Đến ngày">
                                                        </div>
                                                    </div>

                                                    <div class="col s12 m2 l2">
                                                        <button type="button" name="order_status_filter" id="order_status_filter"
                                                            class="btn-grd-inverse indigo waves-effect waves-light m-t-20">
                                                            <i class="fa fa-filter"></i>
                                                            Lọc</button>
                                                    </div>

                                                </div>
                                            </form>
                                            <div class="center-align">
                                                <div id="orderStatusChart" style="height: 315px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--yearly & weekly revenue chart end-->
                        <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
                        {{-- <div id="daily-data-chart">
                            <div class="row">
                                <div class="col s12 m4 l4">
                                    <div class="pt-0 pb-0 card animate fadeLeft">
                                        <div class="ml-2 dashboard-revenue-wrapper padding-2">
                                            <span
                                                class="mt-2 mr-2 new badge gradient-45deg-light-blue-cyan gradient-shadow">+
                                                42.6%</span>
                                            <p class="mt-2 mb-0">Members online</p>
                                            <p class="no-margin grey-text lighten-3">360 avg</p>
                                            <h5>3,450</h5>
                                        </div>
                                        <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                            <canvas id="custom-line-chart-sample-one" class="center"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4 animate fadeUp">
                                    <div class="pt-0 pb-0 card">
                                        <div class="ml-2 dashboard-revenue-wrapper padding-2">
                                            <span
                                                class="mt-2 mr-2 new badge gradient-45deg-purple-deep-orange gradient-shadow">+
                                                12%</span>
                                            <p class="mt-2 mb-0">Current server load</p>
                                            <p class="no-margin grey-text lighten-3">23.1% avg</p>
                                            <h5>+2500</h5>
                                        </div>
                                        <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                            <canvas id="custom-line-chart-sample-two" class="center"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4">
                                    <div class="pt-0 pb-0 card animate fadeRight">
                                        <div class="ml-2 dashboard-revenue-wrapper padding-2">
                                            <span class="mt-2 mr-2 new badge gradient-45deg-amber-amber gradient-shadow">+
                                                $900</span>
                                            <p class="mt-2 mb-0">Today's revenue</p>
                                            <p class="no-margin grey-text lighten-3">$40,512 avg</p>
                                            <h5>$ 22,300</h5>
                                        </div>
                                        <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                            <canvas id="custom-line-chart-sample-three" class="center"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
                        <!-- ecommerce product start-->
                        {{-- <div id="ecommerce-product">
                            <div class="row">
                                <div class="col s12 m4">
                                    <div class="card animate fadeLeft">
                                        <div class="card-content center">
                                            <h6 class="mb-0 card-title font-weight-400">Apple Watch</h6>
                                            <img src="{!! asset('public/backend/app-assets/images/cards/watch.png') !!}" alt="" class="responsive-img">
                                            <p><b>The Apple Watch</b></p>
                                            <p>One day only exclusive sale on our marketplace</p>
                                        </div>
                                        <div class="card-action border-non center">
                                            <a
                                                class="waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow">$
                                                999/-</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="card animate fadeUp">
                                        <div class="card-content center">
                                            <span class="card-title center-align">Music</span>
                                            <img src="{!! asset('public/backend/app-assets/images/cards/headphones-2.png') !!}" alt="" class="responsive-img">
                                        </div>
                                        <div class="pt-0 card-action">
                                            <p class="">Default Quality</p>
                                            <div class="chip">192kb <i class="close material-icons">close</i>
                                            </div>
                                            <div class="chip">320kb <i class="close material-icons">close</i>
                                            </div>
                                        </div>
                                        <div class="pt-0 card-action">
                                            <p class="">Save Video Quality</p>
                                            <div class="switch">
                                                <label> Off <input type="checkbox"> <span class="lever"></span> On
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="card animate fadeRight">
                                        <div class="card-content center">
                                            <h6 class="mb-0 card-title font-weight-400">iPhone</h6>
                                            <img src="{!! asset('public/backend/app-assets/images/cards/iphonec.png') !!}" alt="" class="responsive-img">
                                            <p><b>The Apple iPhone X</b></p>
                                            <p>One day only exclusive sale on our marketplace</p>
                                        </div>
                                        <div class="card-action border-non center">
                                            <a class="waves-effect waves-light btn gradient-45deg-red-pink box-shadow">$
                                                299/-</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ecommerce product end-->
                            <!-- ecommerce offers start-->
                            <div id="ecommerce-offer">
                                <div class="row">
                                    <div class="col s12 m3">
                                        <div
                                            class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 animate fadeUp">
                                            <div class="card-content center">
                                                <img src="{!! asset('public/backend/app-assets/images/icon/apple-watch.png') !!}"
                                                    class="width-40 border-round z-depth-5 responsive-img" alt="image">
                                                <h5 class="white-text lighten-4">50% Off</h5>
                                                <p class="white-text lighten-4">On apple watch</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m3">
                                        <div
                                            class="card gradient-shadow gradient-45deg-red-pink border-radius-3 animate fadeUp">
                                            <div class="card-content center">
                                                <img src="{!! asset('public/backend/app-assets/images/icon/printer.png') !!}"
                                                    class="width-40 border-round z-depth-5 responsive-img" alt="images">
                                                <h5 class="white-text lighten-4">20% Off</h5>
                                                <p class="white-text lighten-4">On Canon Printer</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m3">
                                        <div
                                            class="card gradient-shadow gradient-45deg-amber-amber border-radius-3 animate fadeUp">
                                            <div class="card-content center">
                                                <img src="{!! asset('public/backend/app-assets/images/icon/laptop.png') !!}"
                                                    class="width-40 border-round z-depth-5 responsive-img" alt="image">
                                                <h5 class="white-text lighten-4">40% Off</h5>
                                                <p class="white-text lighten-4">On apple macbook</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m3">
                                        <div
                                            class="card gradient-shadow gradient-45deg-green-teal border-radius-3 animate fadeUp">
                                            <div class="card-content center">
                                                <img src="{!! asset('public/backend/app-assets/images/icon/bowling.png') !!}"
                                                    class="width-40 border-round z-depth-5 responsive-img" alt="image">
                                                <h5 class="white-text lighten-4">60% Off</h5>
                                                <p class="white-text lighten-4">On any game</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ecommerce offers end-->
                            <!-- //////////////////////////////////////////////////////////////////////////// -->
                        </div> --}}
                        <!--end container-->
                    </div><!-- START RIGHT SIDEBAR NAV -->
                    <aside id="right-sidebar-nav">
                        <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
                            <div class="row">
                                <div class="slide-out-right-title">
                                    <div class="pt-1 pb-0 col s12 border-bottom-1">
                                        <div class="row">
                                            <div class="pr-0 col s2 center">
                                                <i class="material-icons vertical-text-middle"><a href="#"
                                                        class="sidenav-close">clear</a></i>
                                            </div>
                                            <div class="pl-0 col s10">
                                                <ul class="tabs">
                                                    <li class="p-0 tab col s4">
                                                        <a href="#messages" class="active">
                                                            <span>Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="p-0 tab col s4">
                                                        <a href="#settings">
                                                            <span>Settings</span>
                                                        </a>
                                                    </li>
                                                    <li class="p-0 tab col s4">
                                                        <a href="#activity">
                                                            <span>Activity</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-3 slide-out-right-body row">
                                    <div id="messages" class="pb-0 col s12">
                                        <div class="mb-0 border-none collection">
                                            <input class="mt-4 mb-2 header-search-input" type="text" name="Search"
                                                placeholder="Search Messages">
                                            <ul class="p-0 mb-0 collection right-sidebar-chat">
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Elizabeth Elliott</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Thank you</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">5.00 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-1.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Mary Adams</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Hello Boo</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">4.14 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-2.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Caleb Richards</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Hello Boo</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">4.14 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-3.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Caleb Richards</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Keny
                                                            !</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">9.00 PM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-4.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">June Lane</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Ohh
                                                            God</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">4.14 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-5.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Edward Fletcher</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Love
                                                            you</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">5.15 PM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-6.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Crystal Bates</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Can
                                                            we</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">8.00 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Nathan Watts</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Great!</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">9.53 PM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-8.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Willard Wood</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Do
                                                            it</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">4.20 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-1.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Ronnie Ellis</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Got
                                                            that</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">5.20 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-9.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Daniel Russell</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Thank you</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">12.00 AM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-10.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Sarah Graves</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Okay
                                                            you</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">11.14 PM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-off avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-11.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Andrew Hoffman</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">Can
                                                            do</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">7.30 PM</span>
                                                </li>
                                                <li class="pb-0 pl-5 collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar"
                                                    data-target="slide-out-chat">
                                                    <span class="avatar-status avatar-online avatar-50"><img
                                                            src="{!! asset('public/backend/app-assets/images/avatar/avatar-12.png') !!}" alt="avatar">
                                                        <i></i>
                                                    </span>
                                                    <div class="user-content">
                                                        <h6 class="line-height-0">Camila Lynch</h6>
                                                        <p class="pt-3 medium-small blue-grey-text text-lighten-3">
                                                            Leave it</p>
                                                    </div>
                                                    <span class="secondary-content medium-small">2.00 PM</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="settings" class="col s12">
                                        <p class="mt-8 mb-3 ml-5 setting-header font-weight-900">GENERAL SETTINGS</p>
                                        <ul class="border-none collection">
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Notifications</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input checked="" type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Show recent activity</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Show recent activity</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Show Task statistics</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Show your emails</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Email Notifications</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input checked="" type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <p class="mb-3 ml-5 setting-header mt-7 font-weight-900">SYSTEM SETTINGS</p>
                                        <ul class="border-none collection">
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>System Logs</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Error Reporting</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Applications Logs</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input checked="" type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Backup Servers</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-none collection-item">
                                                <div class="m-0">
                                                    <span>Audit Logs</span>
                                                    <div class="switch right">
                                                        <label>
                                                            <input type="checkbox">
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="activity" class="col s12">
                                        <div class="activity">
                                            <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
                                            <ul class="mb-0 widget-timeline">
                                                <li class="timeline-items timeline-icon-green active">
                                                    <div class="timeline-time">Today</div>
                                                    <h6 class="timeline-title">Homepage mockup design</h6>
                                                    <p class="timeline-text">Melissa liked your activity.</p>
                                                    <div class="timeline-content orange-text">Important</div>
                                                </li>
                                                <li class="timeline-items timeline-icon-cyan active">
                                                    <div class="timeline-time">10 min</div>
                                                    <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content green-text">Resolved</div>
                                                </li>
                                                <li class="timeline-items timeline-icon-red active">
                                                    <div class="timeline-time">30 mins</div>
                                                    <h6 class="timeline-title">12 new users registered</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content">
                                                        <img src="{!! asset('public/backend/app-assets/images/icon/pdf.png') !!}" alt="document" height="30"
                                                            width="25" class="mr-1">Registration.doc
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-indigo active">
                                                    <div class="timeline-time">2 Hrs</div>
                                                    <h6 class="timeline-title">Tina is attending your activity</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content">
                                                        <img src="{!! asset('public/backend/app-assets/images/icon/pdf.png') !!}" alt="document" height="30"
                                                            width="25" class="mr-1">Activity.doc
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-orange">
                                                    <div class="timeline-time">5 hrs</div>
                                                    <h6 class="timeline-title">Josh is now following you</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content red-text">Pending</div>
                                                </li>
                                            </ul>
                                            <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
                                            <ul class="mb-0 widget-timeline">
                                                <li class="timeline-items timeline-icon-green active">
                                                    <div class="timeline-time">Just now</div>
                                                    <h6 class="timeline-title">New order received urgent</h6>
                                                    <p class="timeline-text">Melissa liked your activity.</p>
                                                    <div class="timeline-content orange-text">Important</div>
                                                </li>
                                                <li class="timeline-items timeline-icon-cyan active">
                                                    <div class="timeline-time">05 min</div>
                                                    <h6 class="timeline-title">System shutdown.</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content blue-text">Urgent</div>
                                                </li>
                                                <li class="timeline-items timeline-icon-red">
                                                    <div class="timeline-time">20 mins</div>
                                                    <h6 class="timeline-title">Database overloaded 89%</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content">
                                                        <img src="{!! asset('public/backend/app-assets/images/icon/pdf.png') !!}" alt="document" height="30"
                                                            width="25" class="mr-1">Database-log.doc
                                                    </div>
                                                </li>
                                            </ul>
                                            <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
                                            <ul class="mb-0 widget-timeline">
                                                <li class="timeline-items timeline-icon-green active">
                                                    <div class="timeline-time">10 min</div>
                                                    <h6 class="timeline-title">System error</h6>
                                                    <p class="timeline-text">Melissa liked your activity.</p>
                                                    <div class="timeline-content red-text">Error</div>
                                                </li>
                                                <li class="timeline-items timeline-icon-cyan">
                                                    <div class="timeline-time">1 min</div>
                                                    <h6 class="timeline-title">Production server down.</h6>
                                                    <p class="timeline-text">Here are some news feed interactions
                                                        concepts.</p>
                                                    <div class="timeline-content blue-text">Urgent</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide Out Chat -->
                        <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
                            <li class="pt-2 pb-2 center-align sidenav-close chat-head">
                                <a href="#!"><i class="mr-0 material-icons">chevron_left</i>Elizabeth Elliott</a>
                            </li>
                            <li class="chat-body">
                                <ul class="collection">
                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">hello!</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">How can we help? We're here for you!</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">I am looking for the best admin template.?</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">Materialize admin is the responsive
                                                materializecss admin template.</p>
                                        </div>
                                    </li>

                                    <li class="collection-item display-grid width-100 center-align">
                                        <p>8:20 a.m.</p>
                                    </li>

                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">Ohh! very nice</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">Thank you.</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">How can I purchase it?</p>
                                        </div>
                                    </li>

                                    <li class="collection-item display-grid width-100 center-align">
                                        <p>9:00 a.m.</p>
                                    </li>

                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">From ThemeForest.</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">Only $24</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">Ohh! Thank you.</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar" data-target="slide-out-chat">
                                        <span class="avatar-status avatar-online avatar-50"><img
                                                src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}" alt="avatar">
                                        </span>
                                        <div class="user-content speech-bubble">
                                            <p class="medium-small">I will purchase it for sure.</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">Great, Feel free to get in touch on</p>
                                        </div>
                                    </li>
                                    <li class="pb-0 pl-5 collection-item display-flex avatar justify-content-end"
                                        data-target="slide-out-chat">
                                        <div class="user-content speech-bubble-right">
                                            <p class="medium-small">https://pixinvent.ticksy.com/</p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="center-align chat-footer">
                                <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">
                                    <div class="input-field">
                                        <input id="icon_prefix" type="text" class="search">
                                        <label for="icon_prefix">Type here..</label>
                                        <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </aside>
                    <!-- END RIGHT SIDEBAR NAV -->
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->
@endsection

@push('scripts')

    <script>
        $(document).ready(function(){
            $('#order_status_from').datepicker();
            $('#order_status_to').datepicker();
        });
    </script>

    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/core.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/charts.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/animated.js') !!}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script> --}}

    <script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("revenueChart", am4charts.XYChart);

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "sales";
            series.dataFields.dateX = "period";
            series.tooltipText = "{sales}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

            // Drop-shaped tooltips
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            // Make bullets grow on hover
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.3;

            // Make a panning cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

            loadRevenueData();

            function loadRevenueData() {
                $.ajax({
                    url: '{{ route('revenue_data') }}',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        chart.setData(data.revenue);

                        $.each(data.revenue, function(index, value) {
                            $('.percent').html(`${value.percent}%`);
                        });
                    }
                });
            }

        });
    </script>

    <script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart
            var chart = am4core.create("profitChart", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

            chart.paddingRight = 20;

            var data = [];
            var visits = 10;
            for (var i = 1; i < 60; i++) {
                visits += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
                data.push({ date: new Date(2018, 0, i), value: visits });
            }

            chart.data = data;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.renderer.minWidth = 35;

            var series = chart.series.push(new am4charts.StepLineSeries());
            series.dataFields.dateX = "period";
            series.dataFields.valueY = "profit";
            series.noRisers = true;
            series.strokeWidth = 2;
            series.fillOpacity = 0.2;
            series.sequencedInterpolation = true;

            series.tooltipText = "{valueY.value}";
            chart.cursor = new am4charts.XYCursor();

            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);

            loadProfitData();

            function loadProfitData() {
                $.ajax({
                    url: '{{ route('profit_data') }}',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        chart.setData(data.profit);

                        $.each(data.profit, function(index, value) {
                            $('#sumProfit').html(`${value.sumProfit} VNĐ`);
                            $('#profit_start').html(`${value.earlyLastMonthfm}`);
                            $('#profit_end').html(`${value.endLastMonthfm}`);
                        });
                    }
                });
            }
        });
    </script>

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart
            var chart = am4core.create("orderStatusChart", am4charts.PieChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            var series = chart.series.push(new am4charts.PieSeries());
            series.dataFields.value = "order_status";
            series.dataFields.radiusValue = "order_status";
            series.dataFields.category = "order_status_name";
            series.slices.template.cornerRadius = 6;
            series.colors.step = 3;

            series.hiddenState.properties.endAngle = -90;

            chart.legend = new am4charts.Legend();

            FilterOrderStatusData();

            function FilterOrderStatusData(order_status_from = '', order_status_to = '') {

                $.ajax({
                    url: '{{ route('order_status_data') }}',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        order_status_from: order_status_from,
                        order_status_to: order_status_to
                    },

                    success: function(data) {
                        chart.setData(data.orderStatusFilter);
                    }
                });
            }

            $('#order_status_filter').click(function() {
                var order_status_from = $('#order_status_from').val();
                var order_status_to = $('#order_status_to').val();

                if (order_status_from != '' && order_status_to != '') {
                    loadOrderStatusData(order_status_from, order_status_to);
                } else {
                    toastr.error('Vui lòng chọn ngày lọc!', 'Error');
                }
            });

            LoadOrderStatusData();

            function loadOrderStatusData() {
                $.ajax({
                    url: '{{ route('load_order_status_data') }}',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        chart.setData(data.orderStatus);
                    }
                });
            }

        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 5000
            })
        })
    </script>
@endpush
