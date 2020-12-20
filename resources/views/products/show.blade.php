@extends('layouts.master')

@section('title', 'RESTO POS - Products - Show')

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            <li class="breadcrumb-item"><a href="/products">Products</a></li>

            <li class="breadcrumb-item active">Show</li>

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/products" title="">  Products </a> > Show </h4>

@endsection


@section('content')
     
	@include('layouts.forma', ['form_fields'=> $form_fields, 'form_title'=> 'show', 'form_url'=> '/products/show'.$products->pk_products, 'back_url'=> '/products' ])

@endsection



@section('custom_footerscripts')

	<script type="text/javascript" charset="utf-8" async defer>

        $(':input').prop('disabled', true);

    	if( $('#type').val() == 'inventory' ){

			//show inventory properties
			$('#divfk_supplier').prop('hidden', false);
			$('#divcost').prop('hidden', false);
			$('#divuom').prop('hidden', false);
			$('#divalertqty').prop('hidden', false);
			
		}else{

			//hide inventory properties
			$('#divfk_supplier').prop('hidden', true);
			$('#divcost').prop('hidden', true);
			$('#divuom').prop('hidden', true);
			$('#divalertqty').prop('hidden', true);

		}//END $('#type').val() == 'inventory'


    </script> 


@endsection