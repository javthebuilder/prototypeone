@extends('layouts.master')

@section('title', 'RESTO POS - Customers.Suppliers - Edit')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/persons">Customers.Suppliers</a></li>

            <li class="breadcrumb-item active">Edit</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/persons" title="">  Customers.Suppliers </a> > Edit </h4>

@endsection


@section('content')
     
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'edit', 'form_url'=> "/persons/edit/$persons->pk_persons", 'back_url'=> '/persons' ])

@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])

@endsection