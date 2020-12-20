<div class="row">
  		
    <div class="col-12">

    	{{--@include('layouts.alert-default')--}}

		<div class="card-box">

			{{--
				one dimensional form
				enctype = multipart/form-data ...... allow form to accept file uploads
			--}}
			<form method="POST" action="{{$form_url}}" enctype="multipart/form-data" class="jqvalidate-form">

				{{ csrf_field() }}

				<input type="hidden" class="form-control" name="form_title" id="form_title" value="{{$form_title}}" hidden >

			    @foreach ($form_fields['form'] as $a)

			    	 <div class="row">

			            <div class="col-md-12">

			            	<div id="{{$a['divID']}}">

			                	@if( $a['type'] == 'text' || $a['type'] == 'email' || $a['type'] == 'number' || $a['type'] == 'password' || $a['type'] == 'date' )

			                		@php
				                        $maxlength = (isset($a['maxlength'])) ? $a['maxlength'] : '';
				                        $placeholder = (isset($a['placeholder'])) ? $a['placeholder'] : '';
				                        $required = (isset($a['required'])) ? $a['required'] : '';
				                        $min =  (isset($a['min'])) ? $a['min'] : '';
				                        $max =  (isset($a['max'])) ? $a['max'] : '';
				                        $step =  (isset($a['step'])) ? $a['step'] : '';
				                    @endphp


		                            <div class="form-group row">

	                                    <label class="col-sm-2  col-form-label" for="{{$a['name']}}">
	                                    	{{$a['description']}}

				                        	@if ( $a['required'] == 'required')
				                               <span class="text-danger">*</span>
				                            @endif
	                                    </label>
	                                    
	                                    <div class="col-sm-10">

	                                        <input type="{{$a['type']}}" 
					                            id="{{$a['id']}}"
					                            name="{{$a['name']}}" 
					                            class="form-control"
					                            value="{{$a['value']}}" autocomplete="false" 
					                            {{$maxlength}} 
					                            {{$placeholder}}
					                            {{$required}}
					                            {{$min}}
					                            {{$max}}
					                            {{$step}}
					                            >

	                                    </div><!--END col-sm-10-->

	                                </div><!--END form-group row-->

			                    {{--END text--}}

			                    @elseif( $a['type'] == 'textarea' )

			                    	@php
				                        $required = (isset($a['required'])) ? $a['required'] : '';
				                        
				                    @endphp

				                    <div class="form-group row">

	                                    <label class="col-sm-2  col-form-label" for="{{$a['name']}}">
	                                    	{{$a['description']}}

				                        	@if ( $a['required'] == 'required')
				                               <span class="text-danger">*</span>
				                            @endif
	                                    </label>
	                                    
	                                    <div class="col-sm-10">

	                                        <textarea id="{{$a['id']}}"
					                            name="{{$a['name']}}" 
					                            class="form-control"
					                    		rows="5"  
					                    		{{$required}}
					                    		>{{$a['value']}}</textarea>

	                                   	</div><!--END col-sm-10-->

	                                </div><!--END form-group row-->


			                    {{--END textarea--}}


			                    @elseif( $a['type'] == 'file' )

			                    	@php
				                        $required = (isset($a['required'])) ? $a['required'] : '';
				                        $placeholder = (isset($a['placeholder'])) ? $a['placeholder'] : '';
				                    @endphp


				                    <div class="form-group row">

	                                    <label class="col-sm-2  col-form-label" for="{{$a['name']}}">
	                                    	{{$a['description']}}

				                        	@if ( $a['required'] == 'required')
				                               <span class="text-danger">*</span>
				                            @endif
	                                    </label>
	                                    
	                                    <div class="col-sm-10">

                                    	
										    <input type="file" 
										    	id="{{$a['id']}}" 
										    	name="{{$a['name']}}" 
										    	multiple=""
										    	{{$required}} 
										    >
										
										    <br>
											{{--show preview only if file is image--}}
					                        @if( $a['name'] == 'pictx' && $a['value']  && $form_title != 'create'  )


												<br>
												<div class="" style="width: 110px" >
					                                <img src="{{asset('/storage/'.$a['value'])}}" style="width: 80px; height: 80px;" >

					                            </div>
					                            <br>

					                            <div class="form-group">
						                            <div class="checkbox"> 

						                                <input type="checkbox" id="removepictx" name="removepictx">

						                                <label for="removepictx">

						                                   	Remove  

						                                </label>

						                            </div>
						                        </div>


							                <!--END col-lg-3-->
							                @endif

							                {{--show download button if file is an attachment and form title is not  create--}}
					                        @if( $a['name'] == 'attachment' && $form_title != 'create' && $a['value'] != null )
												<br>
												<a href="{{asset('/storage/'.$a['value'])}}" target="_blank" style="width: 110px" 
													rel="tooltip" title="Download Attachment" 
												 >
													<i class=" fas fa-download"></i> Download
												</a>

												<br><br>


					                            <div class="form-group">
						                            <div class="checkbox"> 

						                                <input type="checkbox" id="removeattachment" name="removeattachment">

						                                <label for="removeattachment">

						                                   	Remove  

						                                </label>

						                            </div>
						                        </div>

												
							                <!--END col-lg-3-->
							                @endif

	                                        
											

	                                   	</div><!--END col-sm-10-->

	                                </div><!--END form-group row-->

			                    {{--END file--}}


			                    @elseif( $a['type'] == 'select' )

			                    	 <div class="form-group row">

	                                    <label class="col-sm-2  col-form-label" for="{{$a['name']}}">
	                                    	{{$a['description']}}

				                        	@if ( $a['required'] == 'required')
				                               <span class="text-danger">*</span>
				                            @endif
	                                    </label>
	                                    
	                                    <div class="col-sm-10">

	                                        <select type="{{$a['type']}}" 
					                            id="{{$a['id']}}"
					                            name="{{$a['name']}}" 
					                            class="form-control"
					                            value="{{$a['value']}}"
					                        >

					                            @foreach( $a['option'] as $e )
					                            	<option value="{{$e['value']}}" 
					                            		{{ ($a['value'] == $e['value'])  ? 'selected' : '' }}
					                            	> 
					                            		{{$e['description']}} 
					                            	</option>
					                            @endforeach


					                            @if ($a['name'] == 'fk_categories')

					                          
					                            	{{--manual assignment of form prerequisites @the controller--}}
					                                @foreach ($categories as $e)
					                                   <option value="{{$e->pk_categories}}" {{ ($a['value'] == $e->pk_categories) ? 'selected': '' }} > 
					                                        {{ $e->description }}
					                                   </option>
					                                @endforeach
					                            @endif


					                            @if ($a['name'] == 'fk_supplier')

					                            	{{--default--}}
					                        		<option value="-1"  > 
					                                   No Supplier...
					                               	</option>

					                            	{{--manual assignment of form prerequisites @the controller--}}
					                                @foreach ($supplier as $e)
					                                   <option value="{{$e->pk_persons}}" {{ ($a['value'] == $e->pk_persons) ? 'selected': '' }} > 
					                                        {{ $e->fullname }}
					                                   </option>
					                                @endforeach
					                            @endif


					                            @if ($a['name'] == 'fk_stores')

					                            	{{--manual assignment of form prerequisites @the controller--}}
					                                @foreach ($stores as $e)
					                                   <option value="{{$e->pk_stores}}" {{ ($a['value'] == $e->pk_stores) ? 'selected': '' }} > 
					                                        {{ $e->name }}
					                                   </option>
					                                @endforeach
					                            @endif
					                           
					                           
					                           


					                        </select>{{--END select--}}


	                                   	</div><!--END col-sm-10-->

	                                </div><!--END form-group row-->


			                        
			                   	{{--END select--}}

			                    @elseif( $a['type'] == 'checkbox' )

			                    	@php
			                    		$activeon = ( $a['value'] == 1 ) ? 'checked' : '';
			                    	@endphp


			                    	<div class="form-group row">


	                                    <label class="col-sm-2  col-form-label" >
	                                    	
	                                    </label>
	                                    
	                                    <div class="col-sm-10">

				                    		<div class="form-group">
				                                <div class="checkbox">
				                                    <input type="checkbox" id="{{$a['name']}}" name="{{$a['name']}}" {{$activeon}} >
				                                    <label for="{{$a['name']}}">
				                                        {{$a['description']}}
				                                    </label>
				                                </div>
				                            </div>

	                                   	</div><!--END col-sm-10-->

	                                </div><!--END form-group row-->



			                	@endif

			            	</div><!--END form-group label-floating-->

			                
			            </div><!--END col-md-12-->

			        </div><!--END row-->


			    @endforeach


      	
      			<hr>

			    <div class="widget-chart-1">
                    
                    <div class="widget-chart-box-1 float-left" dir="ltr">


						@if( strpos(url()->current(), '/profile') === false )
							{{--btn btn-default btn-round --}}
					        <a href="{{$back_url}}" class="pull-left btn btn-lighten-secondary waves-effect  width-md" rel="tooltip" title="Go Back"  >
					        	Go Back
					        </a>
						@endif
                      	
                      	

                    </div>

                    <div class="widget-detail-1 text-right">

                        @if( $form_title != 'show' )

				        	<button type="submit" class="pull-right btn btn-bordred-primary waves-effect  width-md">
				        		Save
				        	</button>

				        @endif

                    </div>
                </div>

			 
			    <br><br>
				
			</form><!--END form-->

		</div><!--END card-box-->

	</div><!--END col-12-->

</div><!--END row-->



