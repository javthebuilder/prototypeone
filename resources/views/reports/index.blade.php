@extends('layouts.master')

@section('title', 'RESTO POS - Reports')

@section('custom_headerscripts')    

    <script src="/customjs/ReportsController.js?v{{time()}}" type="text/javascript"></script>

@endsection


@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search report'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/reports" title="">  Reports </a>  </h4>


@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="ReportsController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>Code</th>
                                        <th>Description</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($reports as $s)

                                        <tr>
                                            <td>
                                                <a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Generate Report" href="{{$s->url}}/{{$s->pk_permalink}}" data-placement="right" >
                                                    <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                                                </a>
                                              
                                            </td>
                                            
                                            <td>{{$s->pk_permalink}}</td>
                                            
                                            <td>{{$s->newdescription ?? $s->description}}</td>


                                        </tr>
                                    @endforeach
                                
                                </tbody>

                            </table><!--END table table-sm table-striped mb-0-->

                        </div><!--END table-responsive-->

                    </div><!--END table-rep-plugin-->

                </div><!--END responsive-table-plugin-->


            </div><!--END card-box-->

        </div><!--END col-12-->


 

    </div>
    <!-- end row -->



@endsection



@section('custom_footerscripts')

    @include('layouts.alert', ['alerttype'=> 'pnotify'])

@endsection

