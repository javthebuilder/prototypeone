@extends('layouts.master')

@section('title', 'RESTO POS')

@section('custom_headerscripts')    

    <script src="/customjs/POSController.js?v{{time()}}" type="text/javascript"></script>

@endsection



@section('POS-Section')
     
    
    <div class="row" ng-app="app" ng-controller="POSController as vm" ng-cloack>

        <div class="col-12" style="margin-top: 130px;" >


            <div class="row">

                <div class="col-md-4"> </div>
                <div class="col-md-4">@include('layouts.loading') </div>
                
            </div>
               

            <div class="row" hidden id="maincontainer">

                <div class="col-md-4">

                    <div class="card-box" style="height: 770px; background-color: #fff;">
                        <input type="text" id="companyvat" value="{{$company->vat}}" ng-model="vm.companyvat" hidden  >

                        <div class="input-group">

                            <select class="form-control" id="pk_salesmstr" style="cursor: pointer;" aria-describedby="basic-addon2" >

                                <option value="-1">***No Transaction***</option>

                                @foreach( $transactionlist as $key => $e )

                                    <option value="{{$e->pk_salesmstr}}">
                                        {{$e->trxdescription}}
                                    </option>

                                @endforeach

                            </select><!--form-control-->


                            <div class="input-group-append">
                                <button id="NewTransaction" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-plus"></i></button>
                            </div>

                        </div><!--END input-group-->


                        <div class="text-center" id="loadingtransactions" hidden  >
                            <br>
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                        </div>


                        <div id="divtransactions">

                            <br>

                            <div class="form-group" >
                                <div class="checkbox"> 

                                    <input type="checkbox" id="filterCollapseCheckbox" name="filterCollapseCheckbox"  ng-model="vm.filterCollapseCheckbox" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >

                                    <label for="filterCollapseCheckbox" data-toggle="tooltip" title="customer, discounts" data-placement="right">
                                        Filter Preferences  
                                    </label>



                                    <a class="float-right" data-toggle="tooltip" data-placement="right" href="#" id="lastreceipt" title="Print Last Receipt" ng-disabled="vm.issubmitting" ng-click="vm.ShowReceiptModal()" >
                                        <i class="fas fa-receipt fa-2x"></i>
                                    </a>

                                </div>
                            </div>

                            <div class="collapse " id="collapseExample">

                                <div class="form-group row">
                                    <label class="col-sm-12  col-form-label" for="customer">
                                        Customer
                                    </label>
                                    <div class="col-sm-12">
                                        <select id="fk_persons" class="form-control" ></select>
                                    </div><!--END col-sm-10-->
                                </div><!--END form-group row-->

                                 <div class="form-group row">
                                    <label class="col-sm-12  col-form-label" for="customer">
                                        Discount Schemes
                                    </label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="fk_discounts" ></select><!--form-control-->
                                    </div><!--END col-sm-10-->
                                </div><!--END form-group row-->

                            </div><!--END collapse-->
                               

                            <div class="table-responsive" id="divitemlist" >

                                <!--BEGIN table itemlist-->
                                <table class="table table-sm table-striped mb-0">
                                    <thead class="text-muted">
                                        <th width="10px"></th>
                                        <th width="20px">Description</th>
                                        <th width="10px">Price</th>
                                        <th width="20px">Qty</th>
                                        <th width="20px">Total</th>
                                    </thead>
                                </table>

                                <div class="table-responsive" style="height: 280px;overflow-y:scroll; display:block; background:#fff;" >

                                    <table class="table table-sm table-striped mb-0" >
                                        <thead class="text-muted">
     
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="list in vm.salesdtl">
                                                <td width="10px">
                                                    <span class="text-danger" style="cursor: pointer;" ng-click="vm.RemoveItem(list)">
                                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                    </span>
                                                </td>
                                                <td width="20px">@{{list.name}}</td>
                                                <td width="10px">@{{list.unitprice | number:2}}</td>
                                                <td width="50px">
                                                    <span class="form-group">
                                                        <input type="number"
                                                            ng-model="list.qty" 
                                                            class="form-control" 
                                                            min="1"
                                                            style="width: 80px;" 
                                                            ng-change="vm.ValidateNumber(list, 'qty')"
                                                            ng-model-options="{debounce: 500}"
                                                            string-to-number
                                                        />
                                                    </span>
                                                </td>
                                                <td width="20px">@{{list.totalamount | number:2}}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>

                                </div><!--END scroll-->

                                
                            </div><!--END divitemlist-->
                           


                            <div id="divsubtotal" >
                                <!--BEGIN card subtotal-->
                                <div class="table-responsive" style="background: white;" >
                                    <table class="table table-sm table-striped mb-0">
                                        <thead class="text-primary">
                                           
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <th>SubTotal</th>
                                                <td class="text-right text-danger">
                                                    @{{vm.subtotal | number:2}}
                                                </td>
                                                
                                            </tr>

                                            <tr>
                                                <th>Discount</th>
                                                <td class="text-right text-danger">
                                                    @{{vm.totaldiscount | number:2}}
                                                    
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Order Tax</th>
                                                <td class="text-right text-danger">
                                                    @{{vm.totaltax | number:2}}
                                                </td>
                                            </tr>
                                           
                                            <tr class="" style="">
                                                <th>Net</th>
                                                <td class="text-right text-danger">
                                                    @{{vm.netamount | number:2}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--END card subtotal-->
             
                            </div><!--END divsubtotal-->


                            <div class="">

                                <button type="button" class="btn btn-bordred-danger waves-effect  width-md col-md-5" id="btncancel" ng-disabled="vm.issubmitting" ng-click="vm.CancelTransaction()">
                                    &nbsp;Cancel
                                </button>

                                <button type="button" class="btn btn-bordred-success waves-effect  width-md col-md-5 " id="btnpayment" ng-disabled="vm.issubmitting" ng-click="vm.ShowPaymentModal()" >
                                    Payment
                                </button>

                            </div>

                         
                        </div><!--END divtransactionlist-->


                    </div><!--END card-box-->
                    
                </div><!--END col-md-4-->

                
                <div class="col-md-8">

                    <br>
                
                    <div class="row">

                        <div class="col-md-4">

                            <select class="form-control" style="cursor: pointer;" ng-model="vm.category" ng-disabled="vm.issubmitting" ng-change="vm.SearchCategory()"  >

                                <option value="">All Product Category</option>

                                @foreach( $categories as $e )

                                    <option value="{{$e}}">
                                        {{$e}}
                                    </option>

                                @endforeach

                            </select><!--form-control-->
                            
                        </div><!--END col-md-4-->

                    

                        <div class="col-md-4">

                            <div class="input-group">

                               <input type="text" id="searchbarcode" class="form-control" placeholder="Enter barcode here...." ng-model="vm.searchbarcode" ng-change="vm.SearchBarcode()" ng-model-options="{debounce: 500}"  style="background: white">


                                <div class="input-group-append">
                                    <button id="NewTransaction" class="btn btn-dark waves-effect waves-light" type="button" ng-click="vm.SearchProducts()">
                                        <i class=" fas fa-barcode" aria-hidden="true"></i>
                                    </button>
                                </div>

                            </div><!--END input-group-->
                            
                        </div><!--END col-md-4-->

                        <div class="col-md-4">

                            <div class="input-group">

                               <input type="text" id="searchitems" class="form-control" placeholder="Search item description here...." ng-model="vm.searchitems" ng-change="vm.SearchProducts()" ng-model-options="{debounce: 500}"  >


                                <div class="input-group-append">
                                    <button id="NewTransaction" class="btn btn-dark waves-effect waves-light" type="button" ng-click="vm.SearchProducts()">
                                        <i class=" fas fa-redo" aria-hidden="true"></i> 
                                    </button>
                                </div>

                            </div><!--END input-group-->
                            
                        </div><!--END col-md-4-->
                           
                    </div><!--END row-->

                    <br>

                    <div style="overflow-y:scroll; display:block; height:700px; background-color:;">


                        <div class="text-center" id="loadingsearchitem" hidden >
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                        </div> 

                        <div id="divproductlist">

                            <div class="row" >

                                <div class="col-xl-3 col-md-3" ng-repeat="list in vm.productlist" style="">

                                    <div class="card-box" style="padding:10px;height:240px;" >

                                        <a href="#" ng-click="vm.AddItem(list, 1, 'click')" >

                                            <h3 class="header-title mt-0 mb-4" style="text-align: center;">
                                                @{{list.name}}
                                            </h3>

                                            <div class="widget-chart-1" style="margin-top: -40px;">
                                                
                                                <div class="text-center" style="font-size: 80px;">

                                                   <img ng-if="list.pictx != null && list.pictx != ''" class="img-rounded img-raised img-responsive" ng-src="{{asset('/storage/')}}/@{{list.pictx}}" style="width: 100px; height: 100px;" >

                                                    <img ng-if="list.pictx == null || list.pictx == ''" class="img-rounded img-raised img-responsive" ng-src="{{asset('/img/apple-icon.png')}}/@{{list.pictx}}" style="width: 100px; height: 100px;" >

                                                </div>

                                                <div class="widget-detail-1 text-center" >

                                                    <p class="text-dark mb-1" > 
                                                        <b>Price: </b>@{{list.price | number:2}} 
                                                    </p>

                                                    <p class="text-dark mb-1"> 
                                                        <b>Disc%: </b>@{{list.discount | number:2}}
                                                    </p>

                                                </div>

                                            </div><!--END widget-chart-1-->

                                        </a>

                                    </div><!--END card-box-->

                                    <br>

                                </div><!--END col-xl-3 col-md-6-->


                            </div><!--END row-->


                            <div class="float-left"  ng-if="vm.productlist.length>0">
                               

                                <button class="btn btn-sm btn-bordred-info waves-effect  width-md" ng-disabled="!vm.pagination.prev_page_url" ng-click="vm.paginateList(vm.pagination.prev_page_url)">
                                    <i class="fa fa-angle-left"></i>
                                    Back
                                </button>

                                <button class="btn btn-sm btn-bordred-info waves-effect  width-md" ng-disabled="!vm.pagination.next_page_url" ng-click="vm.paginateList(vm.pagination.next_page_url)">
                                    <i class="fa fa-angle-right"></i>
                                    Next
                                </button>
                            
                                 <br> <br>
                            </div>

                           

                        </div><!--END divproductlist-->

                   
                    </div><!--END overflow-y:scroll-->
                        
              
                </div><!--END col-8-->
                
            </div><!--END row-->


            @include('layouts.newpaymentsmodal')

            @include('layouts.receiptmodal', ['company'=> $company, 'stores'=> $stores])



        </div><!--END col-12-->

        

    </div><!--END class="row"-->

@endsection
