@extends('layouts.master')

@section('title', 'RESTO POS - Finance - Expense / Index')

@section('custom_headerscripts')    
    <script src="/customjs/ExpenseController.js?v{{time()}}" type="text/javascript"></script>
@endsection


@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search expenses'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/expense" title="">  Expense </a>  </h4>

    @include('layouts.globalfilter', [
        //dynamic filter fields
        'filters'=> [1, 2, 5, 10] //1 = dateFrom & dateTo,  2 = stores, 5 = categories, 10 = apply filter
    ])


    <br>

    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])

    <br><br>


@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="ExpenseController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="expensetable" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>
                                        <th>Code</th>
                                        <th>Date</th>
                                        <th>Ref#</th>
                                        <th data-priority="1">Category</th>
                                        <th data-priority="2">Store</th>
                                        <th data-priority="3">Remarks</th>
                                        <th data-priority="4">Amount</th>
                                        <th data-priority="5">Actions</th>
                                        <th data-priority="6">Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($expense as $s)

                                        <tr>
                                            <td>{{ str_pad($s->pk_expense, '5', '0', STR_PAD_LEFT)}}</td>
                                            <td>{{$s->docdate}}</td>
                                            <td>{{$s->docno}}</td>
                                            <td>{{$s->category}}</td>
                                            <td>{{$s->storename}}</td>
                                            <td>
                                                <span rel="tooltip" title="{{$s->remarks}}" style="cursor: pointer;"  data-placement="left" >
                                                    {{ substr($s->remarks, 0, 20) }}
                                                    {{ strlen($s->remarks) > 20 ? '...' : '' }}
                                                </span>
                                            </td>
                                            <td>{{number_format($s->amount, '2')}}</td>
                                            <td class="">

                                                @php
                                                    $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                @endphp

                                                @include('layouts.submenu', ['currentdataID'=> $s->pk_expense, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])

                                                @if( $s->attachment )
                                                    <a href="{{asset('/storage/'.$s->attachment)}}" 
                                                        class="text-dark btn-xs"
                                                        target="_blank" data-toggle="tooltip" data-placement="right" title="Download"
                                                    >
                                                        <i class=" fas fa-download"></i>
                                                    </a>

                                                @endif
                                                
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

                    @if(count($expense) > 0)
                    
                        {{ $expense->appends(
                            ['search' => $search, 'dateFrom'=> $dateFrom, 'dateTo'=> $dateTo, 'fk_stores'=> $fk_stores]
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
          $("#expensetable").tablesorter();
        });
    </script>


@endsection




