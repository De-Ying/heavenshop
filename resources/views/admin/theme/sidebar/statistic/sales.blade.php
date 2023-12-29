<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{!! route('dashboard') !!}">
                <img class="hide-on-med-and-down" src="{!! asset('public/backend/app-assets/images/logo/materialize-logo.png') !!}" alt="materialize logo">
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{!! asset('public/backend/app-assets/images/logo/materialize-logo-color.png') !!}"
                    alt="materialize logo">
                <span class="logo-text hide-on-med-and-down">HeavenShop</span></a>
            <a class="navbar-toggler" href="#">
                <i class="material-icons">radio_button_checked</i>
            </a>
        </h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="accordion">

        <li class="bold">
            <a class="waves-effect waves-cyan" href="{!! route('dashboard') !!}">
                <i class="fa fa-dashboard" aria-hidden="true"></i>
                <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
            </a>
        </li>

        <li class="active bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                <i class="fa fa-line-chart" aria-hidden="true"></i>
                <span class="menu-title" data-i18n="Templates">Báo cáo</span>
            </a>

            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{!! route('statistic.inventory.inventory') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Giá trị tồn kho">Giá trị tồn kho</span>
                        </a>
                    </li>

                    <li class="active">
                        <a class="active" href="{!! route('statistic.sales.timer') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Thống kê doanh thu">Thống kê doanh thu</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('statistic.bill.bill') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Thống kê hóa đơn">Thống kê hóa đơn</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="navigation-header">
            <a class="navigation-header-text">Applications</a>
        </li>

        <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                <i class="fa fa-product-hunt"></i>
                <span class="menu-title" data-i18n="Templates">Sản phẩm</span>
            </a>

            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{!! route('category.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Danh mục sản phẩm">Danh mục sản phẩm</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('brand.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle"></i>
                            </span>
                            <span data-i18n="Thương hiệu sản phẩm">Thương hiệu sản phẩm</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('product.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Sản phẩm">Sản phẩm</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('supplier.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Nhà cung cấp">Nhà cung cấp</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('delivery') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Vận chuyển">Vận chuyển</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="bold">
            <a class="waves-effect waves-cyan" href="{!! route('coupon.view_all') !!}">
                <i class="fa fa-percent"></i>
                <span class="menu-title" data-i18n="Mã giảm giá">Mã giảm giá</span>
            </a>
        </li>

        <li class="bold">
            <a class="waves-effect waves-cyan" href="{!! route('m-order.manage_order') !!}">
                <i class="fa fa-shopping-cart"></i>
                <span class="menu-title" data-i18n="Đơn hàng">Đơn hàng</span>
            </a>
        </li>

        <li class="bold">
            <a class="waves-effect waves-cyan" href="{!! route('comment.view_all') !!}">
                <i class="fa fa-comments"></i>
                <span class="menu-title" data-i18n="Bình luận">Bình luận</span>
            </a>
        </li>

        <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                <i class="fa fa-newspaper-o "></i>
                <span class="menu-title" data-i18n="Templates">Bài viết</span>
            </a>

            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{!! route('category-post.view_category_post') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Danh mục bài viết">Danh mục bài viết</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('posts.view_post') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Bài viết">Bài viết</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                <i class="fa fa-share-alt-square"></i>
                <span class="menu-title" data-i18n="Templates">Quảng cáo</span>
            </a>

            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{!! route('slider.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Slider">Slider</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('contact.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Liên hệ">Liên hệ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Authentication</a></li>

        <li class="bold">
            <a class="waves-effect waves-cyan" href="{!! route('customer.view_all') !!}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="menu-title" data-i18n="Khách hàng">Khách hàng</span>
            </a>
        </li>

        <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                <i class="fa fa-user-secret" aria-hidden="true"></i>
                <span class="menu-title" data-i18n="Templates">Bảo mật</span>
            </a>

            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{!! route('users.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Danh sách người dùng">Danh sách người dùng</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('roles.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Vai trò người dùng">Vai trò người dùng</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('permissions.view_all') !!}">
                            <span class="material-icons">
                                <i class="fa fa-circle-thin"></i>
                            </span>
                            <span data-i18n="Quyền người dùng">Quyền người dùng</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
