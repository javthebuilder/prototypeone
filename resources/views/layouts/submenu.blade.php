@foreach( $sub_menu as $sm )

	<!--do not display create action. indexno = 1-->
	@if( $sm->indexno > 1 && $currentdataID != null )
		{{--
			href = /stores/edit/id or /stores/view/id
			ng-click = "vm.Delete(id,'status')"
		--}}
		@php
			$href = ( $sm->url != '#' ) ? $sm->url.'/'.$currentdataID : '#';
			$ngclick = ($sm->ngclick != null ) ? "$angularalias.$sm->ngclick($currentdataID,'$currentdataStat')" : '';
			$btnclass = ($sm->icon != 'fas fa-trash-alt') ? 'text-dark' : 'text-danger';

		@endphp

		<a href="{{ $href }}" 
			ng-click="{{ $ngclick }}" 
			data-toggle="tooltip" data-placement="right" title="{{$sm->description}}" {{--btn {{$btnclass}} btn-rounded btn-xs--}}
			class="{{$btnclass}}"
			target="{{$sm->target}}"
		
		>
        	<i class="{{$sm->icon}}"></i>
    	</a> &nbsp;

    @elseif( $sm->indexno == 1 && $currentdataID == null )
    	{{-- create button = indexno 1, currentdataID = primary key of the loop data --}}
    	<a href="{{ $sm->url }}" 
			class="btn btn-bordred-primary waves-effect  width-md waves-primary"
		>
			<i class="{{$sm->icon}}"></i>
        	{{$sm->description}}
    	</a>
      
	@endif
	
    
@endforeach



                                          
                                                            
