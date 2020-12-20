@extends('layouts.master')

@section('title', 'RESTO POS - Users - Index')

@section('custom_headerscripts')    

    <script src="/customjs/UsersController.js?v{{time()}}" type="text/javascript"></script>

@endsection

@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search user'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/users" title="">  Users </a>  </h4>


    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])
    <br><br>


@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="UsersController as vm">

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="userstable" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>

                                        <th>Code</th>
                                        <th>Fullname</th>
                                        <th data-priority="1">Username</th>
                                        <th data-priority="2">Actions</th>
                                        <th  data-priority="3">Status</th>
                                    </tr>


                                </thead>

                                <tbody>

                                    @foreach($users as $s)

                                        <tr>


                                            <th>{{ str_pad($s->id, '5', '0', STR_PAD_LEFT)}}</th>
                                            <td>{{$s->name}}</td>
                                            <td>{{$s->usercode}}</td>
                                            <td>

                                                @php
                                                    $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                @endphp

                                                @include('layouts.submenu', ['currentdataID'=> $s->id, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])
                                                
                                            </td>

                                            <th>
                                                @include('layouts.tablestat', ['stat'=>$s->stat])
                                            </th>
                                            

                                        </tr>

                                    @endforeach
                                
                                </tbody>

                            </table><!--END table table-sm table-striped mb-0-->

                        </div><!--END table-responsive-->

                    </div><!--END table-rep-plugin-->

                </div><!--END responsive-table-plugin-->


                
                <hr>
                <div class="pull-right">

                    @if(count($users) > 0)
                    
                        {{ $users->appends(
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
          $("#userstable").tablesorter();
        });
    </script>

@endsection