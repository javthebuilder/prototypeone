@extends('layouts.master')

@section('title', 'RESTO POS - Finance - Expense / Show')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/expense">Expense</a></li>

            <li class="breadcrumb-item active">Show</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/expense" title="">  Expense </a> > Show </h4>

@endsection


@section('content')
     
  
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'show', 'form_url'=> '/expense/show'.$expense->pk_expense, 'back_url'=> '/expense' ])


@endsection



@section('custom_footerscripts')

	<script type="text/javascript" charset="utf-8" async defer>
        $(':input').prop('disabled', true);
    </script> 


@endsection

