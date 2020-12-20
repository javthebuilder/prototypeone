@extends('layouts.master')

@section('title', 'RESTO POS - Products - Compositions')

@section('custom_headerscripts')    

    <script src="/customjs/ProductsCompositionsController.js?v{{time()}}" type="text/javascript"></script>

@endsection


@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/products">Products</a></li>

            <li class="breadcrumb-item active">Compositions</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/products" title="">  Products </a> > Compositions </h4>

@endsection


@section('content')
     
	<div class="row" ng-app="app" ng-controller="ProductsController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box">

                <div class="alert alert-info"> Item Compositions for  {{$products->name}}  </div>

            	<input type="hidden" name="pk_products" id="pk_products" value="{{$products->pk_products}}">

            	<div class="row">

            	
            		<div class="col-md-4" >

            			<div class="table-responsive">

	                		<input type="text" name="" placeholder="search here..." ng-model="vm.search" ng-change="vm.Search()" ng-model-options="{debounce: 500}" class="form-control"  >
	                		<br>


	            			<table class="table table-sm table-striped mb-0" style="overflow-y:scroll; display:block;height:350px;">
	                			
	                			{{--<thead>
	                				
	                				<th>Product Name</th>
	                				<th></th>

	                			</thead>--}}


	                			<tbody>
	                					
	                				<tr ng-repeat="list in vm.searchitems">

	                					<td> @{{list.name}} </td>
	                					
	                					<td>
	                						
	                						<button type="button" name="" ng-click="vm.AddCompositions(list)" class="btn btn-success btn-sm" >  Add </button>

	                					</td>

	                				</tr>	

	                			</tbody>

	                		</table>


            			</div><!--END table-responsive-->


                	</div><!--END col-md-4-->


                	<div class="col-md-8">

                		<div class="table-responsive">

                			<table class="table table-sm table-striped mb-0" style="">
	                			<thead>
	                				
	                				<th>Product Name</th>
	                				<th>Qty</th>
	                				<th>Action</th>

	                			</thead>


	                			<tbody>
	                					
	                				<tr ng-repeat="list in vm.compositions">

	                					<td> @{{list.name}} </td>
	                					<td>
	                						<input type="number" name="" ng-model="list.qty" ng-change="vm.isNumber(list, 'qty')"
	                                        ng-model-options="{debounce: 500}" class="form-control col-md-6" string-to-number >
	                					</td>
	                					<td>
	                						
	                						<button type="button" name="" ng-click="vm.RemoveCompositions(list)" class="btn btn-danger btn-sm" >  Remove </button>
	                					

	                					</td>

	                				</tr>	

	                			</tbody>

	                		</table>

                		</div><!--END table-responsive-->

                	</div><!--END col-md-8-->
            		
            	</div>


      			<hr>

			    <div class="widget-chart-1">
                    
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                      	
                        <a href="{{url()->previous()}}" class="pull-left btn btn-lighten-secondary waves-effect  width-md" rel="tooltip" title="Go Back"  >
				        	Go Back
				        </a>


                    </div>

                    <div class="widget-detail-1 text-right">

                        <button type="submit" class="pull-right btn btn-bordred-primary waves-effect  width-md" ng-click="vm.SubmitCompositions()">
					    	Save
					    </button>

                    </div>
                </div>


    

             

            </div><!--END card-box-->

        </div><!--END col-12-->





    </div>
    <!-- end row -->


@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])


@endsection