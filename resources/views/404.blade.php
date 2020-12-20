@extends('layouts.master')

@section('title', 'RESTO POS - 404')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            <li class="breadcrumb-item"><a href="/">Home</a></li>

            <li class="breadcrumb-item active"> 404 - Page Not Found </li>


            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/home" title="">  Home </a> </h4>

@endsection


@section('content')
    
     <div class="row">

        <div class="col-12">

            <div class="card-box"> 

                <div class="col-md-12 text-center " >

                    <h4 class="title">404 - Page Not Found.</h4>

                    <p class="category">
                        The page you are looking for could not be found!
                    </p>

                  
                    <i class=" fas fa-ban fa-5x text-danger" aria-hidden="true" ></i>

                     
                </div>

            </div>


        </div>

    </div>



@endsection



@section('custom_footerscripts')

  


@endsection