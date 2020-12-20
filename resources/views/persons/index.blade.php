@extends('layouts.master')

@section('title', 'RESTO POS - Customers.Suppliers')

@section('custom_headerscripts')    

     <script src="/customjs/PersonsController.js?v{{time()}}" type="text/javascript"></script>

@endsection

@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search customer'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/persons" title="">  Customers.Suppliers </a>  </h4>


    @include('layouts.globalfilter', [
        //dynamic filter fields
        'filters'=> [6, 10] //6 = persontype, 10 = apply filter
    ])
    <br>

    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])

    <br><br>


@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="PersonsController as vm">

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="personstable" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>

                                        <th>Code</th>
                                        <th>Fullname</th>
                                        <th data-priority="1">Contact</th>
                                        <th data-priority="2">Type</th>
                                         <th data-priority="3">Actions</th>
                                        <th data-priority="4">Status</th>
                                    </tr>


                                </thead>

                                <tbody>

                                    @foreach($persons as $s)

                                        <tr>
                                           
                                            <td>{{ str_pad($s->pk_persons, '5', '0', STR_PAD_LEFT)}}</td>
                                            <td>{{$s->fullname}}</td>
                                            <td>{{$s->email}} | {{$s->contact}} </td>
                                            <td>
                                                [ 
                                                    @if($s->iscustomer == 1)
                                                        Customer,
                                                    @endif

                                                     @if($s->issupplier == 1)
                                                       Supplier
                                                    @endif
                                                ]
                                            </td>
                                           
                                            <td>

                                                @php
                                                    $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                @endphp

                                                @include('layouts.submenu', ['currentdataID'=> $s->pk_persons, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])
                                                
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

                    @if(count($persons) > 0)
                    
                        {{ $persons->appends(
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
          $("#personstable").tablesorter();
        });
    </script>

@endsection