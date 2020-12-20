@extends('layouts.master')

@section('title', 'RESTO POS - 403')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            <li class="breadcrumb-item"><a href="/">Home</a></li>

            <li class="breadcrumb-item active"> 403 - Forbidden Page </li>


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

                    <h4 class="title">403 - FORBIDDEN: Access denied.</h4>

                    <p class="category">
                        You do not have permession to view this directory or page using your current credientals
                    </p>

                  
                    <i class="fas fa-hand-paper fa-5x text-danger" aria-hidden="true" ></i>

                     
                </div>

            </div>


        </div>

    </div>



@endsection



@section('custom_footerscripts')

  


@endsection