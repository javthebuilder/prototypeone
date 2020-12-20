<!-- Navigation Bar-->
<header id="topnav">

    <!-- Topbar Start -->
    <div class="navbar-custom bg-danger">        
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>


                @yield('globalsearch')
              
    
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">
                            {{count($criticalnotifications)}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    {{--<a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a> --}}
                                </span>Notification
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll" style="font-size: 12px;">


                            @foreach($criticalnotifications as $key=> $v)

                                <!-- item-->
                                <a href="{{url('/reports/show/1704?fk_stores='.$v->fk_storesvisibility)}}" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger">
                                        <i class="fas fa-level-down-alt "></i>
                                    </div>
                                    <p class="notify-details">
                                        Inventory critical level on {{$v->storename}}
                                    </p>
                                </a>

                            @endforeach


                        </div>

                        {{--
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a> --}}

                    </div>
                </li>

                <li class="dropdown notification-list">
                    
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                        @if(  Auth::user()->pictx == null || Auth::user()->pictx == '' )

                            <img src="/adminto/assets/images/avatar.png" alt="user-image" class="rounded-circle">

                        @else

                            <img src="{{asset('/storage/'.Auth::user()->pictx)}}" >

                        @endif
                       
                        

                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name  }} <i class="mdi mdi-chevron-down"></i> 
                        </span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome Back! </h6>
                        </div>

                        @if( strpos( url()->current(), '/pos') !== false )
                            <!-- item-->
                            <a href="/home" class="dropdown-item notify-item">
                                <i class="fe-home"></i>
                                <span>Home</span>
                            </a>
                        @endif

                        <!-- item-->
                        <a href="/profile" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Profile</span>
                        </a>
                      


                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="/logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                {{--optional toggle icon. inserted elements @layouts.rightsidebar_toggle.blade.php--}}
                @yield('rightsidebar_toggle')
               

            </ul>

            <!-- LOGO -->
            <div class="logo-box">

                <a href="/" class="logo text-center">

                    <span class="logo-lg">
                        <p>
                            <h2 style="color:#fff;">{{env('APP_NAME')}}  </h2>
                        </p>
                        
                        {{--<img src="/adminto/assets/images/logo-light.png" alt="" height="16"> --}}
                        <!-- <span class="logo-lg-text-light">UBold</span> -->
                    </span>

                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">U</span> -->
                        {{--<img src="/adminto/assets/images/logo-sm.png" alt="" height="24"> --}}
                        <p style="color:#fff;">
                            {{env('APP_NAME')}}  
                        </p>
                    </span>

                </a>

            </div><!--END logo-box-->

        </div> <!-- end container-fluid-->
    </div>
    <!-- end Topbar -->

    @if( strpos( url()->current(), '/pos') === false )

    @endif

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu {{ session('active_parent') == 'Home' ? 'active' : '' }}">
                        <a href="/"><i class="fa fa-home"></i>Home</a>
                    </li>


                    @if (isset($main_menu))

                        @foreach ($main_menu as $main)
                        
                            <!--Parent-->
                            @if ($main->type == 'A') 


                                <li class="has-submenu {{ session('active_parent') == $main->family ? 'active' : '' }} ">


                                    {{--1200 = POS, 1700 = reports manager--}}
                                    @if ($main->pk_permalink != 1200 && $main->pk_permalink != 1700)

                                        <a href="{{$main->url}}"> 
                                            <i class="{{$main->icon}}"></i>
                                            {{$main->description}}
                                            <div class="arrow-down"></div>
                                        </a>


                                    
                                        <ul class="submenu">

                                            @foreach ($main_menu as $sub)

                                                <!---Child-->
                                                <!--do not display children of reports-->
                                                @if ($sub->type == 'B' && $main->family == $sub->family && ($main->family != 'Reports') )


                                                    <li class="{{ (strpos($active_child, $sub->url) !== false) 
                                                        ? 'active' 
                                                        : '' }} " >
                                                        <a href="{{$sub->url}}"> 
                                                            {{$sub->description}}
                                                        </a>
                                                    </li>
                                                        

                                                @endif

                                            @endforeach

                                        </ul>


                                    @else

                                        <a href="{{$main->url}}"> 
                                            <i class="{{$main->icon}}"></i>
                                            {{$main->description}}
                                        </a>

                                    @endif

                                </li>

                            @endif<!--END parent-->

                        @endforeach
                     
                    @endif



                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->


</header>
<!-- End Navigation Bar-->