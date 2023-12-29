<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đặt lại mật khẩu</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{!! asset('public/frontend/images/icons/favicon.png') !!}" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/bower_components/bootstrap/css/bootstrap.min.css') !!}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/themify-icons/themify-icons.css') !!}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/icon/icofont/css/icofont.css') !!}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/style.css') !!}">
    <!-- Parsley.css -->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/parsley.css') !!}">

    <style>
        strong{
            color: red;
        }
    </style>
</head>

<body class="fix-menu">
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
    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <img src="{!! asset('public/backend/assets/images/auth/avatar.png') !!}" alt="logo.png'">
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success icons-alert m-t-15" role="alert" style="width: 450px; margin: auto">
                            <li style="display: block">{{ session('success') }}</li>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger icons-alert m-t-15" role="alert" style="width: 450px; margin: auto">
                            <li style="display: block">{{ session('error') }}</li>
                        </div>
                    @endif

                    @php
                        $token = $_GET['token'];
                        $email = $_GET['email'];
                    @endphp

                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Đặt lại mật khẩu</h3>
                                </div>
                            </div>
                            <form action="{{ route('admin.update_password') }}" method="post" id="validate_form">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <h6>Mật khẩu <strong>*</strong></h6>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" required=""
                                    data-parsley-required-message="* Mật khẩu mới không được để trống"
                                    data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                    data-parsley-trigger="keyup"
                                    data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                    autocomplete="off">
                                </div>
                                <h6>Xác nhận mật khẩu <strong>*</strong></h6>
                                <div class="form-group">
                                    <input type="password" class="form-control" required=""
                                    data-parsley-required-message="* Xác nhận mật khẩu không được để trống"
                                    data-parsley-equalto="#password"
                                    data-parsley-trigger="keyup"
                                    data-parsley-equalto-message="* Mật khẩu mới và Mật khẩu xác nhận không giống nhau"
                                    data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                    data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                    autocomplete="off">
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="text-center btn btn-primary btn-md btn-block waves-effect m-b-20">Khôi phục</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-left text-inverse m-b-0">Thank you.</p>
                                    <p class="text-left text-inverse"><a href="{{ route('home_page') }}"><b class="f-w-600">Trở lại website</b></a></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-right f-w-600">➽ <a href="{{ route('admin.getLogin') }}">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next/js/i18next.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/bower_components/jquery-i18next/js/jquery-i18next.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/common-pages.js') !!}"></script>
    <!-- Parsley.js -->
    <script src="{!! asset('public/backend/assets/js/parsley.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#validate_form').parsley();
        });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
    </script>
</body>

</html>
