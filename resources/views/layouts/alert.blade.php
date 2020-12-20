{{--norecord--}}
@if( $alerttype == 'norecord' )

	<div class="row">
		<div class="col-md-12">
			<div class="card">
	            <div class="card-header" data-background-color="grey">
	                <h4 class="title">
	                	<b>Whoops!</b> We didn't find anything to show here.
	                </h4>
	                <p class="category"></p>
	            </div>
	            <div class="card-content "></div>
	        </div>
		</div>
		
	</div><!--END row-->


@elseif( $alerttype == 'pnotify' )


	@if ($flash = session('success'))

		<span hidden>
			<i id="notifytype">success</i>
			<i id="notifytitle"> Success! </i>
			<i id="notifytext" >{{ $flash }}</i>
		</span>
	

	@endif

	@if ($flash = session('error'))

		<span hidden>
			<i id="notifytype">error</i>
			<i id="notifytitle"> Error(s) Found! </i>
			<i id="notifytext" >{{ $flash }}</i>
		</span>

		
	@endif

	@if ( count($errors) > 0 )

		<span hidden>
			<i id="notifytype">error</i>
			<i id="notifytitle"> Error(s) Found! </i>
			<i id="notifytext">@foreach ($errors->all() as $err) {{ $err }} <br> @endforeach
			</i>
		</span>

		
	@endif

    <script type="text/javascript">

    	//PNotify.prototype.options.styling = "bootstrap3";

    	if( $('#notifytype').html() != undefined ){

    		new PNotify({
			    title: $('#notifytitle').html(),
			    text: $('#notifytext').html(),
			    type: $('#notifytype').html().trim(),
			    //stack: {"dir1": "down", "dir2": "left", "firstpos1": ($(window).height() - 120)}
			});



    	}
	  	

    </script>

@endif