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
                                <div class="col s12 m6 l2 display-flex align-items-center show-btn"
                                    style="width: 12.5%">
                                    <a href="{{ route('statistic.sales.timer') }}" class="btn btn-grd-info btn-sm m-r-5">
                                        Thời gian
                                    </a>
                                </div>

                                <div class="col s12 m6 l2 display-flex align-items-center show-btn"
                                    style="width: 14%">
                                    <a href="{{ route('statistic.sales.customer') }}"
                                        class="btn btn-grd-default btn-sm m-r-5">
                                        Khách hàng
                                    </a>
                                </div>

                                <div class="col s12 m6 l2 display-flex align-items-center show-btn">
                                    <a href="{{ route('statistic.sales.product') }}"
                                        class="btn btn-grd-default btn-sm m-r-5">
                                        Sản phẩm
                                    </a>
                                </div>
                            </div>

                            <form action="{{ route('statistic.sales.pdf-timer') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Loại thời gian</label>
                                        <div class="input-field">
                                            <select class="select2 browser-default form-control timer_type"
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
                                            <input type="text" name="timer_from" id="timer_from"
                                                class="form-control datepicker hide_input">
                                        </div>
                                    </div>

                                    <div class="col s12 m6 l4">
                                        <label for="users-list-role">Đến ngày</label>
                                        <div class="input-field">
                                            <input type="text" name="timer_to" id="timer_to"
                                                class="form-control datepicker hide_input">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12 m6 l1 display-flex align-items-center show-btn m-t-20">
                                        <button type="button" name="timer-filter" id="timer-filter"
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
                                        <button type="submit" class="btn btn-grd-info btn-sm m-r-5 sales-timer-pdf"
                                            id="sales-timer-pdf" style="display: none"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>

                                        {{-- <a href="{{ route('export_sale_excel') }}" class="btn btn-grd-info btn-sm m-r-5">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="users-list-filter section m-b-10" style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">
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

                    <div class="row" style="padding: 0 15px; margin-bottom: 15px">
                        <button class="col s12 m6 l1 tablink m-t-5 btn" onclick="openPage('timerOverview', this, '#03a9f4')"
                            style="outline: none; border-top-left-radius: 5px; margin-right: 10px;
                                            border-bottom-left-radius: 5px;" id="defaultOpen">Tổng quan</button>
                        <button class="col s12 m6 l1 tablink m-t-5 btn" onclick="openPage('timerDetail', this, '#03a9f4')"
                            style="outline: none; border-top-right-radius: 5px;
                                            border-bottom-right-radius: 5px;">Chi tiết</button>
                    </div>


                    <div id="timerOverview" class="tabcontent" style="margin: 0px -15px;">
                        <div id="errorChart" class="text-lg font-bold text-center" style="margin: 0 15px;border-radius: 5px; margin-top: 30px"></div>
                        <div id="chartTimer" style="height: 500px;"></div>
                    </div>

                    <div id="timerDetail" class="section section-data-tables tabcontent">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="timerTable" class="" style="display: none;">
                                                    <thead>
                                                        <tr>
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
                                                <div id="errorTimerStatistic" class="text-lg font-bold text-center" style="line-height: 100px;margin: 0 15px;border-radius: 5px; margin-top: 30px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/core.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/charts.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/animated.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/chart/amcharts/material.js') !!}"></script>

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
        $(document).ready(function() {
            $('.timer_type').on('change', function() {
                var j = $(this).attr("id");
                var m = $(this).val();
                if (m === 'daily_report') {
                    $('#timer_from').val('');
                    $('#timer_to').val('');
                    $("." + j).attr('disabled', 'disabled');
                } else {
                    $("." + j).removeAttr('disabled', 'disabled');
                }
            });
        });
    </script>

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_material);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartTimer", am4charts.XYChart);

            chart.colors.step = 2;
            chart.maskBullets = false;

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.renderer.minGridDistance = 50;
            dateAxis.renderer.grid.template.disabled = true;
            dateAxis.renderer.fullWidthTooltip = true;

            var distanceAxis = chart.yAxes.push(new am4charts.ValueAxis());
            distanceAxis.title.text = "Doanh Thu";
            //distanceAxis.renderer.grid.template.disabled = true;

            var durationAxis = chart.yAxes.push(new am4charts.DurationAxis());
            durationAxis.title.text = "";
            durationAxis.baseUnit = "minute";
            //durationAxis.renderer.grid.template.disabled = true;
            durationAxis.renderer.opposite = true;
            durationAxis.syncWithAxis = distanceAxis;

            durationAxis.durationFormatter.durationFormat = "";

            var latitudeAxis = chart.yAxes.push(new am4charts.ValueAxis());
            latitudeAxis.renderer.grid.template.disabled = true;
            latitudeAxis.renderer.labels.template.disabled = true;
            latitudeAxis.syncWithAxis = distanceAxis;

            // Create series
            var distanceSeries = chart.series.push(new am4charts.ColumnSeries());
            distanceSeries.dataFields.valueY = "sales";
            distanceSeries.dataFields.dateX = "period";
            distanceSeries.yAxis = distanceAxis;
            distanceSeries.tooltipText = "{valueY} VNĐ";
            distanceSeries.name = "Doanh Thu";
            distanceSeries.columns.template.fillOpacity = 0.7;
            distanceSeries.columns.template.propertyFields.strokeDasharray = "dashLength";
            distanceSeries.columns.template.propertyFields.fillOpacity = "alpha";
            distanceSeries.showOnInit = true;

            var distanceState = distanceSeries.columns.template.states.create("hover");
            distanceState.properties.fillOpacity = 0.9;

            var durationSeries = chart.series.push(new am4charts.LineSeries());
            durationSeries.dataFields.valueY = "funds";
            durationSeries.dataFields.dateX = "period";
            durationSeries.yAxis = durationAxis;
            durationSeries.name = "Vốn";
            durationSeries.strokeWidth = 2;
            durationSeries.propertyFields.strokeDasharray = "dashLength";
            durationSeries.tooltipText = "{valueY} VNĐ";
            durationSeries.showOnInit = true;

            var durationBullet = durationSeries.bullets.push(new am4charts.Bullet());
            var durationRectangle = durationBullet.createChild(am4core.Rectangle);
            durationBullet.horizontalCenter = "middle";
            durationBullet.verticalCenter = "middle";
            durationBullet.width = 7;
            durationBullet.height = 7;
            durationRectangle.width = 7;
            durationRectangle.height = 7;

            var durationState = durationBullet.states.create("hover");
            durationState.properties.scale = 1.2;

            var latitudeSeries = chart.series.push(new am4charts.LineSeries());
            latitudeSeries.dataFields.valueY = "profit";
            latitudeSeries.dataFields.dateX = "period";
            latitudeSeries.yAxis = latitudeAxis;
            latitudeSeries.name = "Lợi nhuận";
            latitudeSeries.strokeWidth = 2;
            latitudeSeries.propertyFields.strokeDasharray = "dashLength";
            latitudeSeries.tooltipText = "Lợi nhuận: {valueY}";
            latitudeSeries.showOnInit = true;

            var latitudeBullet = latitudeSeries.bullets.push(new am4charts.CircleBullet());
            latitudeBullet.circle.fill = am4core.color("#fff");
            latitudeBullet.circle.strokeWidth = 2;
            latitudeBullet.circle.propertyFields.radius = "townSize";

            var latitudeState = latitudeBullet.states.create("hover");
            latitudeState.properties.scale = 1.2;

            var latitudeLabel = latitudeSeries.bullets.push(new am4charts.LabelBullet());
            latitudeLabel.label.text = "";
            latitudeLabel.label.horizontalCenter = "left";
            latitudeLabel.label.dx = 14;

            // Add legend
            chart.legend = new am4charts.Legend();

            // Add cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.fullWidthLineX = true;
            chart.cursor.xAxis = dateAxis;
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineX.fill = am4core.color("#000");
            chart.cursor.lineX.fillOpacity = 0.1;

            $('#timer-filter').click(function() {
                var timer_type = $('#timer_type').val();
                var timer_from = $('#timer_from').val();
                var timer_to = $('#timer_to').val();
                var _token = $('input[name="_token"]').val();

                var table = $('#timerTable tbody');

                $.ajax({
                    url: '{{ route('statistic.sales.filter_by_date_timer') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        timer_type: timer_type,
                        timer_from: timer_from,
                        timer_to: timer_to,
                        _token: _token
                    },

                    success: function(data) {
                        $('#chartTimer').show();
                        $('#sales-timer-pdf').show();
                        $('#timerTable').css("display", "inline-table");
                        chart.setData(data.timeStatistic);

                        document.getElementById('timer_from').innerHTML = timer_from;
                        document.getElementById('timer_to').innerHTML = timer_to;

                        $.each(data.timeStatistic, function(index, value) {
                            $('.sales_count').html(value.sumSales);
                            $('.funds_count').html(value.sumFunds);
                            $('.profit_count').html(value.sumProfit);
                        });

                        $('.customer_name').empty();
                        $('.quantity').empty();
                        $('.fundDt').empty();
                        $('.salesDt').empty();
                        $('.profitDt').empty();
                        $('.percentDt').empty();
                        $('.orderDate').empty();

                        $.each(data.timeOrder, function(index, value) {
                            table.append(`<tr>
                                <td>
                                    <span>${value.customer_name}</span>
                                </td>
                                <td>
                                    <span>${value.quantity}</span>
                                </td>
                                <td>
                                    <span>${value.fundDt}</span>
                                </td>
                                <td>
                                    <span>${value.salesDt}</span>
                                </td>
                                <td>
                                    <span>${value.profitDt}</span>
                                </td>
                                <td>
                                    <span>${value.percentDt}%</span>
                                </td>
                                <td>
                                    <span>${value.orderDate}</span>
                                </td>
                            </tr>`);
                        });

                        $('#timerTable').DataTable();
                        $('#errorChart').hide();
                        $('#errorTimerStatistic').hide();
                    },
                    error: function(data) {
                        $('#chartTimer').hide();
                        $('#errorChart').show();
                        $('#errorTimerStatistic').show();
                        $('#timerTable').css("display", "none");
                        $('#errorChart').html('Chưa có dữ liệu thống kê');
                        $('#errorTimerStatistic').html('Chưa có dữ liệu thống kê');
                        $('.sales_count').html(0);
                        $('.funds_count').html(0);
                        $('.profit_count').html(0);
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#sales-timer-excel').click(function(e){
                var timer_type = $('.timer_type').val();
                var timer_from = $('#timer_from').val();
                var timer_to = $('#timer_to').val();


                $.ajax({
                    url: '{{ route('export_sale_excel') }}',
                    method: 'GET',
                    data: {
                        timer_type: timer_type,
                        timer_from: timer_from,
                        timer_to: timer_to,
                    },
                    success:function(data, status, xhr) {

                    },
                });
            });
        });
    </script> --}}
@endpush
