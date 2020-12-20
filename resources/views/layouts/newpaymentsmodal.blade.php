<!-- sample modal content -->
<div id="newPaymentsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myNewPaymentsModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="myNewPaymentsModal"> Payment Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

           
            <div class="modal-body">


                <!--BEGIN div module well well-small well-shadow -->
                <div class="" >

                    <div class="form-group row">

                        <label class="col-sm-4  col-form-label" for="payerName">
                            Payername

                            <span class="text-danger">*</span>
                          
                        </label>
                        
                        <div class="col-sm-8">

                            <input type="text"
                            ng-model="vm.payername" 
                            class="form-control" 
                            style="width:;" 
                            ng-disabled="vm.balanceamount <= 0"
                            />

                        </div><!--END col-sm-10-->

                    </div><!--END form-group row-->


                    <div class="form-group row">

                        <label class="col-sm-4  col-form-label" for="modePayment">
                            Mode of Payment

                            <span class="text-danger">*</span>
                          
                        </label>
                        
                        <div class="col-sm-8">

                            <select class="form-control" id="mop" style="cursor: pointer;" ng-model="vm.mop"  ng-disabled="vm.balanceamount <= 0" >

                                <option value="cash">Cash</option>
                                <option value="credit">Credit Card</option>
                                <option value="cheque">Cheque</option>

                            </select><!--form-control-->


                        </div><!--END col-sm-10-->

                    </div><!--END form-group row-->


                    <div id="iscreditcard" ng-show="vm.mop == 'credit'">


                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="cardNumber">
                                Credit Card Number (swipe)
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.cardno" 
                                    class="form-control" 
                                    style="width:;" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->


                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="cardHolder">
                                Credit Card Holder
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.cardholder" 
                                    class="form-control" 
                                    style="width:;" 
                                    placeholder="Credit Card Holder" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->

                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="exMonth">
                                Expiry Month
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.cardmonth" 
                                    class="form-control" 
                                    style="width:;" 
                                    placeholder="Month" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->

                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="exYear">
                                Expiry Year
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.cardyear" 
                                    class="form-control" 
                                    style="width:;" 
                                    placeholder="Year" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->

                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="cvv">
                                CVV
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.cardcodecv" 
                                    class="form-control" 
                                    style="width:;" 
                                    placeholder="Code CV" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->

                        
                    </div><!--END iscreditcard-->


                    <div id="ischeque" ng-show="vm.mop == 'cheque'">

                        <div class="form-group row">

                            <label class="col-sm-4  col-form-label" for="cvv">
                                Cheque Number
                            </label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text"
                                    ng-model="vm.chequeno" 
                                    class="form-control" 
                                    style="width:;" 
                                />

                            </div><!--END col-sm-10-->

                        </div><!--END form-group row-->

                        
                    </div><!--END iscreditcard-->


                    <!--div table-->
                    <div class="table-responsive" style="background: white;" >
                        <table class="table table-condensed">
                            <thead class="text-primary">
                               
                            </thead>
                            <tbody>

                                <tr>
                                    <th>Amount Due</th>
                                    <td class="text-right text-danger">
                                        <span style="font-size: 10px; ">Payables</span>
                                        @{{vm.netamount | number:2}} 
                                        <br>
                                        <u>
                                            <span style="font-size: 10px; ">Paid Amount </span>
                                            - ( @{{vm.paidamount | number:2}}  ) 
                                        </u>

                                        <br> 
                                        <span style="font-size: 10px; ">Balance</span>
                                        <b> @{{vm.balanceamount | number:2}} </b>
                                    </td> 
                                    
                                </tr>

                             

                                <tr>
                                    <th>Payment Amount</th>
                                    <td class="col-md-4">
                                        <span class="form-group">
                                            <input type="number" id="paymentamount"
                                                ng-model="vm.paymentamount" 
                                                class="form-control" 
                                                min="1"
                                                style="width:; text-align: right; color:red" 
                                                ng-change="vm.ValidateNumber(vm.paymentamount, 'payment')"
                                                ng-model-options="{debounce: 500}"
                                                ng-disabled="vm.balanceamount <= 0"
                                                string-to-number
                                            />
                                        </span> 
                                    </td>
                                </tr>

                                <tr>
                                    <th>Change Amount</th>
                                    <td class="text-right text-danger">
                                       <b> @{{vm.changeamount | number:2}} </b>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Remarks</th>
                                    <td class="col-md-4">
                                        <span class="form-group">
                                            <textarea
                                                ng-model="vm.remarks" 
                                                class="form-control" 
                                                rows="2"
                                                placeholder="enter remarks here..."
                                                ng-disabled="vm.balanceamount <= 0"
                                            ></textarea>
                                        </span> 
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div><!--END div table-->

                </div><!--END overflow-y:scroll-->

            

            </div><!--END modal-body-->


            <div class="modal-footer"  >

                <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>

                <span id="ajaxmodalfootersubmitdiv" >

                    <button type="button" class="btn btn-bordred-primary waves-effect  width-md waves-primary" id="ajaxmodalfootersubmit">
                        <span id="msgAjaxModalSubmit">
                          Save
                        </span>
                    </button>

                </span>

            </div><!--END modal-footer-->



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


