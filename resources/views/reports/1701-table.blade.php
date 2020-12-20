<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                
                <thead>

                    <tr>
                        <th>Store</th>
                        <th>Particulars</th>
                        <th>Date</th>
                        <th data-priority="1">Adjustment</th>
                        <th data-priority="2">Qty Out</th>
                        <th data-priority="3">RunningBalance</th>
                        <th data-priority="5">Remarks</th>
                        <th data-priority="4">Encodedby</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($results as $s)

                        <tr>
                            
                        

                            <td>{{$s->storename}}</td>
                            <td>{{$s->particulars}}</td>
                            <td>{{$s->customdocdate}}</td>

                            @if( $s->doctype == 'beginning' )

                                @php
                                    $runningbalance = $s->qty + $s->oldqty; 
                                @endphp

                                <td></td>
                                <td></td>
                                <td> 
                                    {{number_format($runningbalance , 2 )}} 
                                </td>
                                <td></td>

                            @elseif( $s->doctype  == 'adj')

                                @php
                                    $runningbalance = $s->qty + $s->oldqty; 
                                @endphp

                                <td>
                                    {{
                                        number_format($runningbalance , 2 )
                                    }}
                                </td>
                                                                                
                                <td>

                                </td>
                                
                                <td> 
                                    {{number_format($runningbalance , 2 )}} 
                                </td>
                                <td>{{$s->qtyadjremarks}}</td>

                            @elseif( $s->doctype == 'sales' )

                                @php
                                    $runningbalance = $runningbalance  - $s->qty; 
                                @endphp

                                <td></td>
                                <td>
                                    {{ number_format($s->qty , 2 ) }}
                                </td>
                                <td> 
                                    {{number_format($runningbalance , 2 )}} 
                                </td>
                                <td></td>

                            @endif



                            <td>
                                {{$s->encoded_by}}
                            </td>


                        </tr>


                     
                    @endforeach

                
                </tbody>

            </table><!--END table table-sm table-striped mb-0-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


@include('reports.footer-rundate')
