<!-- Right Sidebar -->
<div class="right-bar">
    
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>

        <h5 class="m-0 text-white">
            @yield('rightsidebar_title')
        </h5>
        
    </div>

    <div class="slimscroll-menu rightbar-content">

        {{--optional content. inserted elements @layouts.globalfilter.blade.php or @layouts.* --}}
        @yield('rightsidebar_content')
        
    </div> <!-- end slimscroll-menu-->

</div>
<!-- /Right-bar -->