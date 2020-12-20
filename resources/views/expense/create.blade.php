@extends('layouts.master')

@section('title', 'RESTO POS - Finance - Expense / New')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/expense">Expense</a></li>

            <li class="breadcrumb-item active">New</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/expense" title="">  Expense </a> > New </h4>

@endsection


@section('content')
     
  
	
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'create', 'form_url'=> '/expense/create', 'back_url'=> '/expense' ])



@endsection



@section('custom_footerscripts')

	
	@include('layouts.alert', ['alerttype'=> 'pnotify'])
	<script type="text/javascript">
		//initialize select2
		$("select").select2();//initialize jquery select2 plugin; 

	</script>


@endsection

