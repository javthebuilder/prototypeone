<!-- sample modal content -->
<div id="showPaymentsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myShowPaymentsModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="myShowPaymentsModal"> Payment Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">

                <div class="alert alert-danger" ng-show="vm.payment_title == 'delete' " >
                    <b>Notice: DELETE ACTION IS IRREVERSIBLE </b> <br>
                </div>

                <span>
                    <b> Payername: @{{vm.salesmstr.payername}}
                    <br>
                </span>

                @php

                    $iswithdelete = 0; //sub_menu is global to all master layouts
                    foreach($sub_menu as $spm){
                        //1307 = Delete payments
                        if( $spm->pk_permalink == 1307 ){
                            $iswithdelete = 1;
                        }
                    }//END foreach

                @endphp

               


                <table class="table table-sm">
                    <thead class="text-primary">
                        
                        @if( $iswithdelete )
                            <th width="10px;" ng-show="vm.payment_title == 'delete' " ></th>
                        @endif
                        
                        <th width="40px;" >Code</th>
                        <th width="40px;" >Date</th>
                        <th width="40px;" >mode</th>
                        <th width="40px;" >Amount</th>
                    </thead>
                </table>

                <div class="text-center" id="loadingdeletepayments" hidden >
                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>

                <!--BEGIN div module well well-small well-shadow -->
                <div  class="" style="overflow-y:scroll; display:block;height:200px" >

                   

                    <div id="divtblpayments" >
                       
                        <table class="table table-striped">
                            <thead class="text-primary">
                               
                            </thead>
                            <tbody>
                                <tr ng-repeat="list in vm.payments">

                                    @if( $iswithdelete )
                                        <td ng-show="vm.payment_title == 'delete' " >
                                            <span class="text-danger" style="cursor: pointer;" ng-click="vm.SubmitDeletePayments(list)">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </span>
                                        </td>

                                    @endif

                                    
                                    <td>@{{list.pk_salespayments}}</td>
                                    <td>@{{list.docdate}}</td>
                                    <td>
                                        @{{list.mop}}
                                        <span ng-show="list.mop == 'cheque'" class="text-success">
                                            <br>
                                            <i>cheque no.: @{{list.chequeno}}</i>
                                        </span>

                                        <span ng-show="list.mop == 'credit'" class="text-success">
                                            <br>
                                            <i>
                                                card no.: @{{list.cardno}} <br>
                                                card holder: @{{list.cardholder}} <br>
                                                month: @{{list.cardmonth}} year: @{{list.cardyear}} <br>
                                                codecv: @{{list.cardcodecv}} 

                                            </i>
                                        </span>

                                    </td>
                                    <td>@{{list.amount | number: 2}}</td>
                                   
                                </tr>


                                
                            </tbody>

                        </table>

                     


                    </div><!--END vm.isvisibility-->

                </div><!--END overflow-y:scroll; display:block;height:200px -->

                <span class="">
                    <br>
                    Payables:
                    <b> @{{ vm.salesmstr.netamount | number:2 }} </b>
                    <br>
                    Paid Amount:
                    <b> @{{ vm.salesmstr.totalpayment | number:2 }} </b>
                    <br>
                    Balance:
                    <b> @{{ vm.salesmstr.balanceamount | number:2 }} </b>
                </span>
               

            </div><!--END modal-body-->

            <div class="modal-footer">
          
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="ajaxmodalcancelshowpaymentsmodal" >Close</button>


            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


