<!--sidebar start-->
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel">MAIN NAVIGATION</div>

        @hasRole(['administrator'])
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('dashboard') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>
        </ul>
        @endhasRole

        @hasRole(['merchandiser'])
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('dashboardMC') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>

        </ul>
        @endhasRole

        @hasRole(['product-management'])
        <ul class="pcoded-item pcoded-left-item">
            <li class="active pcoded-trigger">
                <a href="{!! route('dashboardPCM') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>

        </ul>
        @endhasRole

        @hasRole(['post-management'])
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('dashboardPSM') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>

        </ul>
        @endhasRole

        @hasRole(['interface-management'])
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('dashboardIM') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>

        </ul>
        @endhasRole

        @hasRole(['customer-care'])
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('dashboardCC') !!}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>

        </ul>
        @endhasRole

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-chart-bar-graph"></i></span>
                    <span class="pcoded-mtext">Báo cáo</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{!! route('statistic.inventory.inventory') !!}">
                            <span class="pcoded-mtext">Giá trị tồn kho</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('statistic.sales.timer') !!}">
                            <span class="pcoded-mtext">Thống kê doanh thu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('statistic.bill.bill') !!}">
                            <span class="pcoded-mtext">Thống kê hóa đơn</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-tasks"></i></span>
                    <span class="pcoded-mtext">Sản phẩm</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{!! route('category.view_all') !!}">
                            <span><i class="fa fa-list cc_pointer"></i> Danh mục sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('brand.view_all') !!}">
                            <span><i class="icon-badge"></i> Thương hiệu sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('product.view_all') !!}">
                            <span><i class="fa fa-scribd"></i> Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('supplier.view_all') !!}">
                            <span><i class="fa fa-users"></i> Nhà cung cấp</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('delivery') !!}">
                            <span><i class="icofont icofont-free-delivery"></i> Vận chuyển</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('comment.view_all') !!}">
                    <span class="pcoded-micon"><i class="fa fa-comments-o"></i></span>
                    <span class="pcoded-mtext">Bình luận khách hàng</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-newspaper"></i></span>
                    <span class="pcoded-mtext">Bài viết</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{!! route('category-post.view_category_post') !!}">
                            <span class="pcoded-mtext"><i class="fa fa-list cc_pointer"></i> Danh mục bài viết</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('posts.view_post') !!}">
                            <span class="pcoded-mtext"><i class="icofont icofont-social-blogger"></i> Bài viết</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('m-order.manage_order') !!}">
                    <span class="pcoded-micon"><i class="icofont icofont-cart-alt"></i></span>
                    <span class="pcoded-mtext">Đơn đặt hàng</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-share-alt-square"></i></span>
                    <span class="pcoded-mtext">Quảng cáo</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{!! route('slider.view_all') !!}">
                            <span><i class="icofont icofont-brand-slideshare"></i> Slider</span>
                        </a>
                    </li>

                    <li>
                        <a href="{!! route('contact.view_all') !!}">
                            <span><i class="icofont icofont-contacts cc_pointer"></i> Liên hệ</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('coupon.view_all') !!}">
                    <span class="pcoded-micon"><i class="icofont icofont-sale-discount"></i></span>
                    <span class="pcoded-mtext">Mã giảm giá</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{!! route('customer.view_all') !!}">
                    <span class="pcoded-micon"><i class="fa fa-user"></i></span>
                    <span class="pcoded-mtext">Khách hàng</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-user-secret"></i></span>
                    <span class="pcoded-mtext">Bảo mật</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{!! route('users.view_all') !!}">
                            <span class="pcoded-mtext">Danh sách người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('roles.view_all') !!}">
                            <span class="pcoded-mtext">Vai trò người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('permissions.view_all') !!}">
                            <span class="pcoded-mtext">Quyền người dùng</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
<!--sidebar end-->
