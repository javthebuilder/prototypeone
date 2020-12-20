@extends('layouts.master')

@section('title', 'RESTO POS - Customers.Suppliers - Show')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/persons">Customers.Suppliers</a></li>

            <li class="breadcrumb-item active">Show</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/persons" title="">  Customers.Suppliers </a> > Show </h4>

@endsection


@section('content')
     
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'show', 'form_url'=> '/persons/show'.$persons->pk_persons, 'back_url'=> '/persons' ])

@endsection



@section('custom_footerscripts')

	<script type="text/javascript" charset="utf-8" async defer>
        $(':input').prop('disabled', true);
    </script> 


@endsection