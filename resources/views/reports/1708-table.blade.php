<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                

                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Store</th>
                        <th>Product</th>
                        <th>Category</th>

                        @if( $audittype == 'Qty Adjustment' )
                            <th>Old Qty</th>
                            <th>Qty Adjusted</th>
                            <th>New Qty</th>
                            <th>Updated By</th>
                            <th>Remarks</th>
                        @else

                            <th>Price</th>
                            <th>Discount</th>
                            <th>Updated By</th>

                        @endif
                        
                        
                    </tr>


                </thead>

                <tbody>

                    @foreach($results as $key => $v)

                        <tr>
                            
                            <td>{{ date_format( date_create( $v->created_at ),'M d Y h:m a' )}}</td>
                            <td>{{$v->store}}</td>
                            <td>{{$v->productName}}</td>
                            <td>{{$v->category}}</td>

                            @if( $audittype == 'Qty Adjustment' )

                                <td>{{$v->oldqty}}</td>
                                <td>{{$v->qty}}</td>
                                <td>{{$v->newqty}}</td>
                                <td>{{$v->createdBy}}</td>
                                <td>{{$v->remarks}}</td>    
                                
                            @else

                                <td>{{$v->price}}</td>
                                <td>{{$v->discount}}</td>
                                <td>{{$v->createdBy}}</td>

                            @endif

                        </tr>

                        
                        
                    @endforeach


                </tbody>

    
            </table><!--END table-responsive-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


    
@include('reports.footer-rundate')

