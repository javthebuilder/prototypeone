@extends('layouts.master')

@section('title', 'RESTO POS - Users - Accessibility')

@section('custom_headerscripts')	
  	<script src="/customjs/UsersController.js?v{{time()}}" type="text/javascript"></script>
@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/users">Users</a></li>

            <li class="breadcrumb-item active">Accessibility</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/users" title="">  Users </a> > Accessibility </h4>

@endsection




@section('content')
     
    
    <div class="row"  ng-app="app" ng-controller="UsersController as vm" ng-cloack>

        <div class="col-12">

            <div class="card-box">


        		<input type="hidden" class="form-control" name="form_title" id="form_title" value="accessibility"  >

        		<div class="form-group row" hidden>
                    <label class="col-sm-2  col-form-label" for="code">Code</label>
                    <div class="col-sm-10">
                       <input type="text" id="pk_userid" class="form-control" readonly="true"  value="{{$users->id}}" >
                    </div>
                </div>
         		
         		<div class="form-group row">
                    <label class="col-sm-2  col-form-label" for="fullname">Fullname</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" readonly="true" value="{{$users->name}}" >
                    </div>
                </div>
   

            	<ul class="nav nav-tabs">

                    <li class="nav-item">
                        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Modules</span>            
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <span class="d-block d-sm-none"><i class="fas fa-store"></i></span>
                            <span class="d-none d-sm-block">Stores</span> 
                        </a>
                    </li>


                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade show active" id="home1">

                    	<p class="mb-0">

                    		<div class="form-group row">
       
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" placeholder="search module..." ng-model="vm.searchmodule">
                                </div>
                            </div>


                            <!--BEGIN div module well well-small well-shadow -->
						    <div class="" style="overflow-y:scroll; display:block;height:400px" >

						    	<div class="" ng-repeat="list in vm.modules | filter:vm.searchmodule">


						    		<div data-toggle="tooltip" data-placement="right"  title="Parent Module" class="" ng-show="list.type == 'A'" ><!--box-header-->
								       	<hr>

								       	<div class="form-group">
			                                <div class="checkbox"> &nbsp;
			                                    <input type="checkbox" id="@{{list.pk_permalink}}" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" >
			                                    <label for="@{{list.pk_permalink}}">
			                                       @{{list.description}}
			                                    </label>
			                                </div>
			                            </div>

					                    <hr>
					              
								    </div><!--END type == A-->



						    		<div data-toggle="tooltip" data-placement="right" title="@{{list.tips}}"  class="" ng-show="list.type == 'B'">

						    			<div class="form-group" style="margin-left: 30px;">
			                                <div class="checkbox"> 

			                                    <input type="checkbox" id="@{{list.pk_permalink}}" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" >

			                                    <label for="@{{list.pk_permalink}}">

			                                       @{{list.description}}

			                                        <span class="pull-right text-info" style="font-size: 10px; ">
										            	&nbsp;&nbsp;&nbsp; @{{list.tips}}
										            </span>

			                                    </label>

			                                </div>

			                              

			                            </div>

					    			
								    </div><!--END type == B-->


								    <div rel="tooltip" title="@{{list.tips}}" ng-show="list.type == 'C' " >

								    	<div class="form-group" style="margin-left: 50px;">
			                                <div class="checkbox"> 
			                                    
			                                    <input type="checkbox" id="@{{list.pk_permalink}}" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" >

			                                    <label for="@{{list.pk_permalink}}">

			                                       	@{{list.description}}

			                                        <span class="pull-right text-info" style="font-size: 10px; ">
										            	&nbsp;&nbsp;&nbsp; @{{list.tips}}
										            </span>

			                                    </label>

			                                </div>

			                              

			                            </div>


								    </div><!--END type == C-->    


						    	</div><!--END ng-repeat-->


						    </div><!--END overflow-->

					    	<br>
					    	<hr>
					    	<div class="form-group">
	                            <div class="checkbox"> 

	                                <input type="checkbox" id="isSelectAllModules" ng-model="vm.isSelectAllModules" ng-change="vm.SelectDeselect(null, 'modules')" >

	                                <label for="isSelectAllModules">

	                                   	[ Select / Deselect ]

	                                </label>

	                            </div>
	                        </div>
                    		
                    	</p><!--END mb-0-->

                    </div><!--END tabpanel-->

                    <div role="tabpanel" class="tab-pane fade" id="profile1">
                        
                        <p class="mb-0">

                        	<div class="form-group row">
       
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" placeholder="search stores..." ng-model="vm.searchstore">
                                </div>
                            </div>


                			<!--BEGIN div module well well-small well-shadow -->
						    <div style="overflow-y:scroll; display:block;height:400px" >

						    	<div class="">{{--table-responsive--}}
	                                
	                                <table class="table table-striped table-sm">

	                                    <thead class="text-muted">
	                                        <th></th>
	                                        <th>Name</th>
	                                        <th>Address</th>
	                                        <th>Contact</th>
	                                    </thead>

	                                    <tbody>

	                                        <tr ng-repeat="list in vm.stores | filter:vm.searchstore">
	                                            <td>

	                                            	<div class="form-group">
							                            <div class="checkbox"> 

							                                <input type="checkbox" id="@{{list.pk_stores}}" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'stores')"  >

							                                <label for="@{{list.pk_stores}}">

							                                   	@{{list.pk_stores}}

							                                </label>

							                            </div>
							                        </div>

	                                            

	                                            </td>
	                                            <td>@{{list.name}}</td>
	                                            <td>@{{list.address}}</td>
	                                            <td>@{{list.phone}}</td>
	                                        </tr>
	                                        
	                                    </tbody>

	                                </table>

	                            </div><!--END table-response-->

				

                			</div><!--END overflow-y:scrol-->


					    	<br>
					    	<hr> 

					    	<div class="form-group">
	                            <div class="checkbox"> 

	                                <input type="checkbox" id="isSelectAllStores" ng-model="vm.isSelectAllStores"  ng-change="vm.SelectDeselect(null,'stores')"  >

	                                <label for="isSelectAllStores">

	                                   	[ Select / Deselect ]

	                                </label>

	                            </div>
	                        </div>

                        </p><!--END mb-0-->

                    </div><!--END tabpanel-->

                </div><!--END tab-content-->

           

                @include('layouts.ajaxsubmit', ['back_url'=> '/users', 'angularalaias'=> 'vm'])


            </div><!--END card-box-->

        </div><!--END col-12-->

    </div>
    <!-- end row -->

@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])


@endsection