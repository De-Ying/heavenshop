@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Báo cáo doanh thu')

@push('css')
    <style>
        .select2-container--default .select2-selection--single {
            border-bottom: 1px solid #aaa;
            border-top: unset;
            border-left: unset;
            border-right: unset;
        }

    </style>

    <link rel="stylesheet" href="{!! asset('public/backend/app-assets/css/chart/morris/morris.css') !!}">
@endpush

@section('admin_content')
    @include('admin.theme.sidebar.statistic.sales')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Thống kê</span>
                            </h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="mb-0 breadcrumbs">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard') !!}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Báo cáo doanh thu
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="users-list-filter section">
                        <div class="card-panel">
                            <div class="row m-b-20 p-b-20">
                                <div class="col s12 m6 l2 display-flex align-items-center show-btn" style="width: 12.5%">
                                    <a href="{{ route('statistic.sales.timer') }}"
                                        class="btn btn-grd-default btn-sm m-r-5">
                                        Thời gian
                                    </a>
                                </div>

                                <div class="col s12 m6 l2 display-flex align-items-center show-btn" style="width: 14%">
                                    <a href="{{ route('statistic.sales.customer') }}"
                                        class="btn btn-grd-default btn-sm m-r-5">
                                        Khách hàng
                                    </a>
                                </div>

                                <div class="col s12 m6 l2 display-flex align-items-center show-btn">
                                    <a href="{{ route('statistic.sales.product') }}"
                                        class="btn btn-grd-info btn-sm m-r-5">
                                        Sản phẩm
                                    </a>
                                </div>
                            </div>

                            <form action="{{ route('statistic.bill.pdf-bill') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Loại thời gian</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control listProduct"
                                                name="hide_input" id="hide_input" style="width: 60%;" readonly>
                                                <option selected disabled>--- Chọn loại thời gian ---</option>
                                                <option value="daily_report">Báo cáo theo ngày</option>
                                                <option value="monthly_report">Báo cáo theo tháng</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-verified">Từ ngày</label>
                                        <div class="input-field">
                                            <input type="text" name="product_from" id="product_from"
                                                class="form-control datepicker hide_input">
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Đến ngày</label>
                                        <div class="input-field">
                                            <input type="text" name="product_to" id="product_to"
                                                class="form-control datepicker hide_input">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="button" name="product-filter" id="product-filter"
                                            class="btn btn-grd-inverse indigo waves-effect waves-light">
                                            <i class="fa fa-filter"></i>
                                            Lọc</button>
                                    </div>

                                    {{-- <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="button" class="btn btn-grd-info btn-sm m-r-5" name="refresh"
                                            id="refresh"><i class="fa fa-refresh"></i></button>
                                    </div> --}}

                                    {{-- <button type="button" id="export" class="text-white btn bg-green btn-sm m-r-5 showBtnExcel" style="display: none"><i
                                        class="icofont icofont-file-excel"></i> Xuất excel</button> --}}
                                    {{-- <button type="button" class="text-white btn bg-cloud btn-sm showBtnPrint" style="display: none"><i
                                        class="icofont icofont-print"></i> In báo cáo</button> --}}

                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="submit" class="btn btn-grd-info btn-sm m-r-5" name="bill-pdf"
                                            id="bill-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="users-list-filter section m-b-10"
                        style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">
                        <div class="row m-b-20">
                            <div class="col s12 m6 l4 display-flex align-items-center show-btn m-t-20">
                                <label for="recipient-name" class="col-form-label m-r-10 fs-30">
                                    <svg height="30px" version="1.1" viewBox="0 0 21 21" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title />
                                        <desc />
                                        <defs />
                                        <g fill="none" fill-rule="evenodd" id="Business-Icon" stroke="none" stroke-width="1" transform="translate(-277.000000, -227.000000)">
                                        <g id="Coin" transform="translate(275.000000, 225.000000)">
                                            <rect height="25" id="Rectangle-49" width="25" x="0" y="0" />
                                            <g id="Group-34" transform="translate(2.000000, 2.000000)">
                                            <path d="M10.5,21 C4.70101013,21 0,16.2989899 0,10.5 C0,4.70101013 4.70101013,0 10.5,0 C16.2989899,0 21,4.70101013 21,10.5 C21,16.2989899 16.2989899,21 10.5,21 Z M10.5,18 C14.6421356,18 18,14.6421356 18,10.5 C18,6.35786438 14.6421356,3 10.5,3 C6.35786438,3 3,6.35786438 3,10.5 C3,14.6421356 6.35786438,18 10.5,18 Z" fill="#3B5AFB" fill-rule="nonzero" id="Combined-Shape" />
                                            <path d="M10.5,17 C6.91014913,17 4,14.0898509 4,10.5 C4,6.91014913 6.91014913,4 10.5,4 C14.0898509,4 17,6.91014913 17,10.5 C17,14.0898509 14.0898509,17 10.5,17 Z M11,8 L11,7.5 C11,7.22385763 10.7761424,7 10.5,7 C10.2238576,7 10,7.22385763 10,7.5 L10,8 L9.5139452,8 C8.68551807,8 8.0139452,8.67157288 8.0139452,9.5 L8.0139452,10.0007567 C8.0139452,10.8291838 8.68551807,11.5007567 9.5139452,11.5007567 L11.5000049,11.5007567 C11.7761473,11.5007567 12.0000049,11.7246143 12.0000049,12.0007567 L12.0000049,12.5 C12.0000049,12.7761424 11.7761473,13 11.5000049,13 L9.01225525,13 C8.9916704,12.749839 8.78597816,12.549668 8.52914442,12.541857 C8.25312966,12.5334627 8.02257057,12.750412 8.01417627,13.0264268 L8.00023597,13.4848008 C7.99166064,13.7667682 8.21790708,14 8.5000049,14 L10,14 L10,14.4912415 C10,14.7673838 10.2238576,14.9912415 10.5,14.9912415 C10.7761424,14.9912415 11,14.7673838 11,14.4912415 L11,14 L11.5000049,14 C12.328432,14 13.0000049,13.3284271 13.0000049,12.5 L13.0000049,12.0007567 C13.0000049,11.1723296 12.328432,10.5007567 11.5000049,10.5007567 L9.5139452,10.5007567 C9.23780282,10.5007567 9.0139452,10.2768991 9.0139452,10.0007567 L9.0139452,9.5 C9.0139452,9.22385763 9.23780282,9 9.5139452,9 L11.9679559,9 C12.0222203,9.21744733 12.2188481,9.37854004 12.453101,9.37854004 C12.7292434,9.37854004 12.953101,9.15468241 12.953101,8.87854004 L12.953101,8.5 C12.953101,8.22385763 12.7292434,8 12.453101,8 L11,8 Z" fill="#44D5E9" id="Combined-Shape" />
                                            </g>
                                        </g>
                                        </g>
                                    </svg>
                                </label>

                                <div style="display: flex; flex-direction: column;">
                                    <span class="sales_count counter">0</span>
                                    <span class="fs-16">Doanh thu</span>
                                </div>
                            </div>

                            <div class="col s12 m6 l4 display-flex align-items-center show-btn m-t-20">
                                <label for="recipient-name" class="col-form-label m-r-10 fs-30">
                                    <svg height="30px" version="1.1" viewBox="0 0 21 21" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title />
                                        <desc />
                                        <defs />
                                        <g fill="none" fill-rule="evenodd" id="Business-Icon" stroke="none" stroke-width="1" transform="translate(-277.000000, -227.000000)">
                                        <g id="Coin" transform="translate(275.000000, 225.000000)">
                                            <rect height="25" id="Rectangle-49" width="25" x="0" y="0" />
                                            <g id="Group-34" transform="translate(2.000000, 2.000000)">
                                            <path d="M10.5,21 C4.70101013,21 0,16.2989899 0,10.5 C0,4.70101013 4.70101013,0 10.5,0 C16.2989899,0 21,4.70101013 21,10.5 C21,16.2989899 16.2989899,21 10.5,21 Z M10.5,18 C14.6421356,18 18,14.6421356 18,10.5 C18,6.35786438 14.6421356,3 10.5,3 C6.35786438,3 3,6.35786438 3,10.5 C3,14.6421356 6.35786438,18 10.5,18 Z" fill="#3B5AFB" fill-rule="nonzero" id="Combined-Shape" />
                                            <path d="M10.5,17 C6.91014913,17 4,14.0898509 4,10.5 C4,6.91014913 6.91014913,4 10.5,4 C14.0898509,4 17,6.91014913 17,10.5 C17,14.0898509 14.0898509,17 10.5,17 Z M11,8 L11,7.5 C11,7.22385763 10.7761424,7 10.5,7 C10.2238576,7 10,7.22385763 10,7.5 L10,8 L9.5139452,8 C8.68551807,8 8.0139452,8.67157288 8.0139452,9.5 L8.0139452,10.0007567 C8.0139452,10.8291838 8.68551807,11.5007567 9.5139452,11.5007567 L11.5000049,11.5007567 C11.7761473,11.5007567 12.0000049,11.7246143 12.0000049,12.0007567 L12.0000049,12.5 C12.0000049,12.7761424 11.7761473,13 11.5000049,13 L9.01225525,13 C8.9916704,12.749839 8.78597816,12.549668 8.52914442,12.541857 C8.25312966,12.5334627 8.02257057,12.750412 8.01417627,13.0264268 L8.00023597,13.4848008 C7.99166064,13.7667682 8.21790708,14 8.5000049,14 L10,14 L10,14.4912415 C10,14.7673838 10.2238576,14.9912415 10.5,14.9912415 C10.7761424,14.9912415 11,14.7673838 11,14.4912415 L11,14 L11.5000049,14 C12.328432,14 13.0000049,13.3284271 13.0000049,12.5 L13.0000049,12.0007567 C13.0000049,11.1723296 12.328432,10.5007567 11.5000049,10.5007567 L9.5139452,10.5007567 C9.23780282,10.5007567 9.0139452,10.2768991 9.0139452,10.0007567 L9.0139452,9.5 C9.0139452,9.22385763 9.23780282,9 9.5139452,9 L11.9679559,9 C12.0222203,9.21744733 12.2188481,9.37854004 12.453101,9.37854004 C12.7292434,9.37854004 12.953101,9.15468241 12.953101,8.87854004 L12.953101,8.5 C12.953101,8.22385763 12.7292434,8 12.453101,8 L11,8 Z" fill="#44D5E9" id="Combined-Shape" />
                                            </g>
                                        </g>
                                        </g>
                                    </svg>
                                </label>
                                <div style="display: flex; flex-direction: column;">
                                    <span class="funds_count counter">0</span>
                                    <span class="fs-16">Tổng vốn (trừ vốn hàng trả)</span>
                                </div>
                            </div>

                            <div class="col s12 m6 l4 display-flex align-items-center show-btn m-t-20">
                                <label for="recipient-name" class="col-form-label m-r-10 fs-30">
                                    <svg height="30px" version="1.1" viewBox="0 0 21 21" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title />
                                        <desc />
                                        <defs />
                                        <g fill="none" fill-rule="evenodd" id="Business-Icon" stroke="none" stroke-width="1" transform="translate(-277.000000, -227.000000)">
                                        <g id="Coin" transform="translate(275.000000, 225.000000)">
                                            <rect height="25" id="Rectangle-49" width="25" x="0" y="0" />
                                            <g id="Group-34" transform="translate(2.000000, 2.000000)">
                                            <path d="M10.5,21 C4.70101013,21 0,16.2989899 0,10.5 C0,4.70101013 4.70101013,0 10.5,0 C16.2989899,0 21,4.70101013 21,10.5 C21,16.2989899 16.2989899,21 10.5,21 Z M10.5,18 C14.6421356,18 18,14.6421356 18,10.5 C18,6.35786438 14.6421356,3 10.5,3 C6.35786438,3 3,6.35786438 3,10.5 C3,14.6421356 6.35786438,18 10.5,18 Z" fill="#3B5AFB" fill-rule="nonzero" id="Combined-Shape" />
                                            <path d="M10.5,17 C6.91014913,17 4,14.0898509 4,10.5 C4,6.91014913 6.91014913,4 10.5,4 C14.0898509,4 17,6.91014913 17,10.5 C17,14.0898509 14.0898509,17 10.5,17 Z M11,8 L11,7.5 C11,7.22385763 10.7761424,7 10.5,7 C10.2238576,7 10,7.22385763 10,7.5 L10,8 L9.5139452,8 C8.68551807,8 8.0139452,8.67157288 8.0139452,9.5 L8.0139452,10.0007567 C8.0139452,10.8291838 8.68551807,11.5007567 9.5139452,11.5007567 L11.5000049,11.5007567 C11.7761473,11.5007567 12.0000049,11.7246143 12.0000049,12.0007567 L12.0000049,12.5 C12.0000049,12.7761424 11.7761473,13 11.5000049,13 L9.01225525,13 C8.9916704,12.749839 8.78597816,12.549668 8.52914442,12.541857 C8.25312966,12.5334627 8.02257057,12.750412 8.01417627,13.0264268 L8.00023597,13.4848008 C7.99166064,13.7667682 8.21790708,14 8.5000049,14 L10,14 L10,14.4912415 C10,14.7673838 10.2238576,14.9912415 10.5,14.9912415 C10.7761424,14.9912415 11,14.7673838 11,14.4912415 L11,14 L11.5000049,14 C12.328432,14 13.0000049,13.3284271 13.0000049,12.5 L13.0000049,12.0007567 C13.0000049,11.1723296 12.328432,10.5007567 11.5000049,10.5007567 L9.5139452,10.5007567 C9.23780282,10.5007567 9.0139452,10.2768991 9.0139452,10.0007567 L9.0139452,9.5 C9.0139452,9.22385763 9.23780282,9 9.5139452,9 L11.9679559,9 C12.0222203,9.21744733 12.2188481,9.37854004 12.453101,9.37854004 C12.7292434,9.37854004 12.953101,9.15468241 12.953101,8.87854004 L12.953101,8.5 C12.953101,8.22385763 12.7292434,8 12.453101,8 L11,8 Z" fill="#44D5E9" id="Combined-Shape" />
                                            </g>
                                        </g>
                                        </g>
                                    </svg>
                                </label>
                                <div style="display: flex; flex-direction: column;">
                                    <span class="profit_count counter">0</span>
                                    <span class="fs-16">Lợi nhuận</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding: 0 15px;">
                        <button class="col s12 m6 l1 tablink m-t-5 btn"
                            onclick="openPage('customerOverview', this, '#03a9f4')" style="outline: none; border-top-left-radius: 5px; margin-right: 10px;
                                                        border-bottom-left-radius: 5px;" id="defaultOpen">Tổng
                            quan</button>
                        {{-- <button class="col s12 m6 l1 tablink m-t-5 btn" onclick="openPage('timerDetail', this, '#03a9f4')"
                            style="outline: none; border-top-right-radius: 5px;
                                                border-bottom-right-radius: 5px;">Chi tiết</button> --}}
                    </div>


                    <div id="customerOverview" class="tabcontent" style="margin: 0px -15px;">
                        <div id="errorChart" class="text-lg font-bold text-center" style="line-height: 100px;margin: 0 15px;border-radius: 5px; margin-top: 30px"></div>
                        <div id="chartProduct" style="height: 500px;"></div>
                    </div>

                    {{-- <div id="timerDetail" class="section section-data-tables tabcontent">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="timerTable" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Khách hàng</th>
                                                            <th>SL bán</th>
                                                            <th>Vốn</th>
                                                            <th>Doanh thu</th>
                                                            <th>Lợi nhuận</th>
                                                            <th>% lợi nhuận</th>
                                                            <th>Ngày</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Khách hàng</th>
                                                            <th>SL bán</th>
                                                            <th>Vốn</th>
                                                            <th>Doanh thu</th>
                                                            <th>Lợi nhuận</th>
                                                            <th>% lợi nhuận</th>
                                                            <th>Ngày</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> --}}

                    <!-- START RIGHT SIDEBAR NAV -->

                   {{-- @include('admin.theme.rightsidebar') --}}
                    <!-- END RIGHT SIDEBAR NAV -->
                    {{-- @include('admin.theme.bottomsidebar') --}}

                    <!-- users list ends -->
                </div>
                <div class="content-overlay"></div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script src="{!! asset('public/backend/assets/js/amcharts/core.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/amcharts/charts.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/amcharts/animated.js') !!}"></script>

    <script>
        $(document).ready(function() {
            $('.listProduct').on('change', function() {
                var j = $(this).attr("id");
                var m = $(this).val();
                if (m === 'daily_report') {
                    $('#product_from').val('');
                    $('#product_to').val('');
                    $("." + j).attr('disabled', 'disabled');
                } else {
                    $("." + j).removeAttr('disabled', 'disabled');
                }
            });
        });
    </script>

    <!-- Chuyển đổi tap -->
    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablink");

            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "#eee";
            }

            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }

        document.getElementById("defaultOpen").click();
    </script>

    <!-- Datepicker -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartProduct", am4charts.XYChart);
            chart.padding(40, 40, 40, 40);

            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "name";
            categoryAxis.renderer.minGridDistance = 1;
            categoryAxis.renderer.inversed = true;
            categoryAxis.renderer.grid.template.disabled = true;

            var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryY = "name";
            series.dataFields.valueX = "steps";
            series.tooltipText = "{valueX.value}"
            series.columns.template.strokeOpacity = 0;
            series.columns.template.column.cornerRadiusBottomRight = 5;
            series.columns.template.column.cornerRadiusTopRight = 5;

            var labelBullet = series.bullets.push(new am4charts.LabelBullet())
            labelBullet.label.horizontalCenter = "left";
            labelBullet.label.dx = 10;
            labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
            labelBullet.locationX = 1;

            let title = chart.titles.create();
            title.text = "Lợi nhuận cao nhất";
            title.fontSize = 25;
            title.marginBottom = 30;

            chart.legend = new am4charts.Legend();
            chart.legend.useDefaultMarker = true;
            chart.legend.labels.template.text = "Lợi nhuận";


            // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

            categoryAxis.sortBySeries = series;

            $('#product-filter').click(function() {
                var product_type = $('.listCust').val();
                var product_from = $('#product_from').val();
                var product_to = $('#product_to').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('statistic.sales.filter_by_date_product') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        product_type: product_type,
                        product_from: product_from,
                        product_to: product_to,
                        _token: _token
                    },

                    success: function(data) {
                        $('#chartProduct').show();
                        // $('#timerStatistic').css("display", "inline-table");
                        chart.setData(data.productStatistic);
                        document.getElementById('product_from').innerHTML = product_from;
                        document.getElementById('product_to').innerHTML = product_to;

                        $.each(data.productStatistic, function(index, value) {
                            $('.sales_count').html(value.sumSales);
                            $('.funds_count').html(value.sumFunds);
                            $('.profit_count').html(value.sumProfit);
                        });


                        $('#errorChart').hide();
                    },
                    error: function(data) {
                        $('#chartProduct').hide();
                        $('#errorChart').show();
                        $('#errorChart').html('Chưa có dữ liệu thống kê');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".counter").counterUp({
                delay: 10,
                time: 1200
            });
        });
    </script>

@endpush
