<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                

                <thead>

                    <tr>
                        <th>Store</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th data-priority="1">Remarks</th>
                        <th data-priority="2">Sales</th>
                        <th data-priority="3">Expense</th>
                        <th data-priority="4">Net</th>
                    </tr>

                    

                </thead>

                <tbody>

                    @php

                        $totalsales = 0;
                        $totalexpense = 0;
                        $totalnet = 0;



                    @endphp

                    @foreach($results as $s)

                        <tr>
                            
                        
                            
                            @php

                                $classexpense = ( $s->doctype == 'expense' ) ? 'text-danger' : '';

                                $totalsales += floatval($s->salesamount);
                                $totalexpense += floatval($s->expenseamount);

                                $netamount = floatval($s->salesamount) - floatval($s->expenseamount);
                                $totalnet += floatval($netamount);


                            @endphp

                            <td>{{$s->storename}}</td>
                            <td>{{$s->doctype}}</td>
                            <td>{{$s->docdate}}</td>
                            <td>{{$s->remarks}}</td>
                            <td>{{number_format($s->salesamount, 2)}}</td>
                            <td class="{{$classexpense}}">{{number_format($s->expenseamount, 2)}}</td>
                            <td >{{number_format($netamount, 2)}}</td>


               

                        </tr>

                        <tr>
                            
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($totalsales, 2) }}</th>
                            <th>{{ number_format($totalexpense, 2) }}</th>
                            <th>{{ number_format($totalnet, 2) }}</th>
                        </tr>


                     
                    @endforeach


                </tbody>


            </table><!--END table-responsive-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


    
@include('reports.footer-rundate')

