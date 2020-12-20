<div class="responsive-table-plugin">

    <div class="table-rep-plugin">

        <div class="table-responsive" data-pattern="priority-columns">

            <table id="printtable" class="table table-sm table-striped mb-0">
                

                <thead>

                    <tr>
                        <th>Store</th>
                        <th>Product Code</th>
                        <th>Product Description</th>
                        <th>Category</th>
                        <th data-priority="1">Supplier</th>
                        <th data-priority="2">Critical Level</th>
                        <th data-priority="3">Stock On Hand</th>
                    </tr>
                   
                </thead>

                <tbody>

                    @foreach($results as $s)

                        <tr>
                            
                        
                            
                            <td>{{$s->storename}}</td>
                            <td>{{ str_pad($s->pk_products, '5', '0', STR_PAD_LEFT) }}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->category}}</td>
                            <td>{{$s->supplier}}</td>
                            <td>{{ number_format($s->alertqty, 2)  }}</td>
                            <td class="text-danger">{{ number_format($s->qty, 2) }}</td>


               

                        </tr>


                     
                    @endforeach


                </tbody>


            </table><!--END table-responsive-->

        </div><!--END table-responsive-->

    </div><!--END table-rep-plugin-->

</div><!--END responsive-table-plugin-->


    
@include('reports.footer-rundate')

