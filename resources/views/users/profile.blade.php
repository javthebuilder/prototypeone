@extends('layouts.master')

@section('title', 'RESTO POS - Profile')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/profile" title="">  Profile </a>  </h4>

@endsection


@section('content')
     
    @include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'edit', 'form_url'=> "/profile", 'back_url'=> '/profile' ])

@endsection



@section('custom_footerscripts')

	@include('layouts.alert', ['alerttype'=> 'pnotify'])

	<script type="text/javascript">
		$('#name').prop('readonly', true);
		$('#divstat').prop('hidden', true);
	</script>

@endsection