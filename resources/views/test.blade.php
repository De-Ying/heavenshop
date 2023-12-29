<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/> --}}
    <style>
        html {
            font-family: sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        a:active,
        a:hover {
            outline: 0
        }

        b,
        strong {
            font-weight: 700
        }

        small {
            font-size: 80%
        }

        table {
            border-spacing: 0;
            border-collapse: collapse
        }

        td,
        th {
            padding: 0
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        html {
            font-size: 10px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff
        }

        a {
            color: #337ab7;
            text-decoration: none
        }

        a:focus,
        a:hover {
            color: #23527c;
            text-decoration: underline
        }

        a:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px
        }

        .text-left {
            text-align: left
        }

        .text-right {
            text-align: right
        }

        .text-center {
            text-align: center
        }

        .text-justify {
            text-align: justify
        }

        .text-nowrap {
            white-space: nowrap
        }

        .text-lowercase {
            text-transform: lowercase
        }

        .text-uppercase {
            text-transform: uppercase
        }

        .text-capitalize {
            text-transform: capitalize
        }

        .text-danger {
            color: #a94442;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .small,
        small {
            font-size: 85%
        }

        address {
            margin-bottom: 20px;
            font-style: normal;
            line-height: 1.42857143
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .btn-group-sm>.btn, .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }

        .btn.active, .btn:active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);
            box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);
        }

        .btn.focus, .btn:focus, .btn:hover {
            color: #333;
            text-decoration: none;
        }

        @media (min-width:768px) {
            .container {
                width: 750px
            }
        }

        @media (min-width:992px) {
            .container {
                width: 970px
            }
        }

        @media (min-width:1200px) {
            .container {
                width: 1170px
            }
        }

        .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            margin-right: -15px;
            margin-left: -15px
        }

        .col-md-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px
        }

        @media (min-width:992px) {
            .col-md-12 {
                float: left;
            }

            .col-md-12 {
                width: 100%
            }
        }

        table {
            background-color: transparent
        }

        th {
            text-align: left
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px
        }

        thead {
            display: table-header-group
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd
        }

        .table>thead>tr>th:first-child {
            border-top: none;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd
        }

        .table>tbody+tbody {
            border-top: 2px solid #ddd
        }

        .table .table {
            background-color: #fff
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto
        }

        @media screen and (max-width:767px) {
            .table-responsive {
                width: 100%;
                margin-bottom: 15px;
                overflow-y: hidden;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                border: 1px solid #ddd
            }
            .table-responsive>.table {
                margin-bottom: 0
            }
            .table-responsive>.table>tbody>tr>td,
            .table-responsive>.table>tbody>tr>th,
            .table-responsive>.table>tfoot>tr>td,
            .table-responsive>.table>tfoot>tr>th,
            .table-responsive>.table>thead>tr>td,
            .table-responsive>.table>thead>tr>th {
                white-space: nowrap
            }
            .table-responsive>.table-bordered {
                border: 0
            }
            .table-responsive>.table-bordered>tbody>tr>td:first-child,
            .table-responsive>.table-bordered>tbody>tr>th:first-child,
            .table-responsive>.table-bordered>tfoot>tr>td:first-child,
            .table-responsive>.table-bordered>tfoot>tr>th:first-child,
            .table-responsive>.table-bordered>thead>tr>td:first-child,
            .table-responsive>.table-bordered>thead>tr>th:first-child {
                border-left: 0
            }
            .table-responsive>.table-bordered>tbody>tr>td:last-child,
            .table-responsive>.table-bordered>tbody>tr>th:last-child,
            .table-responsive>.table-bordered>tfoot>tr>td:last-child,
            .table-responsive>.table-bordered>tfoot>tr>th:last-child,
            .table-responsive>.table-bordered>thead>tr>td:last-child,
            .table-responsive>.table-bordered>thead>tr>th:last-child {
                border-right: 0
            }
            .table-responsive>.table-bordered>tbody>tr:last-child>td,
            .table-responsive>.table-bordered>tbody>tr:last-child>th,
            .table-responsive>.table-bordered>tfoot>tr:last-child>td,
            .table-responsive>.table-bordered>tfoot>tr:last-child>th {
                border-bottom: 0
            }
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        .f-w-600 {
            font-weight: 600;
        }
        /* Font */
        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            transform: translate(0, 0)
        }

        .fa-lg {
            font-size: 1.33333333em;
            line-height: .75em;
            vertical-align: -15%
        }

        .fa-fw {
            width: 1.28571429em;
            text-align: center
        }

        .fa-file:before {
            content: "\f15b"
        }

        .fa-print:before {
            content: "\f02f"
        }

        .fa-plus:before {
            content: "\f067"
        }

        .fa-minus:before {
            content: "\f068"
        }

        .fa-globe:before {
            content: "\f0ac"
        }

        .fa-phone:before {
            content: "\f095"
        }

         .pull-right {
            float: right
        }

        .pull-left {
            float: left
        }

        .fa.pull-left {
            margin-right: .3em
        }

        .fa.pull-right {
            margin-left: .3em
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="col-md-12">
        <div class="invoice">
            <div class="invoice-company text-inverse f-w-600">
                <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5">
                        <img src="https://i.postimg.cc/FKRc22wJ/pdf.png"> Print
                    </a>
                </span>
                <img src="https://i.postimg.cc/L69mN1CC/2.png" alt="HEAVEN SHOP">
            </div>

            <div class="invoice-header">
                <div class="invoice-from">
                <small>Từ</small>
                <address class="m-t-5 m-b-5">
                    <strong class="text-inverse">HEAVEN SHOP</strong><br>
                    126 Lê Lợi<br>
                    Hà Đông, Hà Nội<br>
                    Phone: (033) 261-8488<br>
                    Fax: (123) 456-7890
                </address>
                </div>
                <div class="invoice-to">
                <small>to</small>
                <address class="m-t-5 m-b-5">
                    <strong class="text-inverse">Company Name</strong><br>
                    Street Address<br>
                    City, Zip Code<br>
                    Phone: (123) 456-7890<br>
                    Fax: (123) 456-7890
                </address>
                </div>
                <div class="invoice-date">
                <small>Invoice / July period</small>
                <div class="date text-inverse m-t-5">August 3,2012</div>
                <div class="invoice-detail">
                    #0000123DSS<br>
                    Services Product
                </div>
                </div>
            </div>
            <!-- end invoice-header -->
            <!-- begin invoice-content -->
            <div class="invoice-content">
                <!-- begin table-responsive -->
                <div class="table-responsive">
                <table class="table table-invoice table-hover">
                    <thead>
                        <tr>
                            <th style="border-top: none">TASK DESCRIPTION</th>
                            <th class="text-center" style="border-top: none" width="10%">RATE</th>
                            <th class="text-center" style="border-top: none" width="10%">HOURS</th>
                            <th class="text-right" style="border-top: none" width="20%">LINE TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <span class="text-inverse">Website design &amp; development</span><br>
                            <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                            </td>
                            <td class="text-center">$50.00</td>
                            <td class="text-center">50</td>
                            <td class="text-right">$2,500.00</td>
                        </tr>
                        <tr>
                            <td>
                            <span class="text-inverse">Branding</span><br>
                            <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                            </td>
                            <td class="text-center">$50.00</td>
                            <td class="text-center">40</td>
                            <td class="text-right">$2,000.00</td>
                        </tr>
                        <tr>
                            <td>
                            <span class="text-inverse">Redesign Service</span><br>
                            <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                            </td>
                            <td class="text-center">$50.00</td>
                            <td class="text-center">50</td>
                            <td class="text-right">$2,500.00</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!-- end table-responsive -->
                <!-- begin invoice-price -->
                <div class="invoice-price">
                <div class="invoice-price-left">
                    <div class="invoice-price-row">
                        <div class="sub-price">
                            <small>SUBTOTAL</small>
                            <span class="text-inverse">$4,500.00</span>
                        </div>
                        <div class="sub-price">
                        <img src="https://i.postimg.cc/RFrtNGgP/add.png" alt="">
                        </div>
                        <div class="sub-price">
                            <small>PAYPAL FEE (5.4%)</small>
                            <span class="text-inverse">$108.00</span>
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right">
                    <small>TOTAL</small> <span class="f-w-600">$4508.00</span>
                </div>
                </div>
                <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note">
                * Make all cheques payable to [Your Company Name]<br>
                * Payment is due within 30 days<br>
                * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                THANK YOU FOR YOUR BUSINESS
                </p>
                <p class="text-center">
                <span class="m-r-10">
                <img src="https://i.postimg.cc/MT9JT3DR/global.png" alt="#">


                matiasgallipoli.com</span>
                <span class="m-r-10"><img src="https://i.postimg.cc/26sMVpW1/phone-call.png" alt="#"> T:016-18192302</span>
                <span class="m-r-10"><img src="https://i.postimg.cc/y8LG0394/email.png" alt="#"> rtiemps@gmail.com</span>
                </p>
            </div>
            <!-- end invoice-footer -->
        </div>
    </div>
    </div>
</body>
</html>

