<div id="receiptModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myReceiptModal" aria-hidden="true" style="display: none;" >

    <div class="modal-dialog modal-sm  modal-dialog-scrollable">

        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="myReceiptModal">Receipt Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">

       
                <!--BEGIN div module well well-small well-shadow -->
                <div class="col-md-6" id="printarea" style="font-size:10px;width: 170px;">


                    {{--<img src="{{asset('/storage/'.$company['pictx'])}}" style="width: 80px; height: 80px;" >--}}

                   <p class="text-center" id="onloadReceiptHeader">
                        {{ isset($stores->name) ? $stores->name : ''  }}<br> 
                        VATREGTIN #{{ isset($stores->tinno) ? $stores->tinno : '' }} <br>
                        {{ isset($stores->address) ? $stores->address : '' }} <br>
                        Tel #: {{ isset($stores->phone) ? $stores->phone : '' }} <br>
                        @{{ vm.lastsalesmstr.created_at | date:'medium'   }}
                   </p>

                    <p class="text-center" id="specificReceiptHeader" hidden>
                        @{{ vm.stores.name }} <br>
                        VATREGTIN # @{{ vm.stores.tinno }} <br>
                        @{{ vm.stores.address }} <br>
                        Tel #: @{{ vm.stores.phone }} <br>
                        @{{ vm.lastsalesmstr.created_at | date:'medium'   }}
                    </p>

                   <p>
                       RCPT#: @{{vm.lastsalesmstr.docno}} <br>
                       STORE#: {{ isset($stores->pk_stores) ? $stores->pk_stores : '' }} <br>
                       STAFF: @{{vm.lastsalesmstr.cashiername}}
                   </p>
                   
                    <table style="font-size:;width: 170px;">
                        <thead>
                            <th width="50px">Description</th>
                            <th width="10px">Amount</th>
                        </thead>
                        <tbody>
                          
                            <tr ng-repeat="list in vm.lastsalesdtl">
                                <td width="50px;">
                                    @{{list.name}} 
                                    <span ng-if="list.qty > 1" >
                                        <br> @{{list.qty + ' ' + list.uom + '@' + list.unitprice }} 
                                    </span>
                                </td>
                                <td width="10px;">
                                     @{{list.netamount | number:2 }} 
                                </td>
                            </tr>


                            <tr>
                                <td><b>Total Php<b></td>
                                <td>@{{vm.lastsalesmstr.netamount | number:2 }}</td>
                            </tr>

                            <tr>
                                <td><b>Cash</b></td>
                                <td>@{{vm.lastsalesmstr.totalpayment | number:2 }}</td>
                            </tr>

                            <tr>
                                <td><b>Change<b></td>
                                <td>( @{{ -1 * vm.lastsalesmstr.changeamount | number:2 }} )</td>
                            </tr>

                            <tr>
                                <td>No. of Items</td>
                                <td>@{{vm.lastsalesmstr.totalqty | number:2 }}</td>
                            </tr>

                            <tr>
                                <td>VATable</td>
                                <td>@{{vm.lastsalesmstr.vatable | number:2 }}</td>
                            </tr>

                            <tr>
                                <td>VAT_Tax</td>
                                <td>@{{vm.lastsalesmstr.vatamount | number:2 }}</td>
                            </tr>

                            <tr>
                                <td>Zero Rated</td>
                                <td>@{{vm.lastsalesmstr.zerorated | number:2 }}</td>
                            </tr>

                            <tr>
                                <td>Vat_Exempt</td>
                                <td>@{{vm.lastsalesmstr.vatexcempt | number:2 }}</td>
                            </tr>

                        </tbody>

                    </table>

                    <br>
                    <p>
                       Sold To: @{{vm.lastsalesmstr.payername}} <br>
                       Address: @{{vm.lastsalesmstr.address}}
                    </p> 

             
                    <p class="text-center" id="onloadReceiptFooter">
                        {{ isset( $stores->receiptfooter ) ? $stores->receiptfooter : '' }}
                    </p>

                    <p class="text-center" id="specificReceiptFooter" hidden>
                        <div ng-bind-html="vm.stores.receiptfooter"></div>
                    </p>
                       

                </div><!--END overflow-y:scroll-->

            

            </div><!--END modal-body-->

            <div class="modal-footer"  >


                <button type="button" class="btn btn-info btn-simple" id="ajaxmodalprintreceipt" >
                
                    <i class="fa fa-print" aria-hidden="true"></i>
                    &nbsp;Print

                </button>
      
                
            </div><!--END modal-footer-->

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
