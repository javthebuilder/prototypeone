@extends('layouts.master')

@section('title', 'RESTO POS - Home')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title">Home</h4>

@endsection


@section('content')
            

    <div class="alert alert-info text-center">
        <strong>Hey!</strong> Configure POS by selecting which store to operate.
    </div>


    <div class="row">
     

        @foreach($stores as $key => $v)

            <div class="col-xl-3 col-md-6">

                <div class="card-box" >

                    <a href="/home/store/{{$v->pk_stores}}">

                        <h3 class="header-title mt-0 mb-4" style="text-align: center;color:{{ $v->pk_stores == session('session_store') ? 'green' : '' }}">
                            {{$v->name}}
                        </h3>

                        <div class="widget-chart-1" style="margin-top: -40px;">
                            
                            <div class="text-center" style="font-size: 80px;color:{{ $v->pk_stores == session('session_store') ? 'green' : '' }};">
                               <i class="fas fa-store-alt" aria-hidden="true"></i>
                            </div>

                            <div class="widget-detail-1 text-center" >
                                
                                <p class="text-muted mb-1" style="color:{{ $v->pk_stores == session('session_store') ? 'green' : '' }} !important;"> 
                                    {{$v->address}} 
                                </p>

                                <p class="text-muted mb-1" style="color:{{ $v->pk_stores == session('session_store') ? 'green' : '' }} !important;"> 
                                    {{ $v->email .' | '. $v->phone }} 
                                </p>

                            </div>

                        </div><!--END widget-chart-1-->

                    </a>

                </div><!--END card-box-->

            </div><!--END col-xl-3 col-md-6-->

        @endforeach
        
    </div><!--END row-->
  
 
@endsection