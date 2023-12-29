<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{!! asset('public/frontend/images/icons/favicon.png') !!}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/bootstrap/css/bootstrap.min.css') !!}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/themify-icons/themify-icons.css') !!}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/pages/flag-icon/flag-icon.min.css') !!}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/pages/menu-search/css/component.css') !!}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/pages/multi-step-sign-up/css/reset.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/backend/assets/pages/multi-step-sign-up/css/style.css') !!}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/style.css') !!}">
    <!-- Parsley.css -->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/parsley.css') !!}">
    <style>
        body{
            background: url('{!! asset('public/backend/assets/images/auth/bg.jpg') !!}') no-repeat;
            background-size: cover;
            min-height: 100vh;
        }
        #msform{
            width: 500px;
        }
        .form-group input[type="text"]{
            margin-bottom: 15px;
        }

        .form-group input[type="password"]{
            margin-bottom: 15px;
        }

        .input-group input[type="file"]{
            width: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .input-group input[type="radio"]{
            margin-right: 5px;
        }

        #reflink{
            position: absolute;
            right: 0px;
            padding: 9px;
            background: darkcyan;
            color: white;
            border-color: #016d6f;
            margin: 5px;
        }
        #file_input{
            border: none;
            position: absolute;
            top: 0px;
            left: 0px;
            padding: 10px;
            width: 78%;
            cursor: pointer;
        }
        .j-hint{
            cursor: context-menu !important;
        }
        .row{
            margin: 0;
        }
        .alert-error{
            margin: 15px 30px;
            background: crimson;
            width: 400px;
            margin-left: 50px;
            color: aliceblue;
        }
    </style>

</head>

<body class="multi-step-sign-up">
    <!-- Pre-loader start -->
    <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->
    <form id="msform" class="validate_form" action="{{ route('admin.postRegister') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Thiết lập tài khoản</li>
            <li>Mạng xã hội</li>
            <li>Thông tin cá nhân</li>
        </ul>
        <!-- fieldsets -->
        @if (session('error'))
            <div class="alert alert-error icons-alert" role="alert">
                <li style="display: block">{{ session('error') }}</li>
            </div>
        @endif
        <fieldset>
            <img class="logo" src="{!! asset('public/backend/assets/images/auth/logo-bg1.png') !!}" alt="logo.png">
            <h2 class="fs-title">Đăng ký</h2>
            <h3 class="fs-subtitle">Hãy thiết lập một số thông tin người dùng</h3>
            <div class="form-group row">
                <input type="text" class="form-control" name="userName" placeholder="Tên tài khoản" {{ old('userName') }} required data-parsley-required-message="Tên thương hiệu không được để trống" autocomplete="off">
            </div>
            <div class="form-group row">
                <input type="text" class="form-control" name="email" placeholder="E-Mail" {{ old('email') }}>
            </div>
            <div class="form-group row">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu" {{ old('password') }}>
            </div>
            <div class="form-group row">
                <input type="password" class="form-control" id="confirm_password" placeholder="Xác nhận mật khẩu">
            </div>
            <button type="button" name="next" class="btn btn-primary next" value="Next">Next</button>
        </fieldset>
        <fieldset class="">
            <img class="logo" src="{!! asset('public/backend/assets/images/auth/logo-bg1.png') !!}" alt="logo.png">
            <h2 class="fs-title">Mạng xã hội</h2>
            <h3 class="fs-subtitle">Một chút về sự hiện diện của bạn trên mạng xã hội</h3>
            <div class="form-group row">
                <input type="text" class="form-control" name="twitter" placeholder="Twitter" {{ old('twitter') }}>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control" name="facebook" placeholder="Facebook" {{ old('facebook') }}>
            </div>
            <button type="button" name="previous" class="btn btn-inverse btn-outline-inverse previous" value="Previous">Previous</button>
            <button type="button" name="next" class="btn btn-primary next" value="Next">Next</button>
        </fieldset>
        <fieldset>
            <img class="logo" src="{!! asset('public/backend/assets/images/auth/logo-bg1.png') !!}" alt="logo.png">
            <h2 class="fs-title">Thông tin cá nhân</h2>
            <h3 class="fs-subtitle">Một số thông tin về bản thân</h3>
            <div class="form-group row">
                <input type="text" class="form-control" name="firstName" placeholder="Họ" {{ old('firstName') }}>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control" name="lastName" placeholder="Tên" {{ old('lastName') }}>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" {{ old('phone') }}>
            </div>
            <div class="input-group">
                <textarea name="address" class="form-control" placeholder="Địa chỉ">{{ old('address') }}</textarea>
            </div>
            <div class="input-group">
                <div class="form-control" style="margin-right: 10px">
                    <input type="radio" value="1" name="gender"> Nam
                </div>
                <div class="form-control" style="margin-left: 10px">
                    <input type="radio" value="0" name="gender"> Nữ
                </div>
            </div>

            <div class="input-group" style="border: 1px solid #ccc">
                <div style="width: 100%">
                    <label id="reflink">Browse</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*" onchange="document.getElementById('file_input').value = this.value;">
                    <input type="text" id="file_input" readonly="" placeholder="Hình ảnh">
                </div>
            </div>
            <div class="input-group">
                <span class="j-hint">Only: .png / .jpg / .jpeg / ...</span>
            </div>
            <button type="button" name="previous" class="btn btn-inverse btn-outline-inverse previous" value="Previous">Previous</button>
            <button type="submit" id="next" class="btn btn-primary" value="submit">Submit</button>
        </fieldset>
    </form>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery/js/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-ui/js/jquery-ui.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/popper.js/js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') !!}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/modernizr/js/modernizr.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/modernizr/js/css-scrollbars.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/pages/multi-step-sign-up/js/main.js') !!}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next/js/i18next.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-i18next/js/jquery-i18next.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/common-pages.js') !!}"></script>
    <!-- My self-->
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/custom/custom.js') !!}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-23581568-13');
    </script>

    <!-- Parsley.js -->
    <script src="{!! asset('public/backend/assets/js/parsley.js') !!}"></script>

    <script>
        $(document).ready(function(){
            $('.next').click(function(){
                $('.validate_form').parsley();
            })
        });
    </script>
</body>

</html>
