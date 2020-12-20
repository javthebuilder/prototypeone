<div class="text-center">

  @if(count($results) > 0)

    <p>

      <a href="{{url()->current()."?dateFrom=$dateFrom&dateTo=$dateTo&fk_stores=$fk_stores&fk_products=$fk_products&productdesc=$productdesc&export=true"}}" title="">
        <i class="fa fa-download" aria-hidden="true"></i>
          &nbsp;Download
      </a>

      &nbsp;&nbsp;
      <a href="#" title="" id="printreport">
          <i class="fa fa-print" aria-hidden="true"></i>
        &nbsp;Print
      </a>

    </p>
    

  @endif


    
  <b class="text-muted">
     {{$reports[0]->description}}
      <br>
      Product: {{$productdesc}}
      <br>
      Range : {{$dateFrom}} to {{$dateTo}}
  </b>

</div>

<hr>


@include('reports.1701-table')

		
