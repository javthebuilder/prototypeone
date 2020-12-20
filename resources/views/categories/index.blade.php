@extends('layouts.master')

@section('title', 'RESTO POS - Categories')

@section('custom_headerscripts')    

    <script src="/customjs/CategoriesController.js?v{{time()}}" type="text/javascript"></script>

@endsection

@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search categories'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/categories" title="">  Categories </a>  </h4>


    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])
    <br><br>


@endsection


@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="CategoriesController as vm">

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="categoriestable" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th data-priority="1">Type</th>
                                        <th data-priority="2">Actions</th>
                                        <th data-priority="3">Status</th>
                                    </tr>


                                </thead>

                                <tbody>

                                    @foreach($categories as $s)

                                        <tr>
                                            <td>{{ str_pad($s->pk_categories, '5', '0', STR_PAD_LEFT)}}</td>
                                            <td>{{$s->description}}</td>
                                            <td>{{$s->type}}</td>
                                            <td>

                                                @php
                                                    $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                @endphp

                                                @include('layouts.submenu', ['currentdataID'=> $s->pk_categories, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])
                                                
                                            </td>
                                            <td>
                                                @include('layouts.tablestat', ['stat'=>$s->stat])
                                            </td>
                                        </tr>
                                    @endforeach
                                
                                </tbody>

                            </table><!--END table table-sm table-striped mb-0-->

                        </div><!--END table-responsive-->

                    </div><!--END table-rep-plugin-->

                </div><!--END responsive-table-plugin-->


                
                <hr>
                <div class="pull-right">

                    @if(count($categories) > 0)
                    
                        {{ $categories->appends(
                            ['search' => $search]
                        )->links("pagination::bootstrap-4") }}

                    @endif

                </div>

             

            </div><!--END card-box-->

        </div><!--END col-12-->

    </div>
    <!-- end row -->



@endsection



@section('custom_footerscripts')

    @include('layouts.alert', ['alerttype'=> 'pnotify'])

    <script type="text/javascript">
        $(function() {
          $("#categoriestable").tablesorter();
        });
    </script>

@endsection