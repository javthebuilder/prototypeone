@extends('layouts.master')

@section('title', 'RESTO POS - Categories - New')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/categories">Categories</a></li>

            <li class="breadcrumb-item active">New</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/categories" title="">  Categories </a> > New </h4>

@endsection


@section('content')
     
  
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'create', 'form_url'=> '/categories/create', 'back_url'=> '/categories' ])

@endsection



@section('custom_footerscripts')

	
	@include('layouts.alert', ['alerttype'=> 'pnotify'])

	<script type="text/javascript">
		
		//initialize select2
		$("select").select2();//initialize jquery select2 plugin; 
	
	</script>

@endsection

