<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>
    <!-- TOKEN -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <!-- FAVICON -->
    <link rel="apple-touch-icon" href="{!! asset('public/backend/app-assets/images/favicon/apple-touch-icon-152x152.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('public/backend/app-assets/images/favicon/favicon-32x32.png') !!}">

    <!-- FONT -->
    <link href="{!! asset('public/backend/app-assets/fonts/material-icon/all.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/fonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/fonts/flag-icons/css/flag-icon.css') !!}">

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/flag-icon/css/flag-icon.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css') !!}">
    {{-- <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/app-assets/vendors/data-tables/css/dataTables.checkboxes.css') !!}"> --}}
    <!-- END: VENDOR CSS-->

    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/themes/vertical-dark-menu-template/materialize.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/themes/vertical-dark-menu-template/style.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/dashboard.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/data-tables.min.css') !!}">
    <!-- END: Page Level CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/custom/custom.css') !!}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Sweetalert2 CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/sweetalert2/sweetalert2.css') !!}">
    <!-- END: Sweetalert2 CSS-->

    <!-- BEGIN: Select2 CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/select2/select2-materialize.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/select2/select2.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/form-select2.min.css') !!}">
    <!-- END: Select2 CSS-->

    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/page-users.min.css') !!}">

    <!-- BEGIN: Tagsinput CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/bootstrap-tagsinput.css') !!}">
    <!-- END: Tagsinput CSS-->
    <link rel="stylesheet" href="{!! asset('public/backend/app-assets/css/toastr/toastr.min.css') !!}">

    <!-- BEGIN: Uploads File  -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/vendors/dropify/css/dropify.min.css') !!}">
    <!-- BEGIN: Uploads File -->

    <!-- BEGIN: Invoice APP  -->
    {{-- <link rel="stylesheet" type="text/css" href="{!! asset('public/backend/app-assets/css/pages/app-invoice.min.css') !!}"> --}}
    <!-- BEGIN: Invoice APP -->

    <script src="{{ asset('public/backend/app-assets/js/toastr/jquery.min.js') }}"></script>
    <script src="{{ asset('public/backend/app-assets/js/toastr/toastr.min.js') }}"></script>

    @stack('css')
</head>
<!-- END: Head-->

<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns "
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Navbar -->
    @include('admin.theme.navbar')
    <!-- END: Navbar-->

    <ul class="display-none" id="default-search-main">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">FILES</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{!! asset('public/backend/app-assets/images/icon/pdf-image.png') !!}" width="24" height="30"
                                alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Two new item
                                submitted</span><small class="grey-text">Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">17kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{!! asset('public/backend/app-assets/images/icon/doc-image.png') !!}" width="24" height="30"
                                alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file
                                Generator</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">550kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{!! asset('public/backend/app-assets/images/icon/xls-image.png') !!}" width="24" height="30"
                                alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File
                                Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">20kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{!! asset('public/backend/app-assets/images/icon/jpg-image.png') !!}" width="24" height="30"
                                alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">37kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">MEMBERS</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{!! asset('public/backend/app-assets/images/avatar/avatar-7.png') !!}"
                                width="30" alt="sample image">
                        </div>
                        <div class="member-info display-flex flex-column"><span class="black-text">John
                                Doe</span><small class="grey-text">UI designer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{!! asset('public/backend/app-assets/images/avatar/avatar-8.png') !!}"
                                width="30" alt="sample image">
                        </div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Michal
                                Clark</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{!! asset('public/backend/app-assets/images/avatar/avatar-10.png') !!}"
                                width="30" alt="sample image">
                        </div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Milena
                                Gibson</span><small class="grey-text">Digital Marketing</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{!! asset('public/backend/app-assets/images/avatar/avatar-12.png') !!}"
                                width="30" alt="sample image">
                        </div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna
                                Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="display-none" id="page-search-title">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">PAGES</h6>
            </a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
        <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span
                    class="material-icons">error_outline</span><span class="member-info">No results
                    found.</span></a></li>
    </ul>


    <!-- BEGIN: Yield content -->

    @yield('admin_content')

    <!-- END: Yield content -->

    <!-- Theme Customizer -->

    <a href="#" data-target="theme-cutomizer-out"
        class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger">
        <span class="material-icons">
            <i class="fa fa-cog"></i>
        </span>
    </a>

    <div id="theme-cutomizer-out" class="theme-cutomizer sidenav row">
        <div class="col s12">
            <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
            <h5 class="theme-cutomizer-title">Theme Customizer</h5>
            <p class="medium-small">Customize & Preview in Real Time</p>
            <div class="menu-options">
                <h6 class="mt-6">Menu Options</h6>
                <hr class="customize-devider">
                <div class="menu-options-form row">
                    <div class="mb-0 input-field col s12 menu-color">
                        <p class="mt-0">Menu Color</p>
                        <div class="gradient-color center-align">
                            <span class="menu-color-option gradient-45deg-indigo-blue"
                                data-color="gradient-45deg-indigo-blue"></span>
                            <span class="menu-color-option gradient-45deg-purple-deep-orange"
                                data-color="gradient-45deg-purple-deep-orange"></span>
                            <span class="menu-color-option gradient-45deg-light-blue-cyan"
                                data-color="gradient-45deg-light-blue-cyan"></span>
                            <span class="menu-color-option gradient-45deg-purple-amber"
                                data-color="gradient-45deg-purple-amber"></span>
                            <span class="menu-color-option gradient-45deg-purple-deep-purple"
                                data-color="gradient-45deg-purple-deep-purple"></span>
                            <span class="menu-color-option gradient-45deg-deep-orange-orange"
                                data-color="gradient-45deg-deep-orange-orange"></span>
                            <span class="menu-color-option gradient-45deg-green-teal"
                                data-color="gradient-45deg-green-teal"></span>
                            <span class="menu-color-option gradient-45deg-indigo-light-blue"
                                data-color="gradient-45deg-indigo-light-blue"></span>
                            <span class="menu-color-option gradient-45deg-red-pink"
                                data-color="gradient-45deg-red-pink"></span>
                        </div>
                        <div class="solid-color center-align">
                            <span class="menu-color-option red" data-color="red"></span>
                            <span class="menu-color-option purple" data-color="purple"></span>
                            <span class="menu-color-option pink" data-color="pink"></span>
                            <span class="menu-color-option deep-purple" data-color="deep-purple"></span>
                            <span class="menu-color-option cyan" data-color="cyan"></span>
                            <span class="menu-color-option teal" data-color="teal"></span>
                            <span class="menu-color-option light-blue" data-color="light-blue"></span>
                            <span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
                            <span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
                        </div>
                    </div>
                    <div class="mb-0 input-field col s12 menu-bg-color">
                        <p class="mt-0">Menu Background Color</p>
                        <div class="gradient-color center-align">
                            <span class="menu-bg-color-option gradient-45deg-indigo-blue"
                                data-color="gradient-45deg-indigo-blue"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-deep-orange"
                                data-color="gradient-45deg-purple-deep-orange"></span>
                            <span class="menu-bg-color-option gradient-45deg-light-blue-cyan"
                                data-color="gradient-45deg-light-blue-cyan"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-amber"
                                data-color="gradient-45deg-purple-amber"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-deep-purple"
                                data-color="gradient-45deg-purple-deep-purple"></span>
                            <span class="menu-bg-color-option gradient-45deg-deep-orange-orange"
                                data-color="gradient-45deg-deep-orange-orange"></span>
                            <span class="menu-bg-color-option gradient-45deg-green-teal"
                                data-color="gradient-45deg-green-teal"></span>
                            <span class="menu-bg-color-option gradient-45deg-indigo-light-blue"
                                data-color="gradient-45deg-indigo-light-blue"></span>
                            <span class="menu-bg-color-option gradient-45deg-red-pink"
                                data-color="gradient-45deg-red-pink"></span>
                        </div>
                        <div class="solid-color center-align">
                            <span class="menu-bg-color-option red" data-color="red"></span>
                            <span class="menu-bg-color-option purple" data-color="purple"></span>
                            <span class="menu-bg-color-option pink" data-color="pink"></span>
                            <span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
                            <span class="menu-bg-color-option cyan" data-color="cyan"></span>
                            <span class="menu-bg-color-option teal" data-color="teal"></span>
                            <span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
                            <span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
                            <span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            Menu Dark
                            <label class="float-right"><input class="menu-dark-checkbox" type="checkbox"> <span
                                    class="ml-0 lever"></span></label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            Menu Collapsed
                            <label class="float-right"><input class="menu-collapsed-checkbox" type="checkbox">
                                <span class="ml-0 lever"></span></label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            <p class="mt-0">Menu Selection</p>
                            <label>
                                <input class="menu-selection-radio with-gap" value="sidenav-active-square"
                                    name="menu-selection" type="radio">
                                <span>Square</span>
                            </label>
                            <label>
                                <input class="menu-selection-radio with-gap" value="sidenav-active-rounded"
                                    name="menu-selection" type="radio">
                                <span>Rounded</span>
                            </label>
                            <label>
                                <input class="menu-selection-radio with-gap" value="" name="menu-selection"
                                    type="radio">
                                <span>Normal</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="mt-6">Navbar Options</h6>
            <hr class="customize-devider">
            <div class="navbar-options row">
                <div class="mb-0 input-field col s12 navbar-color">
                    <p class="mt-0">Navbar Color</p>
                    <div class="gradient-color center-align">
                        <span class="navbar-color-option gradient-45deg-indigo-blue"
                            data-color="gradient-45deg-indigo-blue"></span>
                        <span class="navbar-color-option gradient-45deg-purple-deep-orange"
                            data-color="gradient-45deg-purple-deep-orange"></span>
                        <span class="navbar-color-option gradient-45deg-light-blue-cyan"
                            data-color="gradient-45deg-light-blue-cyan"></span>
                        <span class="navbar-color-option gradient-45deg-purple-amber"
                            data-color="gradient-45deg-purple-amber"></span>
                        <span class="navbar-color-option gradient-45deg-purple-deep-purple"
                            data-color="gradient-45deg-purple-deep-purple"></span>
                        <span class="navbar-color-option gradient-45deg-deep-orange-orange"
                            data-color="gradient-45deg-deep-orange-orange"></span>
                        <span class="navbar-color-option gradient-45deg-green-teal"
                            data-color="gradient-45deg-green-teal"></span>
                        <span class="navbar-color-option gradient-45deg-indigo-light-blue"
                            data-color="gradient-45deg-indigo-light-blue"></span>
                        <span class="navbar-color-option gradient-45deg-red-pink"
                            data-color="gradient-45deg-red-pink"></span>
                    </div>
                    <div class="solid-color center-align">
                        <span class="navbar-color-option red" data-color="red"></span>
                        <span class="navbar-color-option purple" data-color="purple"></span>
                        <span class="navbar-color-option pink" data-color="pink"></span>
                        <span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
                        <span class="navbar-color-option cyan" data-color="cyan"></span>
                        <span class="navbar-color-option teal" data-color="teal"></span>
                        <span class="navbar-color-option light-blue" data-color="light-blue"></span>
                        <span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
                        <span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Navbar Dark
                        <label class="float-right"><input class="navbar-dark-checkbox" type="checkbox"> <span
                                class="ml-0 lever"></span></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Navbar Fixed
                        <label class="float-right"><input class="navbar-fixed-checkbox" type="checkbox"
                                checked/=""> <span class="ml-0 lever"></span></label>
                    </div>
                </div>
            </div>
            <h6 class="mt-6">Footer Options</h6>
            <hr class="customize-devider">
            <div class="navbar-options row">
                <div class="input-field col s12">
                    <div class="switch">
                        Footer Dark
                        <label class="float-right"><input class="footer-dark-checkbox" type="checkbox"> <span
                                class="ml-0 lever"></span></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Footer Fixed
                        <label class="float-right"><input class="footer-fixed-checkbox" type="checkbox"> <span
                                class="ml-0 lever"></span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Theme Customizer -->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2021 <a href="" target="_blank">HEAVENSHOP</a> All
                    rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a
                        href="{{ route('home_page') }}">HEAVENSHOP</a></span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    <script type="text/javascript" src="{!! asset('public/backend/app-assets/js/jquery.min.js') !!}"></script>

    @stack('scripts')

    <!-- BEGIN VENDOR JS-->
    <script src="{!! asset('public/backend/app-assets/js/vendors.min.js') !!}"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{!! asset('public/backend/app-assets/vendors/chartjs/chart.min.js') !!}"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{!! asset('public/backend/app-assets/vendors/data-tables/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/vendors/data-tables/js/dataTables.select.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/vendors/data-tables/js/datatables.checkboxes.min.js') !!}"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{!! asset('public/backend/app-assets/vendors/noUiSlider/nouislider.js') !!}"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN THEME  JS-->
    <script src="{!! asset('public/backend/app-assets/js/plugins.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/search.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/scripts/customizer.min.js') !!}"></script>
    <!-- END THEME  JS-->

    {{-- <!-- BEGIN PAGE LEVEL JS-->
    <script src="{!! asset('public/backend/app-assets/js/scripts/dashboard-ecommerce.min.js') !!}"></script>
    <!-- END PAGE LEVEL JS--> --}}

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{!! asset('public/backend/app-assets/js/scripts/advance-ui-modals.min.js') !!}"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{!! asset('public/backend/app-assets/js/scripts/form-elements.min.js') !!}"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- BEGIN: Sweetalert2 JS -->
    <script src="{!! asset('public/backend/app-assets/js/sweetalert2/sweetalert2.min.js') !!}"></script>
    <!-- END: Sweetalert2 JS -->

    <!-- BEGIN: Select2 JS-->
    <script src="{!! asset('public/backend/app-assets/vendors/select2/select2.full.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/scripts/form-select2.min.js') !!}"></script>
    <!-- END: Select2 JS-->

    <!-- BEGIN: Invoice APP  -->
    {{-- <script src="{!! asset('public/backend/app-assets/js/scripts/app-invoice.min.js') !!}"></script> --}}
    <!-- BEGIN: Invoice APP -->

    <!-- BEGIN: Format price -->
    <script src="{{ asset('public/backend/app-assets/js/simple.money.format.js') }}"></script>

    <script>
        $('.price_format').simpleMoneyFormat();
        </script>
    <!-- END: Format price -->

    <!-- BEGIN: Tagsinput -->
    <script src="{!! asset('public/backend/app-assets/js/bootstrap-tagsinput.min.js') !!}"></script>
    <!-- END: tagsinput -->

    <!-- BEGIN: Uploads File  -->
    <script src="{!! asset('public/backend/app-assets/vendors/dropify/js/dropify.min.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/scripts/form-file-uploads.min.js') !!}"></script>
    <!-- BEGIN: Uploads File -->

    {{-- <script src="{!! asset('public/backend/assets/js/jquery-ui.js') !!}"></script> --}}

    <script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;
            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
            document.getElementById('label_slug').classList.add('active')

            if (slug == '') {
                document.getElementById('label_slug').classList.remove('active')
            }
        }
    </script>

</body>

</html>
