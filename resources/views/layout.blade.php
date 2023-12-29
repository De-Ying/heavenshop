<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cửa hàng bán quần áo thời trang Heaven | {{ $meta_title }}</title>
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/pages/flag-icon/flag-icon.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="apple-touch-icon" href="{!! asset('public/backend/app-assets/images/favicon/apple-touch-icon-152x152.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('public/backend/app-assets/images/favicon/favicon-32x32.png') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/bootstrap/css/bootstrap.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/themify-icons/themify-icons.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/fonts/linearicons-v1.0.0/icon-font.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/animate/animate.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/css-hamburgers/hamburgers.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/animsition/css/animsition.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/select2/select2.min.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/daterangepicker/daterangepicker.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/slick/slick.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/MagnificPopup/magnific-popup.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/perfect-scrollbar/perfect-scrollbar.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/util.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/main.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/grid.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/responsive.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/custom.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" href="{!! asset('public/frontend/css/sweetalert2/sweetalert.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" href="{!! asset('public/frontend/css/search_autocomplete.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/frontend/css/jqueryui/jquery-ui.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/parsley.css') !!}">
    <!--============================================================================================================================-->
    <link rel="stylesheet" href="{!! asset('public/frontend/css/owlcarousel/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/frontend/css/owlcarousel/owl.theme.default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/frontend/css/toastr.min.css') !!}">
    <script src="{!! asset('public/backend/assets/js/toastr/jquery.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/toastr/toastr.min.js') !!}"></script>

    @stack('css')
</head>

<body class="animsition">

    @include('inc.header')
    @include('pages.common.cart')
    @include('pages.common.wishlist')

    @yield('main')

    @include('inc.footer')
    @include('inc.back_to_top')
    @include('inc.modal')

    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/jquery/jquery-3.2.1.min.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/animsition/animsition.min.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/bootstrap/popper.js') !!}"></script>
    <script src="{!! asset('public/frontend/js/bootstrap/bootstrap.min.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/select2/select2.min.js') !!}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        });
    </script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/daterangepicker/moment.min.js') !!}"></script>
    <script src="{!! asset('public/frontend/js/daterangepicker/daterangepicker.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/slick/slick.min.js') !!}"></script>
    <script src="{!! asset('public/frontend/js/slick-custom.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/parallax100/parallax100.js') !!}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/MagnificPopup/jquery.magnific-popup.min.js') !!}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/isotope/isotope.pkgd.min.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/sweetalert2/sweetalert.min.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/jqueryui/jquery-ui.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/simple.money.format.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/perfect-scrollbar/perfect-scrollbar.min.js') !!}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--============================================================================================================================-->
    <script type="text/javascript">
        const currentLocation = location.href;
        const filterItem = document.querySelectorAll('.filter-link');
        const filterLength = filterItem.length;
        for (let i = 0; i < filterLength; i++) {
            if (filterItem[i].href === currentLocation) {
                filterItem[i].className = "filter-link-active";
            }
        }
    </script>
    <!--============================================================================================================================-->
    <script type="text/javascript">
        const currentMenuUrl = location.href;
        const menuLinks = document.querySelectorAll('.menu-link');

        const activeLink = Array.from(menuLinks).find(link => link.href === currentMenuUrl);

        if (activeLink) {
            activeLink.classList.add('active-menu');
        }
    </script>

    <script type="text/javascript">
        const currentSortUrl = location.href;
        const sortLinks = document.querySelectorAll('.sort-link');
        const sortLinkLength = sortLinks.length;
        for (let i = 0; i < sortLinkLength; i++) {
            if (sortLinks[i].href === currentSortUrl) {
                sortLinks[i].classList.add('sort-link-active')
            }
        }
    </script>

    <script type="text/javascript">
        const currentCategoryUrl = location.href;
        const categoryLinks = document.querySelectorAll('.category-bar-col__link');
        const categoryLinkLength = categoryLinks.length;
        for (let i = 0; i < categoryLinkLength; i++) {
            if (categoryLinks[i].href === currentCategoryUrl) {
                categoryLinks[i].classList.add('category-bar-col__link-active')
            }
        }
    </script>

    <script type="text/javascript">
        const currentBrandUrl = location.href;
        const brandLinks = document.querySelectorAll('.brand-bar__link');
        const brandLinkLenght = brandLinks.length;
        for (let i = 0; i < brandLinkLenght; i++) {
            if (brandLinks[i].href === currentBrandUrl) {
                brandLinks[i].classList.add('brand-bar__link-active')
            }
        }
    </script>

    <script type="text/javascript">
        const currentCouponUrl = location.href;
        const couponLinks = document.querySelectorAll('.coupon-link');
        const couponLinkLength = couponLinks.length;
        for (let i = 0; i < couponLinkLength; i++) {
            if (couponLinks[i].href === currentCouponUrl) {
                couponLinks[i].classList.add('coupon-link-active')
            }
        }
    </script>

    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/main.js') !!}"></script>
    <!--============================================================================================================================-->
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/custom/custom.js') !!}"></script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/backend/assets/js/parsley.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#validate_form').parsley();
        });
    </script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/owlcarousel/owl.carousel.js') !!}"></script>

    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayHoverPause: true,
        });
    </script>
    <!--============================================================================================================================-->
    <script src="{!! asset('public/frontend/js/zoom/jquery.imgzoom.js') !!}"></script>

    <script type="text/javascript">
        $('.imgBox').imgZoom({
            boxWidth: 500,
            boxHeight: 500,
            marginLeft: 5,
            origin: 'data-origin'
        });
    </script>
    <!--============================================================================================================================-->
    <!-- Cancel order -->
    <script type="text/javascript">
        function cancel_order(id) {
            var order_id = id;
            var order_reason = $('.order_reason').val();
            var order_status = 3;
            var _token = $('input[name="_token"]').val();

            // Lấy ra số lượng dựa vào mảng
            var quantity = [];
            $("input[name='product_sales_qty']").each(function() {
                quantity.push($(this).val());
            });
            // Lấy ra product_id đem so sánh
            var order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            var j = 0;
            for (var i = 0; i < order_product_id.length; i++) {
                // Số lượng khách đặt
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                // Số lượng tồn kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    // Chạy duy nhất 1 lần số lượng khách đặt > số lượng kho tồn
                    if (j == 1) {
                        toastr.warning('Số lượng bán trong kho không đủ', 'Warning');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', '#000');
                    $('.color_qty_' + order_product_id[i]).css('color', '#fff');
                }
                // TH: Nếu else vào đây thì nó sẽ lặp và trừ hết số lượng tồn kho
            }
            // THĐB: Nếu mà số lượng tồn kho > số lượng khách đặt
            if (j == 0) {
                $.ajax({
                    url: '{{ route('cancel_order') }}',
                    method: 'POST',
                    data: {
                        order_id: order_id,
                        order_reason: order_reason,
                        quantity: quantity,
                        order_product_id: order_product_id,
                        order_status: order_status,
                        _token: _token
                    },

                    success: function(data) {
                        swal("Hoàn tất!", "Hủy đơn hàng thành công!", "success");

                        $('.order_reason').val('');

                        setTimeout(function() {
                            window.location.href = "{{ route('purchase') }}";
                        }, 1000)
                    }
                });
            }
        }
    </script>
    <!--============================================================================================================================-->
    <!-- Paypal -->
    {{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script type="text/javascript">

        var usd = document.getElementById("vnd_to_usd").value;

        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AYFNnQrjo1z-2PQ7_tgaXe4pPXX9LIwg05oPDHoYySWRFEcHJYlqq1FhGOiTHXcXx6AIbdrJk1Fuj745',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
            size: 'small',
            color: 'blue',
            shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                amount: {
                    total: `${usd}`,
                    currency: 'USD'
                }
                }]
            });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Cảm ơn bạn đã mua hàng!');
            });
            }
        }, '#paypal-button');

    </script> --}}
    <!--============================================================================================================================-->
    <!-- Wish list -->
    <script type="text/javascript">
        function addWishList(product_id) {
            var customer_id = $('.customer_id_' + product_id).val();
            var wishlist_product_name = $('.wishlist_product_name_' + product_id).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('insert_wishlist') }}',
                method: 'POST',
                data: {
                    customer_id: customer_id,
                    product_id: product_id,
                    _token: _token
                },

                success: function(data) {
                    swal("Hoàn tất", "Đã thêm" + " " + wishlist_product_name + " " + "vào danh sách yêu thích",
                        "success");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },

                error: function(data) {
                    swal("Thất bại", "Đã tồn tại" + " " + wishlist_product_name + " " +
                        "trong danh sách yêu thích", "error");
                },
            });
        }

        $('.header-wishlist-item-img').click(function() {
            var del_id = $(this).data('del_id');
            var wishlist_product_name = $(this).data('product_name');
            var _token = $('input[name="_token"]').val();

            swal({
                title: "Bạn có chắc không?",
                text: "Sản phẩm sẽ xóa khỏi danh sách yêu thích!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('delete_wishlist_image') }}',
                    method: 'POST',
                    data: {
                        del_id: del_id,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        swal("Hoàn tất", "Đã xóa" + " " + wishlist_product_name + " " +
                            "khỏi danh sách yêu thích",
                            "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        });

        function checkWishList() {
            swal("Thêm thất bại", "Bạn phải đăng nhập trước khi thêm vào danh sách yêu thích", "error");
        }
    </script>
    <!--============================================================================================================================-->
    <!-- Add-to-cart-quick-view -->
    <script>
        function quickViewMultipleAddCart(product_id) {
            var num = $('#num').val();
            var product_quantity = $('.product_quantity_' + product_id).val();
            var _token = $('input[name="_token"]').val();

            if (num < 1) {
                toastr.warning('Số lượng tối thiểu là 1', 'Warning');
            } else if (parseInt(num) > parseInt(product_quantity)) {
                toastr.warning('Số lượng trong kho không đủ', 'Warning');
            } else {
                $.post('{{ route('save_cart_multiple') }}', {
                        'product_id': product_id,
                        'num': num,
                        'product_quantity': product_quantity,
                        '_token': _token,
                    },
                    function(data) {
                        toastr.success('Đã thêm sản phẩm vào giỏ hàng', 'Success');
                    });
            }
        }
    </script>

    <!-- Quick View -->
    <script>
        function quickView(product_id) {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('quick_view') }}',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    product_id: product_id,
                    _token: _token
                },

                success: function(data) {
                    $('.product_quickview_id').html(data.product_id);
                    $('.product_quickview_name').html(data.product_name);
                    $('.product_quickview_description').html(data.product_description);
                    $('.product_quickview_content').html(data.product_content);
                    $('.product_quickview_price').html(data.product_price);
                    $('.product_quickview_image').html(data.product_image);
                    $('.product_quickview_quantity').html(data.product_quantity);
                    $('.product_quickview_brand').html(data.product_brand);
                    $('.product_quickview_status').html(data.product_status);
                    $('.product_quickview_button').html(data.product_button);
                    $('.product_quickview_tag').html(data.product_tag);
                }
            });
        }
    </script>

    <script>
        $(document).on('click', '.close-cart', function() {
            setTimeout(function() {
                location.reload();
            }, 1500)
        });
    </script>

    <script>
        $(document).on('click', '.redirect-cart', function() {
            window.location.href = "{{ route('view_cart') }}";
        });
    </script>

    <!--============================================================================================================================-->
    <!-- Autocomplete Search -->
    <script type="text/javascript">
        const search = document.querySelector('.keywords')

        search.onkeyup = function(e) {
            e.stopPropagation();
            var searchText = this.value;

            if (searchText != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('fetch_data_search') }}',
                    method: 'POST',
                    data: {
                        searchText: searchText,
                        _token: _token
                    },

                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        }


        $(document).on('click', '.dropdown-search li', function() {
            $('.keywords').val($(this).text().trim());
            $('#search_ajax').fadeOut();
        });
    </script>

    <!--============================================================================================================================-->
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "108552644663830");
        chatbox.setAttribute("attribution", "biz_inbox");
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v11.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!--============================================================================================================================-->
    <!-- Add to cart (one) -->
    <script type="text/javascript">
        function simpleAddCart(product_id) {
            var product_quantity = $('.product_quantity_' + product_id).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('save_cart_simple') }}',
                method: 'POST',
                data: {
                    product_id: product_id,
                    product_quantity: product_quantity,
                    _token: _token
                },

                success: function(data) {
                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonClass: "btn-warning",
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false,
                        }),
                        $(".cancel").click(function() {
                            toastr.success('Đã thêm sản phẩm vào giỏ hàng', 'Success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        });
                    $(".confirm").click(function() {
                        toastr.success('Đã thêm sản phẩm vào giỏ hàng', 'Success');
                        setTimeout(() => {
                            window.location.href = "{{ route('view_cart') }}";
                        }, 1000);
                    });
                }
            });
        }
    </script>

    <!-- Add to cart (many) -->
    <script type="text/javascript">
        function multipleAddCart(product_id) {
            // Lấy số lượng
            var num = $('#num').val();
            var product_quantity = $('.product_quantity_' + product_id).val();
            var _token = $('input[name="_token"]').val();

            if (num < 1) {
                toastr.warning('Số lượng tối thiểu là 1', 'Warning');
            } else if (parseInt(num) > parseInt(product_quantity)) {
                toastr.warning('Số lượng trong kho không đủ', 'Warning');
            } else {
                $.post('{{ route('save_cart_multiple') }}', {
                    'product_id': product_id,
                    'num': num,
                    'product_quantity': product_quantity,
                    '_token': _token,
                }, function(data) {
                    toastr.success('Đã thêm sản phẩm vào giỏ hàng', 'Success');
                    setTimeout(function() {
                        window.location.href = "{{ route('view_cart') }}";
                    }, 1500)
                });
            }
        }
    </script>

    <!-- Delete one product of cart -->
    <script type="text/javascript">
        function confirmDelete(pid) {
            var _token = $('input[name="_token"]').val();

            swal({
                title: "Bạn có chắc không?",
                text: "Bạn sẽ không thể khôi phục lại tệp này!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('delete_cart') }}',
                    method: 'POST',
                    data: {
                        pid: pid,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        swal("Hoàn tất", "Sản phẩm đã xoá thành công", "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        }
    </script>

    <!-- Delete all product of cart -->
    <script type="text/javascript">
        function confirmDeleteAll() {
            swal({
                title: "Bạn có chắc không?",
                text: "Bạn sẽ không thể khôi phục lại tệp này!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('delete_all_cart') }}',
                    method: 'GET',
                    dataType: "html",
                    success: function() {
                        swal("Hoàn tất!", "Đã xoá toàn bộ sản phẩm trong giỏ hàng", "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        }
    </script>
    <!--============================================================================================================================-->
    <!-- Take the commune, ward, district -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'commune';
                }
                $.ajax({
                    url: '{{ route('select_delivery_cart') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>

    <!-- Calculate shipping -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var city_id = $('.city').val();
                var district_id = $('.district').val();
                var commune_id = $('.commune').val();
                var _token = $('input[name="_token"]').val();

                if ($("#city")[0].selectedIndex <= 0) {
                    toastr.warning("Chưa chọn tỉnh/thành phố", "Warning");
                } else {
                    $.ajax({
                        url: '{{ route('calculate_feeship') }}',
                        method: 'POST',
                        data: {
                            city_id: city_id,
                            district_id: district_id,
                            commune_id: commune_id,
                            _token: _token
                        },
                        success: function(data) {
                            toastr.success("Thêm phí vận chuyển thành công", "Success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            toastr.error("Chưa có phí ship cho địa điểm này", "Error");
                        }
                    });
                }
            });
        });
    </script>
    <!--============================================================================================================================-->
    <!-- Dell item -->
    <script type="text/javascript">
        $('.header-cart-item-img').click(function() {
            var del_id = $(this).data('del_id')
            var _token = $('input[name="_token"]').val();

            swal({
                title: "Bạn có chắc không?",
                text: "Bạn sẽ không thể khôi phục lại tệp này!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('delete_cart_image') }}',
                    method: 'POST',
                    data: {
                        del_id: del_id,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        swal("Hoàn tất!", "Sản phẩm đã xoá thành công", "success");
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                        location.reload();
                    }
                });
            });

        });
    </script>


    <script>
        function CheckCouponLogin(URL) {
            var Ok = confirm('Bạn phải đăng nhập trước khi dùng mã khuyễn mãi này!');
            if (Ok == true) {
                document.location.href = URL;
            }
        }
    </script>

    <script>
        function CheckCheckoutLogin(URL) {
            var Ok = confirm('Bạn phải đăng nhập trước khi thực hiện thanh toán!');
            if (Ok == true) {
                document.location.href = URL;
            }
        }
    </script>

    @stack('js')
</body>

</html>
