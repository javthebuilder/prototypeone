@extends('layouts.master')

@section('title', 'RESTO POS - Stores - Edit')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/stores">Stores</a></li>

            <li class="breadcrumb-item active">Edit</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/stores" title="">  Stores </a> > Edit </h4>

@endsection


@section('content')
     
   
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'edit', 'form_url'=> "/stores/edit/$stores->pk_stores", 'back_url'=> '/stores' ])

@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])


@endsection
