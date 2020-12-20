{{--variables are initialized @the controller associated with the url--}}

@if( strpos(url()->current(), '/sales') !== false || strpos(url()->current(), '/expense') !== false )
	<input type='hidden' name='dateFrom' class='form-control'  value='{{$dateFrom}}' >
	<input type='hidden' name='dateTo' class='form-control'  value='{{$dateTo}}' >
	<input type='hidden' name='fk_stores' class='form-control'  value='{{$fk_stores}}' >
@endif

@if( strpos(url()->current(), '/expense') !== false || strpos(url()->current(), '/products') !== false )
	<input type='hidden' name='fk_categories' class='form-control'  value='{{$fk_categories}}' >
@endif

@if( strpos(url()->current(), '/persons') !== false )
	<input type='hidden' name='persontype' class='form-control'  value='{{$persontype}}' >
@endif

@if( strpos(url()->current(), '/products') !== false )
	<input type='hidden' name='producttype' class='form-control'  value='{{$producttype}}' >
@endif