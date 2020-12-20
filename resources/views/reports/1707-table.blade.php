<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                

                <thead>

                    <tr>
                        <th>Store</th>
                        <th>Cashier</th>
                        <th>Date</th>
                        <th>Docno</th>
                        <th data-priority="1">Payername</th>

                        @if($reporttype == 'Summary')
                            <th data-priority="2">Net Amount</th> 
                            <th data-priority="3">Paid Amount</th> 
                            <th data-priority="4">Balance Amount</th> 
                        @elseif($reporttype == 'Details')
                            <th data-priority="3">Pay Date</th> 
                            <th data-priority="4">Pay DocNo</th> 
                            <th data-priority="5">Paid Amount</th> 
                            <th data-priority="5">Pay Remarks</th> 
                        @endif
                        
                    </tr>


                </thead>

                <tbody>

                    @php
                        $totalnet = 0;
                        $totalpaid = 0;
                        $totalbalance = 0;
                    @endphp


                    @foreach($results as $s)

                     
                        <tr>
                        
                            <td>{{$s->storename}}</td>
                            <td>{{$s->cashiername}}</td>
                            <td>{{$s->created_at}}</td>
                            <td>{{$s->docno}}</td>
                            <td>{{$s->payername}}</td>
                            

                            @php
                            

                                if ($reporttype == 'Summary') {
                                    
                                    $totalnet += floatval($s->netamount);
                                    $totalpaid += floatval($s->totalpayment);
                                    $totalbalance += floatval($s->netamount) - floatval($s->totalpayment);

                                } else if ($reporttype == 'Details') {

                                    $totalpaid+= floatval($s->payamount);

                                }

                            @endphp

                            
                            @if($reporttype == 'Summary')
                                <td>{{ number_format($s->netamount, 2)  }}</td>
                                <td>{{ number_format($s->totalpayment, 2)  }}</td>
                                <td>{{ number_format((floatval($s->netamount) - floatval($s->totalpayment)), 2)  }}</td>
                            @elseif($reporttype == 'Details')
                                <td>{{ $s->paydate  }}</td>
                                <td>{{ $s->paydocno  }}</td>
                                <td>{{ number_format($s->payamount, 2)  }}</td>
                                <td>{{ $s->payremarks  }}</td>
                            @endif
                            
                        </tr>   

                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        @if($reporttype == 'Summary')
                            <td> {{number_format($totalnet, 2)}} </td>
                            <td> {{number_format($totalpaid, 2)}} </td>
                            <td> {{number_format($totalbalance, 2)}} </td>
                        @elseif($reporttype == 'Details')
                            <td></td>
                            <td></td>
                            <td> {{number_format($totalpaid, 2)}} </td>
                            <!--<td> {{number_format((floatval($totalnet) - floatval($totalpaid)), 2)}} </td>-->
                            <td></td>
                        @endif

                    </tr>


                </tbody>


            </table><!--END table-responsive-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


    
@include('reports.footer-rundate')

