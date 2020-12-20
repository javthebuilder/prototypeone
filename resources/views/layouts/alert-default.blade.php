@if ($flash = session('success'))

	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Success!</strong> {{ $flash }} 
    </div>


@endif

@if ($flash = session('error'))

	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Error(s) Found!</strong> {{ $flash }}
    </div>

	
@endif

@if ( count($errors) > 0 )

	{{--<span hidden>
		<i id="notifytype">error</i>
		<i id="notifytitle"> Error(s) Found! </i>
		<i id="notifytext">@foreach ($errors->all() as $err) {{ $err }} <br> @endforeach
		</i>
	</span> --}}

	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Error(s) Found!</strong> <br> @foreach ($errors->all() as $err) {{ $err }} <br> @endforeach
    </div>

	
@endif

