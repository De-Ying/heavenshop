<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
            <div class="nav-wrapper">
                <div class="header-search-wrapper hide-on-med-and-down">
                    <span class="material-icons">
                        <i class="fa fa-search"></i>
                    </span>
                    <input class="header-search-input z-depth-2" type="text" name="Search"
                        placeholder="Nhập từ khóa tìm kiếm" data-search="template-list">
                    <ul class="search-list collection display-none"></ul>
                </div>

                <ul class="navbar-list right">
                    <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button"
                            href="#" data-target="translation-dropdown"><i class="fa fa-flag fs-20"></i></a></li>
                    <li class="hide-on-med-and-down"><a
                            class="waves-effect waves-block waves-light toggle-fullscreen"
                            href="javascript:void(0);"><span class="material-icons"><i class="fa fa-search-plus"></i></span></a></li>
                    <li class="hide-on-large-only search-input-wrapper"><a
                            class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i
                                class="material-icons">search</i></a></li>
                    <li><a class="waves-effect waves-block waves-light notification-button"
                            href="javascript:void(0);" data-target="notifications-dropdown"><span
                                class="material-icons"><i class="fa fa-bell"></i><small
                                    class="notification-badge">5</small></span></a></li>
                    <li class="relative h-full">
                        <a class="h-full waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                            data-target="profile-dropdown">
                            <span class="avatar-status avatar-online">
                                @if (Auth::guard('admin')->check())
                                    @if (Auth::guard('admin')->user()->avatar != '')
                                        <img src="{!! asset('public/uploads/avatar/'.Auth::guard('admin')->user()->avatar) !!}" class="img-radius m-t-5" alt="User-Profile-Image">
                                        <span class="tooltiptext">{{ Auth::guard('admin')->user()->user_name }}</span>
                                    @else
                                        <img src="{!! asset('public/backend/assets/images/question.png') !!}" alt="" class="m-t-5">
                                    @endif

                                    <span class="tooltiptext">{{ Auth::guard('admin')->user()->user_name }}</span>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#"
                            data-target="slide-out-right"><span class="material-icons"><i class="fa fa-indent"></i></span></a>
                    </li>
                </ul>

                <!-- translation-button-->
                <ul class="dropdown-content" id="translation-dropdown">
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="vn">
                        <i class="flag flag-icon-background flag-icon-VND"></i> VietNames</a></li>
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="en">
                        <i class="flag flag-icon-background flag-icon-gb"></i> English</a></li>
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="fr">
                        <i class="flag flag-icon-background flag-icon-fr"></i> French</a></li>
                    <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="cn">
                        <i class="flag flag-icon-background flag-icon-CNY"></i> China</a></li>
                </ul>

                <!-- notifications-dropdown-->
                <ul class="dropdown-content" id="notifications-dropdown">
                    <li>
                        <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                    </li>
                    <li class="divider"></li>
                    <li><a class="black-text" href="#!"><span
                                class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new
                            order has been placed!</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours
                            ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span
                                class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days
                            ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span
                                class="material-icons icon-bg-circle teal small">settings</span> Settings
                            updated</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days
                            ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span
                                class="material-icons icon-bg-circle deep-orange small">today</span> Director
                            meeting started</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days
                            ago</time>
                    </li>
                    <li><a class="black-text" href="#!"><span
                                class="material-icons icon-bg-circle amber small">trending_up</span> Generate
                            monthly report</a>
                        <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week
                            ago</time>
                    </li>
                </ul>

                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="{!! route('admin.profile', ['id' => Auth::guard('admin')->user()->id ]) !!}"><i
                                class="material-icons">person_outline</i> Profile</a></li>
                    <li><a class="grey-text text-darken-1" href="app-chat.html"><i
                                class="material-icons">chat_bubble_outline</i> Chat</a></li>
                    <li><a class="grey-text text-darken-1" href="page-faq.html"><i
                                class="material-icons">help_outline</i> Help</a></li>
                    <li class="divider"></li>
                    <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i
                                class="material-icons">lock_outline</i> Lock</a></li>
                    <li><a class="grey-text text-darken-1" href="{!! route('admin.getLogout') !!}"><i
                                class="material-icons">keyboard_tab</i> Logout</a></li>
                </ul>
            </div>

            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="mb-0 search-box-sm" type="search" required="" id="search"
                                placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon" for="search"><i
                                    class="material-icons search-sm-icon">search</i></label><i
                                class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none"></ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
