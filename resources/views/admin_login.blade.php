<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
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
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/assets/css/style.css') !!}">
    <!-- Parsley.css -->
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/parsley.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/backend/assets/css/toastr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/css/grid.css') !!}">
    <script src="{!! asset('public/backend/assets/js/toastr/jquery.min.js') !!}"></script>
    <script src="{!! asset('public/backend/assets/js/toastr/toastr.min.js') !!}"></script>
    <style>
        .parsley-errors-list {
            font-size: 1rem;
        }
    </style>
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="l-12">
                    <form class="md-float-material form-material" action="{!! route('admin.postLogin') !!}" method="post"
                        id="validate_form">
                        @csrf
                        <div class="text-center">
                            <img height="60px" src="{!! asset('public/backend/assets/images/auth/avatar.png') !!}" alt="logo.png">
                        </div>

                        {!! Toastr::message() !!}

                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Đăng nhập</h3>
                                    </div>
                                </div>

                                <div class="form-group form-primary">
                                    <input type="text" class="form-control" name="email" placeholder="E-Mail" required
                                        data-parsley-required-message="* E-Mail không được để trống" required
                                        data-parsley-pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                        data-parsley-trigger="keyup"
                                        data-parsley-pattern-message="* E-Mail không đúng định dạng" autocomplete="off">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                                        required="" data-parsley-required-message="* Mật khẩu mới không được để trống"
                                        data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$"
                                        data-parsley-trigger="keyup"
                                        data-parsley-pattern-message="* Mật khẩu phải dài từ 8-16 kí tự, bao gồm 1 chữ viết hoa và 1 chữ viết thường"
                                        autocomplete="off">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="text-left row m-t-25">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="remember">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Nhớ đăng nhập</span>
                                            </label>
                                        </div>
                                        <div class="text-right forgot-phone f-right">
                                            <a href="{!! route('admin.forgot_password') !!}" class="text-right f-w-600"> Quên mật
                                                khẩu?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <input type="submit"
                                            class="text-center btn btn-primary btn-md btn-block waves-effect m-b-20"
                                            value="LOGIN">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script type="text/javascript" src="{!! asset('public/backend/assets/js/custom/custom.js') !!}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <!-- Parsley.js -->
    <script src="{!! asset('public/backend/assets/js/parsley.js') !!}"></script>

    <script>
        $(document).ready(function() {
            $('#validate_form').parsley();
        });
    </script>
</body>

</html>
