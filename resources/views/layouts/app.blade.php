<!-- This is Master page for admin section -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        @include('includes.header')

        <!-- BEGIN PAGE LEVEL STYLES -->

        @yield('page_level_styles')

        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME STYLES -->

        <link href="{{ URL::asset('assets/global/css/components-rounded.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="{{ URL::asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ URL::asset('css/layout.css')}}" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="{{ URL::asset('css/themes/light.css')}}" rel="stylesheet" type="text/css"/>

        <!-- END THEME STYLES -->

        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->

        @yield('page_level_custom_styles')

        <!-- END PAGE LEVEL CUSTOM STYLES -->

        <script>
            var SITEURL = {
                'base'    : '{{ URL::to('/') }}',
                'current' : '{{ URL::current() }}',
                'full'    : '{{ URL::full() }}',
                'globalImgPath':'{{URL::asset('assets/global/img')}}/',
                'globalPluginsPath':'{{URL::asset('assets/global/plugins')}}/',
                'globalCssPath':'{{URL::asset('assets/global/css')}}/'
            };
            var rows_per_page='{{ Config::get('custom.rows_per_page',10)}}';
        </script>

    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo ">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{URL::to('/')}}">
                        <div class="text-primary logo-default" style="font-weight: bold;font-size:1.6em;margin-top: 15px;" >{{Config::get('custom.SITE_NAME', 'Pilot Project')}}</div>
                    </a>

                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->

                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hide">
                            </li>
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">
                                        {{ Auth::user()->username }}
                                    </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="{{ URL::asset('img/avatar.png')}}"/>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{{url('admin/my-account')}}"><i class="icon-user"></i> My Account </a>
                                    </li>
                                    <li>
                                        <a href="{{url('logout')}}"><i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                @include('partials.sidebar')
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE CONTENT-->
                    @yield('content')
                    <!-- END PAGE CONTENT-->
                </div>

            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                2005-2015 © {{Config::get('custom.SITE_NAME', 'Pilot Project')}}
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

        @include('includes.footer')

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        @yield('page_level_plugins')

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME LEVEL SCRIPTS -->

        <script src="{{ URL::asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/layout.js')}}"  type="text/javascript"></script>

        <!-- END THEME LEVEL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        @yield('page_level_scripts')

        <!-- END PAGE LEVEL SCRIPTS -->

        <script>

            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout

            });

        </script>
        @yield('footer')

        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>