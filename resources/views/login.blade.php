<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>POS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme POS" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/adminto/assets/images/favicon.ico">

        <!-- App css -->
        <link href="/adminto/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/adminto/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/adminto/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">

        <div class="home-btn d-none d-sm-block">
            {{--<a href="index.html"><i class="fas fa-home h2 text-dark"></i></a> --}}
        </div>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="text-center">

                            {{--<a href="index.html">
                                <span><img src="/adminto/assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p> --}}

                        </div>

                        @if( isset($is_login) && $is_login == 'error'  )
                                        
                            <div class="alert alert-danger text-center">
                                <strong>Oh snap!</strong> username & password is invalid.
                            </div>
                           
                        @endif

                       


                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>


                               
                                <form class="form" method="POST" action="/login" >

                                    {{ csrf_field() }}


                                    <div class="form-group mb-3">
                                        <label for="usercode">Username</label>
                                        <input class="form-control" type="text" id="usercode" name="usercode" required="" placeholder="Enter your username" value="{{$usercode or ''}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>



                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="/adminto/assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="/adminto/assets/js/app.min.js"></script>
        
    </body>
    
</html>