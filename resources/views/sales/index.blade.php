@extends('layouts.master')

@section('title', 'RESTO POS - Finance / Sales')

@section('custom_headerscripts')    

    <script src="/customjs/SalesController.js?v{{time()}}" type="text/javascript"></script>

@endsection


{{--@section('rightsidebar_toggle')
    @include('layouts.rightsidebar_toggle')
@endsection

@section('rightsidebar_title', 'Official Receipt')

@section('rightsidebar_content')
    
    @include('layouts.receiptmodal')

@endsection --}}


@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search sales'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/sales" title="">  Sales </a>  </h4>

    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])

    @include('layouts.globalfilter', [
        //dynamic filter fields
        'filters'=> [1, 2, 10] //1 = dateFrom & dateTo,  2 = stores, 10 = apply filter
    ])


    <br>


@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="SalesController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="salestable" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>Code</th>
                                        <th>Date</th>
                                        <th>Store</th>
                                        <th data-priority="1">Total</th>
                                        <th data-priority="2">Discount</th>
                                        <th data-priority="3">Net</th>
                                        <th data-priority="4">Action</th>
                                        <th data-priority="5">Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($salesmstr as $s)

                                        <tr>
                                            
                                            <td>
                                                @if( $s->stat == 1 && $s->iscancel == 0  )
                                                    <span data-toggle="tooltip" data-placement="right" title="Open" class="btn btn-success btn-round btn-xs"></span>

                                                @elseif( $s->iscancel ==1  )
                                                    <span data-toggle="tooltip" data-placement="right" title="Cancelled" class="btn btn-danger btn-round btn-xs"></span>
                                                    
                                                @else
                                                    <span data-toggle="tooltip" data-placement="right" title="Close" class="btn btn-default btn-xs"></span>
                                                    
                                                @endif
                                            </td>

                                            <td>{{ str_pad($s->pk_salesmstr, '5', '0', STR_PAD_LEFT)}}</td>
                                            <td>{{$s->docdate}}</td>
                                            <td>{{$s->storename}}</td>
                                            <td>
                                               {{ number_format($s->totalamount, 2) }}
                                            </td>
                                            <td>{{number_format($s->totaldisc, '2')}}</td>
                                            <td>{{number_format($s->netamount, '2')}}</td>

                                            <td>

                                                @if( $s->iscancel == 0 )

                                                    @php
                                                        $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                    @endphp

                                                    @include('layouts.submenu', ['currentdataID'=> $s->pk_salesmstr, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])
                                                    

                                                @elseif( $s->iscancel == 1 )

                                                    <a href="#" data-toggle="tooltip" data-placement="right" title="View Receipt"   class="text-dark" ng-click="vm.ViewReceipt({{$s->pk_salesmstr}}, '')" >
                                                        <i class="fas fa-search"></i> 
                                                    </a>

                                                    <i style="font-size: 12px;color:red;">Cancelled</i>
                                                  

                                                @endif

                                              
                                            </td>

                                            <td>

                                                @php

                                                    if( $s->paymentstat == 'paid' ){
                                                        $statclass = 'text-success';
                                                    }else if( $s->paymentstat == 'unpaid' ){
                                                        $statclass = 'text-danger';
                                                    }else{
                                                        $statclass = 'text-warning';
                                                    }

                                                @endphp

                                                @if( $s->iscancel == 1  )
                                                    <i class="text-danger">
                                                        Cancelled
                                                    </i>
                                                @else
                                                    <span class="{{$statclass}}">
                                                        {{$s->paymentstat}}
                                                    </span>
                                                @endif

                                               
                                                
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

                    @if(count($salesmstr) > 0)
                    
                        {{ $salesmstr->appends(
                            ['search' => $search, 'dateFrom'=> $dateFrom, 'dateTo'=> $dateTo, 'fk_stores'=> $fk_stores]
                        )->links("pagination::bootstrap-4") }}

                    @endif

                </div>

             

            </div><!--END card-box-->

        </div><!--END col-12-->


        @include('layouts.showpaymentsmodal')

        @include('layouts.newpaymentsmodal')

        @include('layouts.receiptmodal', ['company'=> $company, 'stores'=> $stores])




    </div>
    <!-- end row -->



@endsection



@section('custom_footerscripts')

    @include('layouts.alert', ['alerttype'=> 'pnotify'])


    <script type="text/javascript">

        if( $('#notifytype_nostore').html() != undefined ){

            new PNotify({
                title: $('#notifytitle_nostore').html(),
                text: $('#notifytext_nostore').html(),
                type: $('#notifytype_nostore').html(),
            });



        }


    </script>

    <script type="text/javascript">
        $(function() {
          $("#salestable").tablesorter();
        });
    </script>

@endsection

