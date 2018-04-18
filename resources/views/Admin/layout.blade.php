<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="ltr">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>{{$title??'Admin Page'}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('')}}metronic_admin/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('')}}metronic_admin/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    {{--<link href="{{asset('')}}metronic_admin/global/css/components.min.css" rel="stylesheet" id="style_components"--}}
    {{--type="text/css"/>--}}
    <link href="{{asset('')}}metronic_admin/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('')}}metronic_admin/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('')}}metronic_admin/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css"
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{asset('')}}metronic_admin/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/custom_style.css')}}" rel="stylesheet" type="text/css"/>
@yield('style')
<!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-boxed">
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="">

                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="droddown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle"
                                 src="{{asset('')}}metronic_admin/layouts/layout3/img/avatar9.jpg">
                            <span class="username username-hide-mobile">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu">
                <ul class="nav navbar-nav">
                    <li class="classic-menu-dropdown {{$title=="Dashboard"?'active':''}} ">
                        <a href="dashboard">
                            <i class="icon-graph"></i> Dashboard
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="classic-menu-dropdown {{$title=="Colleges"?'active':''}}">
                        <a href="{{route('colleges.index')}}">
                            <i class="fa fa-university"></i> Colleges
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="classic-menu-dropdown {{$title=="Question Category"?'active':''}}">
                        <a href="{{route('questionCategory.index')}}">
                            <i class="fa fa-question-circle"></i> Question Categories
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="menu-dropdown classic-menu-dropdown {{$title=="Suggestion"?'active':''}}">
                        <a href="#">
                            <i class="fa fa-sticky-note"></i> Suggestion
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            <li aria-haspopup="true" class=" active">
                                <a href="\SuggestionAddType" class="nav-link">
                                    Add suggestions
                                </a>
                            </li>
                            <li aria-haspopup="true" class=" ">
                                <a href="\SuggestionEditType" class="nav-link">
                                    Edit suggestions
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="classic-menu-dropdown {{$title=="Upload Spreadsheet"?'active':''}}">
                        <a href="\uploadSpreadsheet">
                            <i class="fa fa-upload"></i> Upload Spreadsheet
                            <span class="arrow"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>

<div class="page-content">
    <div class="container">
        @yield('body')
    </div>
</div>

<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">

    </div>
</div>

<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="{{asset('')}}metronic_admin/global/plugins/respond.min.js"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('')}}metronic_admin/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('')}}metronic_admin/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/counterup/jquery.waypoints.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/counterup/jquery.counterup.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/fullcalendar/fullcalendar.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/flot/jquery.flot.categories.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js"
        type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('')}}metronic_admin/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('')}}metronic_admin/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('')}}metronic_admin/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
<script src="{{asset('')}}metronic_admin/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

@yield('script')
</body>

</html>