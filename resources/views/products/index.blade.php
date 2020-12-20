@extends('layouts.master')

@section('title', 'RESTO POS - Products')

@section('custom_headerscripts')    

    <script src="/customjs/ProductsController.js?v{{time()}}" type="text/javascript"></script>

@endsection



@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search products'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/products" title="">  Products </a>  </h4>

    {{--@include('layouts.alert-default') --}}
    @include('layouts.globalfilter', [
        //dynamic filter fields
        'filters'=> [7, 5,10] //5 = fk_categories, 7 = producttype, 10 = apply filter
    ])
    <br>

    @include('layouts.submenu', ['currentdataID'=> null, 'currentdataStat'=> null, 'angularalias'=> null])
    <br><br>

@endsection




@section('content')
    
   
    <div class="row" ng-app="app" ng-controller="ProductsController as vm" ng-cloack>

        <div class="col-12">


          

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="productstable" class="table table-sm table-striped mb-0 table-sorter">
                                
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th data-priority="1">Category</th>
                                        <th data-priority="2">Cost</th>
                                        <th data-priority="3">Prices</th>
                                        <th data-priority="4">Qty</th>
                                        <th data-priority="5">Actions</th>
                                        <th data-priority="6">Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                   @foreach($products as $s)

                                        <tr>

                                            <td>
                                                @if($s->pictx != null || $s->pictx !='')
                                                    <img src="{{asset('/storage/'.$s->pictx)}}" style="width: 20px; height: 20px;" >
                                                @endif
                                                
                                            </td>
                                            
                                            <td>{{ str_pad($s->pk_products, '5', '0', STR_PAD_LEFT) }}</td>
                                            <td>{{$s->type}}</td>
                                            <td>{{$s->name}}</td>
                                            <td>{{$s->category}}</td>
                                            <td>{{number_format($s->cost, '2')}}</td>

                                            <td>

                                                @if( count($s->prices_arr) > 0 )

                                                    {{--
                                                    dynamic prices. manually initialize @index
                                                    --}}
                                                    
                                                    <span tabindex="0" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="" data-content="{{$s->prices_str}}" data-original-title="Price List" style="cursor: pointer;color:grey">
                                                       <i class="fas fa-info-circle"></i>
                                                    </span>


                                                @endif


                                            </td>

                                            <td>

                                                {{--
                                                    dynamic qty. manually initialize @index
                                                --}}
                                                @if( $s->type == 'inventory' && count($s->qty_arr) > 0 )


                                                    <span tabindex="0" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="" data-content="{{$s->qty_str}}" data-original-title="Qty List" style="cursor: pointer;color:grey">
                                                       <i class="fas fa-info-circle"></i>
                                                    </span>

                                                @endif
                                            </td>

                                            <td>

                                                @php
                                                    $stat = ($s->stat == 1) ? 'Active' : 'In-Active';
                                                @endphp


                                                @include('layouts.submenu', ['currentdataID'=> $s->pk_products, 'currentdataStat'=> $stat, 'angularalias'=> 'vm' ])


                                                
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

                    @if(count($products) > 0)
                    
                        {{ $products->appends(
                            ['search' => $search]
                        )->links("pagination::bootstrap-4") }}

                    @endif

                </div>

             

            </div><!--END card-box-->

        </div><!--END col-12-->



        <div id="myModal" class="modal fade bs-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myNewPaymentsModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
   

                <div class="modal-content">

                    <div class="modal-header " >  
                        <h4 class="modal-title" id="myShowPaymentsModal"> @{{ vm.modallabel }} </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        
                    </div><!--END modal-header-->

                    <div class="modal-body">

                        <div class="alert alert-danger" ng-show="vm.isqty">
                            NOTE: Deduction of inventory will only work if the inputted qty is a negative number otherwise it will be added to the current stock on hand.
                        </div>

                        <table class="table table-sm table-striped mb-0">

                            <thead class="text-muted">
                                <th ng-hide="vm.isbarcode" >Code</th>
                                <th ng-hide="vm.isbarcode" >Store</th>
                                <th ng-show="vm.isprice" >Selling Price</th>
                                <th ng-show="vm.isprice" >Disc%</th>
                                <th ng-show="vm.isqty" >StockOnHand</th>
                                <th ng-show="vm.isqty" >QtyAdjustment</th>
                                <th ng-show="vm.isqty" >Remarks</th>
                                <th ng-show="vm.isqty" >RunningBalance</th>
                                <th ng-show="vm.isvisibility" >Viewable</th>
                            </thead>

                            <tbody ng-show="vm.isprice">
                                <tr ng-repeat="list in vm.pricelist">
                                    <td>@{{list.pk_stores}}</td>
                                    <td>@{{list.storename}}</td>
                                    <td>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="number" min="0" 
                                                    ng-model="list.priceadj" 
                                                    class="form-control" 
                                                    ng-change="vm.isNumber(list, 'price')"
                                                    ng-model-options="{debounce: 500}"
                                                    string-to-number
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="number" min="0" max="100"
                                                    ng-model="list.discountadj" 
                                                    class="form-control" 
                                                    ng-change="vm.isNumber(list, 'discount')"
                                                    ng-model-options="{debounce: 500}"
                                                    string-to-number
                                                />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>

                            <tbody ng-show="vm.isqty">
                                <tr ng-repeat="list in vm.qtylist">
                                    <td>@{{list.pk_stores}}</td>
                                    <td>@{{list.storename}}</td>
                                    <td class="text-danger">@{{list.qty + ' ' + list.uom}}</td>
                                    <td>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number"
                                                    ng-model="list.qtyadj" 
                                                    class="form-control" 
                                                    ng-change="vm.isNumber(list, 'qty')"
                                                    ng-model-options="{debounce: 500}"
                                                    string-to-number
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <div class="form-group">
                                                <textarea ng-model="list.qtyremarks" 
                                                    class="form-control"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-danger">@{{list.runningbalance + list.uom }}</td>
                                </tr>
                                
                            </tbody>

                            <tbody ng-show="vm.isvisibility">
                                <tr ng-repeat="list in vm.visibility">
                                    <td>@{{list.pk_stores}}</td>
                                    <td>@{{list.storename}}</td>
                                    <td>
                                
                                        <div class="form-group">
                                            <div class="checkbox"> 

                                                <input type="checkbox" id="@{{list.pk_stores}}" ng-model="list.selected" >

                                                <label for="@{{list.pk_stores}}">

                                                    &nbsp;

                                                </label>

                                            </div>
                                        </div>

                                   
                                    </td>
                                </tr>
                                
                            </tbody>

                        </table>

                        <div ng-show="vm.isbarcode">
                            <div id="productbarcode"></div>
                        </div>



                    </div><!--END modal-body-->

                    <div class="modal-footer">
                  
                   
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>

                        <span id="ajaxmodalfooterprintdiv" hidden>

                            <button type="button" class="btn btn-bordred-info waves-effect width-md waves-info" id="ajaxmodalfooterprint" >
                            
                                <i class="fa fa-print" aria-hidden="true"></i>
                                &nbsp;Print

                            </button>
                            
                        </span>
                        

                        <span id="ajaxmodalfootersubmitdiv" >

                            <button type="button" class="btn btn-bordred-primary waves-effect width-md waves-primary" id="ajaxmodalfootersubmit">
                                <span id="msgAjaxModalSubmit">
                                  Save
                                </span>
                            </button>

                        </span>


                    </div><!--END modal-footer-->

                </div><!--END modal-content-->

            </div><!--END modal-dialog-->

        </div><!--END modal core-->
                        



    </div>
    <!-- end row -->



@endsection



@section('custom_footerscripts')

    @include('layouts.alert', ['alerttype'=> 'pnotify'])

    <script type="text/javascript">
        $(function() {
          $("#productstable").tablesorter();
        });
    </script>

@endsection

