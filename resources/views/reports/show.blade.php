@extends('layouts.master')

@section('title', 'RESTO POS - Reports - Show')

@section('custom_headerscripts')    
    <script src="/customjs/ReportsController.js?v{{time()}}" type="text/javascript"></script>
@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/reports">Reports</a></li>

            <li class="breadcrumb-item active"> {{$reports[0]->description}} </li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/reports" title="">  Reports </a> > {{$reports[0]->description}} </h4>

    @include('layouts.globalfilter', [
        //dynamic filter fields from ReportsController
        'filters'=> $filters
    ])


    <br>

@endsection


@section('content')
     
      <div class="row" ng-app="app" ng-controller="ReportsGenerateController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box"> 

                <input type="hidden" class="form-control" name="pk_permalink" id="pk_permalink" value="{{$reports[0]->pk_permalink}}" >


                @if(count($reports) > 0)

                    @include("reports.".$reports[0]->pk_permalink)


                @else

                    @include('layouts.alert', ['alerttype'=> 'norecord'])

                @endif

            </div><!--END card-box-->

        </div><!--END col-12-->

    </div><!--END row-->

@endsection



@section('custom_footerscripts')



@endsection