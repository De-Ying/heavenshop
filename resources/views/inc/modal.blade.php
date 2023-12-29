<div class="modal fade" id="xemnhanh" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg m-t-150" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title product_quickview_name">
                    <span id="product_quickview_name"></span>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <style type="text/css">
                    span#product_quickview_content img {
                        width: 100%;
                    }

                    @media screen and (min-width: 768px) {
                        .modal-dialog {
                            width: 700px;
                        }

                        .modal-sm {
                            width: 350px;
                        }
                    }

                    @media screen and (min-width: 992px) {
                        .modal-lg {
                            width: 1200px;
                        }
                    }

                </style>
                <div class="row">
                    <div class="col-md-5">
                        <span class="product_quickview_image"></span>
                    </div>

                    <div class="col-md-7">
                        <h4><span class="uppercase product_quickview_name"></span></h4>

                        <p class="m-t-5 fs-12">Thương hiệu: <span class="product_quickview_brand" style="color: #fc0000"></span> ~ Tình trạng: <span class="product_quickview_status" style="color: #fc0000"></span> ~ Mã ID: <span class="product_quickview_id"></span></p>

                        <p class="text-xl font-bold m-t-10">
                            <span
                                class="product_quickview_price">
                            </span>
                        </p>

                        <p class="m-t-10 fs-14">Số lượng: </p>

                        <div class="items-center justify-start flex-w p-b-20">
                            <div class="flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">

                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m fs-16">
                                        <i class="zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num"
                                        min="1" id="num" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m fs-16">
                                        <i class="zmdi zmdi-plus"></i>
                                    </div>

                                    <div class="product_quickview_quantity"></div>
                                </div>

                                <div class="product_quickview_button"></div>

                            </div>
                        </div>

                        <div class="flex-w flex-m p-b-20">
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

                        <div class="flex-w flex-m p-b-20 product_quickview_tag"></div>

                        <div class="flex-row-reverse flex-w flex-m p-b-10">
                            <div class="size-203 flex-c-m respon6"></div>

                            <div class="size-204 respon6-next" id="message"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="bor10 m-t-50 p-t-43 p-b-40">
                            <div class="tab01">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item p-b-10">
                                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab"
                                            style="font-family: Roboto,sans-serif;">Mô tả sản phẩm</a>
                                    </li>

                                    {{-- <li class="nav-item p-b-10">
                                        <a class="nav-link" data-toggle="tab" href="#information" role="tab"
                                            style="font-family: Roboto,sans-serif;">Thông số sản phẩm</a>
                                    </li> --}}
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-t-43">
                                    <!-- - -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="how-pos2 p-lr-15-md">
                                            <p class="stext-102 cl6 product_quickview_description"></p>
                                        </div>
                                    </div>

                                    <!-- - -->
                                    <div class="tab-pane fade" id="information" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                                <ul class="p-lr-28 p-lr-15-sm">
                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">
                                                            Weight
                                                        </span>

                                                        <span class="stext-102 cl6 size-206">
                                                            0.79 kg
                                                        </span>
                                                    </li>

                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">
                                                            Dimensions
                                                        </span>

                                                        <span class="stext-102 cl6 size-206">
                                                            110 x 33 x 100 cm
                                                        </span>
                                                    </li>

                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">
                                                            Materials
                                                        </span>

                                                        <span class="stext-102 cl6 size-206">
                                                            60% cotton
                                                        </span>
                                                    </li>

                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">
                                                            Color
                                                        </span>

                                                        <span class="stext-102 cl6 size-206">
                                                            Black, Blue, Grey, Green, Red, White
                                                        </span>
                                                    </li>

                                                    <li class="flex-w flex-t p-b-7">
                                                        <span class="stext-102 cl3 size-205">
                                                            Size
                                                        </span>

                                                        <span class="stext-102 cl6 size-206">
                                                            XL, L, M, S
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-cart" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-success redirect-cart">Đi tới giỏ hàng</button>
            </div>
        </div>
    </div>
</div>
