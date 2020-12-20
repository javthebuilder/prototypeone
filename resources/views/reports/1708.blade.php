<div class="text-center">

  @if(count($results) > 0)

    <p>
      
      <a href="{{url()->current()."?export=true"}}" title="">
          <i class="fa fa-download" aria-hidden="true"></i>
          &nbsp;Download Data
      </a>

      &nbsp;&nbsp;
      <a href="#" title="" id="printreport">
          <i class="fa fa-print" aria-hidden="true"></i>
        &nbsp;Print
      </a>

    </p>
    

  @endif


  <b class="text-muted">
    {{$reports[0]->description}} {{$audittype}}
                    
  </b>

</div>

<hr>


@include('reports.1708-table')
