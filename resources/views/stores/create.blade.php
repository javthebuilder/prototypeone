@extends('layouts.master')

@section('title', 'RESTO POS - Stores - New')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/stores">Stores</a></li>

            <li class="breadcrumb-item active">New</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/stores" title="">  Stores </a> > New </h4>

@endsection


@section('content')
     
   
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'create', 'form_url'=> '/stores/create', 'back_url'=> '/stores' ])

@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])


@endsection
