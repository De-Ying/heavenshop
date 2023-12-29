@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/jquery.mCustomScrollbar.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/statistic.css') !!}">
    <style>
        .umi{
            border-top: 1px solid #ccc;
        }
        /* ::-webkit-scrollbar {
            width: 20px;
        }

        ::-webkit-scrollbar-thumb {
            background: #404E67;
            border-radius: 10px;
        } */
    </style>
@endpush
@section('admin_content')
@include('admin.theme.sidebar.dashboardIM')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">

            {!! Toastr::message() !!}

            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Trang quản trị hệ thống xây dựng website bán quần áo</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard') !!}">
                                            <i class="fa fa-dashboard"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Home</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        {{-- <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-blue f-w-600 counter">{{ $totalOrder }}</h4>
                                            <h6 class="text-muted m-b-0" style="text-transform: uppercase;">Tổng số đơn hàng</h6>
                                        </div>
                                        <div class="text-right col-4">
                                            <i class="icofont icofont-cart f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-blue">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0"><i class="text-white feather icon-clock f-14 m-r-10"></i>Cập nhật : {{ $timer }}</p>
                                        </div>
                                        <div class="text-right col-3">
                                            <a href="{{ route('m-order.manage_order') }}"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-pink f-w-600 counter">{{ $totalCustomer }}</h4>
                                            <h6 class="text-muted m-b-0" style="text-transform: uppercase;">Thành viên</h6>
                                        </div>
                                        <div class="text-right col-4">
                                            <i class="icofont icofont-users-alt-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-pink">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0"><i class="text-white feather icon-clock f-14 m-r-10"></i>Cập nhật : {{ $timer }}</p>
                                        </div>
                                        <div class="text-right col-3">
                                            <a href="{{ route('customer.view_all') }}"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green f-w-600 counter">{{ $totalProduct }}</h4>
                                            <h6 class="text-muted m-b-0" style="text-transform: uppercase;">Sản phẩm</h6>
                                        </div>
                                        <div class="text-right col-4">
                                            <i class="fa fa-scribd f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0"><i class="text-white feather icon-clock f-14 m-r-10"></i>Cập nhật : {{ $timer }}</p>
                                        </div>
                                        <div class="text-right col-3">
                                            <a href="{{ route('product.view_all') }}"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-yellow f-w-600 counter">{{ $totalRating }}</h4>
                                            <h6 class="text-muted m-b-0" style="text-transform: uppercase;">Đánh giá</h6>
                                        </div>
                                        <div class="text-right col-4">
                                            <i class="fa fa-commenting f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-yellow">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0"><i class="text-white feather icon-clock f-14 m-r-10"></i>Cập nhật : {{ $timer }}</p>
                                        </div>
                                        <div class="text-right col-3">
                                            <a href="{{ route('m-order.manage_order') }}"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Biểu đồ doanh thu các ngày trong tháng</h5>
                                    <form autocomplete="off" class="h-130">
                                        @csrf

                                        <div class="float-left col-md-3" style="padding: 10px 10px 0 0;">
                                            <p>Từ ngày: <input type="text" id="start_order" class="form-control m-t-5"></p>
                                            <input type="button" id="dashboard-filter-btn" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
                                        </div>

                                        <div class="float-left col-md-3" style="padding: 10px 0 0 10px;">
                                            <p>Đến ngày: <input type="text" id="end_order" class="form-control m-t-5"></p>
                                        </div>

                                        <div class="float-left col-md-3" style="padding: 10px 0 0 20px;">
                                            <p>Lọc theo:
                                                <select class="form-control filter-date m-t-5">
                                                    <option disabled selected>----- Chọn -----</option>
                                                    <option value="lastYear">Năm qua</option>
                                                    <option value="lastMonth">Tháng trước</option>
                                                    <option value="lastweek">Tuần trước</option>
                                                    <option value="thisMonth">Tháng này</option>
                                                </select>
                                            </p>
                                        </div>
                                    </form>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-trash-2 close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div id="chart" class="h-300"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Thống kê trạng thái đơn hàng</h5>
                                    <span class="text-muted">Source: <a href="https://www.chartjs.org/" target="_blank"> CharJS</a></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-minus minimize-card" style="margin: 0 10px"></i></li>
                                            <li><i class="feather icon-trash-2 close-card" style="margin: 0 10px"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="height: 477px;">
                                    <canvas id="orderStatus" width="400" height="400" style="margin: 15px 0;"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-md-12">
                            <div class="card card1">
                                <div class="card-header">
                                    <h5 class="text-center">Danh sách các đơn hàng mới</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-minus minimize-card" style="margin: 0 10px"></i></li>
                                            <li><i class="feather icon-trash-2 close-card" style="margin: 0 10px"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="overflow-y: scroll;
                                height: auto;">
                                    <div class="table-responsive">
                                        <div class="table-content">
                                            <div class="project-table">
                                                <table id="BrandTable"
                                                    class="table dt-responsive nowrap table-hover" style="width: 100%;" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Thông tin khách hàng</th>
                                                            <th>Số hóa đơn</th>
                                                            <th>Trạng thái</th>
                                                            <th>Thời gian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @if (!$orders->isEmpty())
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td class="pro-list-img">
                                                                        {{ $stt++ }}
                                                                    </td>
                                                                    <td class="pro-name">
                                                                        <span>
                                                                            <ul>
                                                                                <li style="list-style: disc; margin-left: 30px;">Tên: {{ $order->customer->customer_name }}</li>
                                                                                <li style="list-style: disc; margin-left: 30px;">E-Mail: {{ $order->customer->customer_email }}</li>
                                                                                <li style="list-style: disc; margin-left: 30px;">SĐT: {{ $order->customer->customer_phone }}</li>
                                                                            </ul>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        {{ $order->order_code }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->order_status == 1)
                                                                            <label class="btn btn-grd-primary btn-mini waves-effect waves-light">
                                                                                Đang chờ xử lý
                                                                            </label>
                                                                        @elseif ($order->order_status == 2)
                                                                            <label class="btn btn-grd-success btn-mini waves-effect waves-light">
                                                                                Đã xử lý
                                                                            </label>
                                                                        @elseif ($order->order_status == 3)
                                                                            <label class="btn btn-grd-danger btn-mini waves-effect waves-light">
                                                                                Đã hủy
                                                                            </label>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->order_date }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <td colspan="5" class="text-center">
                                                                Hiện tại chưa có đơn hàng mới
                                                            </td>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-xl-4 col-md-12">
                            <div class="card card1">
                                <div class="card-header">
                                    <h5 class="text-center">Top sản phẩm bán chạy</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-minus minimize-card" style="margin: 0 10px"></i></li>
                                            <li><i class="feather icon-trash-2 close-card" style="margin: 0 10px"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="overflow-y: scroll;
                                height: auto;">
                                    @if ($topPayProducts->count() > 0)
                                        @foreach ($topPayProducts as $topPayProduct)
                                            <div class="row umi">
                                                <div class="col-sm-8 m-t-10 m-b-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <img src="{{ asset('public/uploads/product/'.$topPayProduct->product_image) }}" alt="{{ $topPayProduct->product_name }}" width="65px">
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <ul class="list list-unstyled">
                                                                <li><a href="{{ route('product_detail', ['product_slug' => $topPayProduct->product_slug]) }}" class="text-semibold">{{ $topPayProduct->product_name }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 m-t-10 m-b-10">
                                                    <ul class="text-right list list-unstyled">
                                                        <li>
                                                            <label class="btn btn-grd-warning btn-mini waves-effect waves-light">
                                                                {{ number_format($topPayProduct->product_price, 0, ',','.') . ' ' . '₫' }}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row umi">
                                            <div class="col-sm-12 m-t-20 m-b-10">
                                                Hiện tại chưa thống kê sản phẩm bán chạy
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div style="height: 500px">
                        <div class="float-left col-md-6">
                            <p class="text-lg font-bold text-center m-b-30">Thống kê tổng sản phẩm, bài viết, đơn hàng, khách hàng</p>
                            <div id="integrated_statistics"></div>
                        </div>

                    </div> --}}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script type="text/javascript" src="{!! asset('public/backend/assets/js/counter/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/counter/jquery.waypoints.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/counter/jquery.counterup.min.js') !!}"></script>
    <!-- Required Jquery -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-ui/js/jquery-ui.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/popper.js/js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') !!}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/modernizr/js/modernizr.js') !!}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/chart.js/js/chart.min.js') !!}"></script>
    <!-- amchart js -->
    <script src="{!! asset('public/backend/assets/pages/widget/amchart/amcharts.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/pages/widget/amchart/serial.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/pages/widget/amchart/light.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/jquery.mCustomScrollbar.concat.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/SmoothScroll.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/pcoded.min.js') !!}"></script>
    <!-- custom js -->
    <script src="{!! asset('public/backend/assets/js/vartical-layout.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/pages/dashboard/custom-dashboard.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/script.min.js') !!}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <!-- My self-->
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/custom/custom.js') !!}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    {{-- {{-- <script>
        var xValues = ["Đang chờ xử lý", "Đã xử lý", "Hủy bỏ"];
        var yValues = [{{ $pending }}, {{ $processed }}, {{ $cancel }}];
        var barColors = [
            "rgb(0,0,255)",
            "rgb(0,128,0)",
            "rgb(255, 0, 0)"
        ];

        new Chart("orderStatus", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            top: 50,
                            bottom: 20
                        },

                    }
            }
        });

        </script>

    <!-- Amchart -->
    <script src="{!! asset('public/backend/assets/js/amcharts/core.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/amcharts/charts.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/amcharts/animated.js') !!}"></script>

    <script>
        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("order_status", am4charts.PieChart3D);

            chart.legend = new am4charts.Legend();

            chart.data = [ {
                "label": "Đang chờ xử lý",
                "value": {{ $pending }}
            }, {
                "label": "Đã xử lý / Đang giao hàng",
                "value": {{ $processed }}
            }, {
                "label": "Hủy bỏ",
                "value": {{ $cancel }}
            }, ];


            var pieSeries = chart.series.push(new am4charts.PieSeries3D());
            pieSeries.dataFields.value = "value";
            pieSeries.dataFields.category = "label";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;

            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;
        });
    </script> --}} --}}

    <!-- Statistic -->
    <script src="{!! asset('public/backend/assets/js/morris/raphael-min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/morris/morris.min.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            chart60daysorder();

            var chart =  new Morris.Bar({
                // ID của phần tử để vẽ biểu đồ.
                element: 'chart',
                // Lựa chọn màu sắc
                lineColors: ['#819C73', '#fc8710', '#FF6541', '#A4ADD3', '#766B56', '#f00000'],
                // Màu điểm
                pointFillColors: ['#ffffff'],
                // Màu viền điểm
                pointStrokeColors: ['#000000'],
                // Sử dụng cho Area Chart
                fillOpacity: 0.6,
                hideHover: 'auto',
                // Đặt thành false để bỏ qua phân tích thời gian / ngày cho các giá trị X, thay vào đó coi chúng như một chuỗi cách đều nhau.
                parseTime: false,
                // Đặt thành true để chồng các vùng lên nhau thay vì xếp chồng chúng.
                behaveLikeLine: true,
                // Tên của thuộc tính bản ghi dữ liệu có chứa giá trị x.
                xkey: 'period',
                // Danh sách tên của các thuộc tính bản ghi dữ liệu có chứa giá trị y.
                ykeys: ['order', 'sales', 'profit', 'quantity', 'percent'],
                // Nhãn cho các khóa - sẽ được hiển thị khi bạn di chuột qua biểu đồ.
                labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng', 'Phần trăm (%)']
            });

            function chart60daysorder(){

                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('days_order') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data:{_token:_token},

                    success:function(data){
                        chart.setData(data);
                    }
                });
            }

            $('.filter-date').change(function(){

                var filter_value = $(this).val();
                var _token    = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('filter_by_select') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {filter_value: filter_value, _token:_token},

                    success:function (data) {
                        chart.setData(data);
                    }
                });
            });


            $('#dashboard-filter-btn').click(function(){

                var from_date = $('#start_order').val();
                var to_date   = $('#end_order').val();
                var _token    = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('filter_by_date') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {from_date: from_date, to_date:to_date, _token:_token},

                    success:function (data) {
                        chart.setData(data);
                        document.getElementById('start_order').innerHTML = from_date;
                        document.getElementById('start_order').innerHTML = to_date;
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(".counter").counterUp({
                delay: 10,
                time: 1200
            });
        });
    </script>
@endpush
