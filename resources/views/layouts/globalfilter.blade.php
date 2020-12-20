@php

    $filtercontent = ""; //begin row

    foreach ($filters as $key => $v) {

        switch ($v) {

            //dateFrom dateTo
            case 1:

            	//responses from the controller
			    $dateFrom = (isset($dateFrom)) ? $dateFrom : date('Y-m-d');
			    $dateTo = (isset($dateTo)) ? $dateTo : date('Y-m-d');

                $filtercontent .= "<div class='row'>
                    <div class='col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Date from</label>
                            <input id='dateFrom' name='dateFrom' class='form-control span8' type='date' value='$dateFrom' >
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label class='control-label'>Date to</label>
                            <input id='dateTo' name='dateTo' class='form-control span8' type='date' value='$dateTo' >
                        </div>
                    </div>


                </div>";
             
            break;


            //fk_stores
            case 2:

            	$fk_stores = (isset($fk_stores)) ? $fk_stores : null;
			    $stores_arr = (isset($stores_arr)) ? $stores_arr : [];
			    $stores_str = '';
			    $stores_desc = '';
			    foreach($stores_arr as $key => $v){
			        $vID = $v->pk_stores;
			        $selected = ( $v->pk_stores == $fk_stores ) ? 'selected' : '';
			        $stores_desc = ( $v->pk_stores == $fk_stores ) ? $v->name : '';
			        $stores_str .= "<option value='$vID' $selected > $v->name  </option>";
			    }//END foreach

                $filtercontent .= "<div class='row'>
                   <div class='col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Stores</label>
                            <select id='fk_stores' name='fk_stores' type='select' class='form-control'
                                value='$fk_stores' >
                                <option value='All'  > All </option>
                                $stores_str
                            </select>

                        </div>
                    </div>

                </div>";

            break;


            //fk_products
            case 3:

            	$fk_products = (isset($fk_products)) ? $fk_products : null;
    			$productdesc = (isset($productdesc)) ? $productdesc : null;

                $filtercontent .= "<div class='row'>
                   <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Products</label>
                            <select id='fk_products' name='fk_products' type='select' class='form-control'
                                value='$fk_products' >

                                <option value='$fk_products'> $productdesc </option>

                            </select>

                        </div>
                    </div>

                </div>";

            break;


            //fk_users
            case 4:

			    $fk_users = (isset($fk_users)) ? $fk_users : null;
			    $fullname = (isset($fullname)) ? $fullname : null;

                $filtercontent .= "<div class='row'>
                   <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>User / Cashier</label>
                            <select id='fk_users' name='fk_users' type='select' class='form-control'
                                value='$fk_users' >

                                <option value='$fk_users'> $fullname </option>

                            </select>

                        </div>
                    </div>

                </div>";

            break;


            //fk_categories
            case 5:

                $fk_categories = (isset($fk_categories)) ? $fk_categories : null;
                $categories_arr = (isset($categories_arr)) ? $categories_arr : [];
                $categories_str = '';
                $categories_desc = '';
                foreach($categories_arr as $key => $v){
                    $vID = $v->pk_categories;
                    $selected = ( $v->pk_categories == $fk_categories ) ? 'selected' : '';
                    $categories_desc = ( $v->pk_categories == $fk_categories ) ? $v->description : '';
                    $categories_str .= "<option value='$vID' $selected > $v->description  </option>";
                }//END foreach

                $filtercontent .= "<div class='row'>
                   <div class='col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Categories</label>
                            <select id='fk_categories' name='fk_categories' type='select' class='form-control'
                                value='$fk_categories' >
                                <option value='All'  > All </option>
                                $categories_str
                            </select>

                        </div>
                    </div>

                </div>";

            break;


            //personatype
            case 6:

                $persontype = (isset($persontype)) ? $persontype : null;

                $pselectedall = ( $persontype == 'All' ) ? 'selected' : '';
                $pselectecustomer = ( $persontype == 'customer' ) ? 'selected' : '';
                $pselectesupplier = ( $persontype == 'supplier' ) ? 'selected' : '';

                $filtercontent .= "<div class='row'>
                   <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Type</label>
                            <select id='persontype' name='persontype' type='select' class='form-control'
                                value='$persontype' >
                                <option value='All' $pselectedall > All </option>
                                <option value='customer' $pselectecustomer > Customer </option>
                                <option value='supplier' $pselectesupplier > Supplier </option>

                            </select>

                        </div>
                    </div>

                </div>";

            break;

            //producttype
            case 7:

                
                $producttype = (isset($producttype)) ? $producttype : null;

                $pselectedall = ( $producttype == 'All' ) ? 'selected' : '';
                $pselecteinvetory = ( $producttype == 'inventory' ) ? 'selected' : '';
                $pselecteservice = ( $producttype == 'service' ) ? 'selected' : '';

                $filtercontent .= "<div class='row'>
                   <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Type</label>
                            <select id='producttype' name='producttype' type='select' class='form-control'
                                value='$producttype' >
                                <option value='All' $pselectedall > All </option>
                                <option value='inventory' $pselecteinvetory > Inventory </option>
                                <option value='service' $pselecteservice > Service </option>

                            </select>

                        </div>
                    </div>

                </div>";

            break;


            //audit type
            case 8:

                $audittype = (isset($audittype)) ? $audittype : null;

                $pselectepricediscounts = ( $audittype == 'Price and Discounts' ) ? 'selected' : '';
                $pselecteqtyadj = ( $audittype == 'Qty Adjustment' ) ? 'selected' : '';

                $filtercontent .= "<div class='row'>
                   <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Audit Trail</label>
                            <select id='audittype' name='audittype' type='select' class='form-control'
                                value='$audittype' >
                                <option value='Price and Discounts' $pselectepricediscounts > Price and Discounts </option>
                                <option value='Qty Adjustment' $pselecteqtyadj > Qty Adjustment </option>

                            </select>

                        </div>
                    </div>

                </div>";

            break;

            //report type
            case 9:

                $reporttype = (isset($reporttype)) ? $reporttype : 'Summary';

                $pselectedsummary = ( $reporttype == 'Summary' ) ? 'selected' : '';
                $pselecteddetails = ( $reporttype == 'Details' ) ? 'selected' : '';

                $filtercontent .= "<div class='row'>
                <div class=' col-md-6'>
                        <div class='form-group '>
                            <label class='control-label'>Report Type</label>
                            <select id='reporttype' name='reporttype' type='select' class='form-control'
                                value='$reporttype' >
                                <option value='Summary' $pselectedsummary > Summary </option>
                                <option value='Details' $pselecteddetails > Details </option>

                            </select>

                        </div>
                    </div>

                </div>";

                break;

            //apply filter
            case 10:

                $filtercontent .= "
                    <div class='row col-md-12'>
                        <div class='form-group'>
                            <button type='button' class='btn btn-bordred-primary waves-effect  width-md' id='ApplyGlobalFilters'>
                                   Apply Filter
                            </button>
                        </div>
                    </div>
                ";

            break;
            
            default:
                # code...
            break;

        }//END switch


    }//END foreach




@endphp




<div id="accordion">
    
    <div class="card mb-0">
        
        <div class="card-header alert-info" id="headingOne">
            <h5 class="m-0">
                <a href="#collapseOne" class="text-dark float-left col-md-12" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                    Filter Preferences
                </a>
            </h5>
        </div>

        {{--show--}}
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
            <div class="card-body">
                {!! $filtercontent !!}
            </div>
        </div>
    </div>

</div>


	


