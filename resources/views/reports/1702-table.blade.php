<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                

                <thead class="">

                    <tr>

                        <th>Store</th>
                        <th>Doc No.</th>
                        <th>Date</th>
                        <th data-priority="1">Cashier</th>
                        <th data-priority="2">Payername</th>

                        @if($reporttype == 'Summary')

                            <th data-priority="3">Net Amount</th>
                            <th data-priority="4">Paid Amount</th>
                            <th data-priority="5">Balance</th>

                        @elseif($reporttype == 'Details')

                            <th data-priority="3">Item</th>
                            <th data-priority="4">Category</th>
                            <th data-priority="5">Qty</th>
                            <th data-priority="6">Unit Price</th>
                            <th data-priority="7">Net Amount</th>

                        @endif

                    </tr>
                    
                </thead>

                <tbody>

                    @php


                        $totalnet = 0; $totalpaid = 0; $totalbalance = 0;


                    @endphp

                    @foreach($results as $s)

                    	<tr>
                    		
                    	

                            @php

                                $classbalance = ( $s->balanceamount > 0 ) ? 'text-danger' : '';

                                if ($reporttype == 'Summary') {

                                    $totalnet += floatval($s->netamount);
                                    $totalpaid += floatval($s->paidamount);
                                    $totalbalance += floatval($s->balanceamount);

                                } else if ($reporttype == 'Details') {

                                    $totalnet += floatval($s->itemnetamount);

                                }

                            @endphp

                            <td>{{$s->storename}}</td>
                            <td>{{ str_pad($s->pk_salesmstr, '5', '0', STR_PAD_LEFT) }}</td>
                            <td>{{$s->docdate}}</td>
                            <td>{{$s->cashiername}}</td>
                            <td>{{$s->payername}}</td>

                            @if($reporttype == 'Summary')'
                            
                                <td>{{ number_format($s->netamount, 2)  }}</td>
                                <td>{{ number_format($s->paidamount, 2)  }}</td>
                                <td class="{{$classbalance}}">{{ number_format($s->balanceamount, 2)  }}</td>

                            @elseif($reporttype == 'Details')

                                <td>{{ $s->itemname  }}</td>
                                <td>{{ $s->category  }}</td>
                                <td>{{ $s->qty  }}</td>
                                <td>{{ number_format($s->unitprice, 2)  }}</td>
                                <td>{{ number_format($s->itemnetamount, 2)  }}</td>

                            @endif
                            


                    	</tr>


                     
                    @endforeach


                    <tr>
                        
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        @if($reporttype == 'Summary')'

                            <th>{{ number_format($totalnet, 2) }}</th>
                            <th>{{ number_format($totalpaid, 2) }}</th>
                            <th>{{ number_format($totalbalance, 2) }}</th>

                        @elseif($reporttype == 'Details')

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($totalnet, 2) }}</th>
                            

                        @endif
                        
                    </tr>

                </tbody>


            </table><!--END table-responsive-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


    
@include('reports.footer-rundate')

