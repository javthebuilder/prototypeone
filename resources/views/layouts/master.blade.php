<!DOCTYPE html>

<html lang="en">

    <head>  


        {{--@include('layouts.init')--}}

        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/adminto/assets/images/favicon.ico">


        <!-- Responsive Table css -->
        <link href="/adminto/assets/libs/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="/adminto/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/adminto/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/adminto/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- pnotify css -->
        <link href='/css/pnotify.custom.min.css' rel='stylesheet' type='text/css'>
        <link href="/css/select2.min.css" type="text/css" media="screen, projection" rel="stylesheet" /> 

        <style type="text/css" media="screen">
             
            .error{
                color:red !important;
            } 

        </style>


        <!--angularjs-->
        <script src="/angular/angular.min.js" type="text/javascript"></script>
        <script src="/angular/angular-sanitize.js" type="text/javascript"></script>

        <script src="/customjs/AppServices.js?v{{time()}}" type="text/javascript"></script>

        @yield('custom_headerscripts')

    </head>

    <body>

        @include('layouts.header')

        @yield('POS-Section')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">

            <div class="container-fluid">

                @include('layouts.breadcrumb')

                @yield('content')

                
            </div> <!-- end container -->

        </div>
        <!-- end wrapper -->




        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        
        @include('layouts.footer')

        
        @include('layouts.rightsidebar')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="/adminto/assets/js/vendor.min.js"></script>

        <!-- Responsive Table js -->
        <script src="/adminto/assets/libs/rwd-table/rwd-table.min.js"></script>

        <!-- Init js -->
        <script src="/adminto/assets/js/pages/responsive-table.init.js"></script>


        <!-- App js-->
        <script src="/adminto/assets/js/app.min.js"></script>

        <!--tablesorter-->
        <script type="text/javascript" src="/js/jquery-tablesorter-2.31.1.js"></script>

        <!-- pnotify js -->
        <script src='/js/pnotify.custom.min.js' type="text/javascript" ></script>
        <script src='/js/select2.min.js' type="text/javascript" ></script>

        <!--printThis-->
        <script src='/printThis/printThis.js' type="text/javascript" ></script>

        <script src="/js/jquery-barcode.min.js"></script>


        <script src="/jqueryvalidate1.19.0/dist/jquery.validate.min.js"></script>
        <script src="/jqueryvalidate1.19.0/dist/additional-methods.min.js"></script>



        <script type="text/javascript">

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
            
            function injectTrim(handler) {
              return function (element, event) {
                if (element.tagName === "TEXTAREA" || (element.tagName === "INPUT" 
                     && element.type !== "password")) {
                  element.value = $.trim(element.value);
                }
                return handler.call(this, element, event);
              };
            };

            $(".jqvalidate-form").validate({
                onfocusout: injectTrim($.validator.defaults.onfocusout)
            });

           /* toastr.options = {
              "debug": false,
              "positionClass": "toast-bottom-right",
              "onclick": null,
              "fadeIn": 300,
              "fadeOut": 1000,
              "timeOut": 5000,
              "extendedTimeOut": 1000
            }*/



        </script>

        

        @yield('custom_footerscripts')


        <script src='/customjs/TimeClock.js' type="text/javascript" ></script>

        <script type="text/javascript">
            $('#printreport').on('click', function(){

                //jquery plugin for printing
                $('#printtable').printThis();

            })
        </script>

        
    </body>

</html>