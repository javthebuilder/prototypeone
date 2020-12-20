@extends('layouts.master')

@section('title', 'RESTO POS - Users - New')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/users">Users</a></li>

            <li class="breadcrumb-item active">New</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/users" title="">  Users </a> > New </h4>

@endsection


@section('content')
     
    
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'create', 'form_url'=> '/users/create', 'back_url'=> '/users' ])


@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])


@endsection