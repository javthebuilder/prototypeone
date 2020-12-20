<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Carbon\Carbon; //laravel date time

use Validator;
use PDO;

use App\DynamicForm;
use App\User;
use App\Store;
use App\Category;
use App\ProductsDtlView;
use App\Company;
use App\SalesMstr;
use App\SalesDtl;
use App\SalesPayment;
use App\SalesMstrView;
use App\SalesDtlView;

use App\ProductsComposition;
use App\SalesCompostion;

class POSController extends Controller
{

    // Read Me!
    // once sales is created, the default tax rate can't be changed
    // if you need to change the default tax rate one must delete the old sales mstr then create a new one
    public $pk_company = 1000; //default company


    //default selected sidebar
    public $active_parent = 'POS';

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }


    //return update salesmstr & salesdtl
    public function RecomputeSalesMstr($pk_salesmstr){

            $salesdtl = SalesDtlView::where('fk_salesmstr', '=', $pk_salesmstr)->orderBy('name', 'ASC')->get();

            //recompute $salesmstr

            $totalitem = count($salesdtl);
            $totalqty = 0;
            $totalamount = 0;
            $totaldisc = 0;
            $totalvatable = 0;
            $totalvatexcempt=  0;
            $totalzerorated = 0;
            $totalvatamount = 0;
            $totalnetamount = 0;
            $fk_updatedby = Auth::id();

            foreach($salesdtl as $key => $e){

                $totalqty += floatval($e['qty']);
                $totalamount += floatval($e['totalamount']);
                $totaldisc += floatval($e['discamount']);
                $totalvatable += floatval($e['vatable']);
                $totalvatamount += floatval($e['vatamount']);
                $totalnetamount += floatval($e['netamount']);

            };//END foreach

            //update $salesmstr
            SalesMstr::where('pk_salesmstr', '=', $pk_salesmstr)
            ->update([
                'totalitem' => $totalitem,
                'totalqty'  => $totalqty,
                'totalamount'=> $totalamount,
                'totaldisc' => $totaldisc,
                'vatable' => $totalvatable,
                'vatexcempt' => $totalvatexcempt,
                'zerorated' => $totalzerorated,
                'vatamount' => $totalvatamount,
                'netamount' => $totalnetamount,
                'fk_updatedby'=> $fk_updatedby,
            ]);

            $salesmstr = SalesMstrView::where('pk_salesmstr', '=', $pk_salesmstr)->get();

            $salesdtl = SalesDtlView::where('fk_salesmstr', '=', $pk_salesmstr)->orderBy('name', 'ASC')->get();

            return [ 'salesmstr'=> $salesmstr, 'salesdtl' => $salesdtl];


    }//RecomputeSalesMstr


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //highlight sidebar
        $this->setActiveParent();

        //check if user selected a store
        //@HomeController.php / selectStore()
        if( !session('session_store') ){
            return redirect('/home');
        }


        $session_store = session('session_store');

        //retrieve open transaction of the store
        $transactionlist = SalesMstrView::where('fk_stores', '=', $session_store)->where('iscancel', 0)->where('stat', '=', 1)->get();
        $categories = Category::where('type', '=', 'products')->where('stat', 1)->pluck('description');
        $company = Company::findOrFail($this->pk_company)->first();
        $stores = Store::findOrFail($session_store);
        //dd($categories);
        //dd($company);

        //dd($stores);
        return view('pos.index', compact('categories', 'company', 'stores', 'transactionlist'));


    }//END index



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }//END create




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->all();

        //check if user selected a store
        //@HomeController.php / selectStore()
        if( !session('session_store') ){
            return 'no selected store';
        }

        //begin transaction
        $transaction = DB::transaction(function() use($request) {

            $session_store = session('session_store');

            $companyvat = ( $request->companyvat ) ?  $request->companyvat : 12;

            $salesmstr = SalesMstr::create(
                [
                    'fk_stores'=> $session_store,
                    'docdate'=> date('Y-m-d'),
                    'doctype'=> 'sales',
                    'payername'=> '*Walk-in Customer*',
                    'companyvat'=> $companyvat,
                    'fk_createdby'=> Auth::id(),
                    'stat'=> 1
                ]
            );

            $salesmstr->update(
                [ 
                    'docno'=> str_pad($salesmstr->pk_salesmstr, '11', '0', STR_PAD_LEFT)  
                ]
            );

            //retrieve transaction
            $salesmstr = SalesMstrView::where('fk_stores', '=', $session_store)
                        ->where('pk_salesmstr', '=', $salesmstr->pk_salesmstr)
                        ->where('iscancel', '=', '0')
                        ->where('stat', '=', 1)->first();


            return $salesmstr;


        });//END transaction

        return $transaction;

    }//END store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        //$id = -1;
        if( request()->ajax() ){

            $type = (request()->type) ? request()->type : null;


            $salesmstr = SalesMstrView::query();

            //display only active or open sales
            if( $type == 1){
                $salesmstr->where('stat', '=', 1);
            }

            //salesmstrview
            $salesmstr = $salesmstr->where('pk_salesmstr', '=', $id)->get();

            $salesdtl = SalesDtlView::where('fk_salesmstr', '=', $id)->orderBy('name', 'ASC')->get();

            $stores = [];

            if( count($salesmstr)>0 ){
                $stores = Store::where('pk_stores', '=', $salesmstr[0]->fk_stores)->first();
            }

            //$salesmstr = [];

            return ['salesmstr'=> $salesmstr, 'salesdtl'=> $salesdtl, 'stores'=> $stores];

        }

        return redirect('/pos');

    }//END show



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //$id = -1;
        //update only open sales
        $salesmstr = SalesMstr::where('pk_salesmstr', '=', $id)->where('stat', '=', 1)->first();

        //return $salesmstr;

        if($salesmstr){

            //begin transaction
            $transaction = DB::transaction(function() use($salesmstr, $request, $id) {

                $fk_updatedby = Auth::id();

                $iscustomer = ($request->iscustomer) ? $request->iscustomer : null;

                if($iscustomer){

                    $salesmstr->update([
                        'fk_persons'=> ( $request->fk_persons != -1 ) ? $request->fk_persons : null,
                        'payername'=> $request->payername,
                        'fk_updatedby'=> $fk_updatedby
                    ]);

                    $salesmstr = SalesMstrView::where('pk_salesmstr', '=', $id)->get();

                    return $salesmstr;

                }//END $iscustomer


                //update discount
                $isdiscount = ($request->isdiscount) ? $request->isdiscount : null;

                if($isdiscount){

                    //update salesmstr for new discount scheme
                    $salesmstr->update([
                        'fk_discounts'=> ( $request->fk_discounts != -1 ) ? $request->fk_discounts : null,
                        'discrate'=> $request->discrate,
                        'fk_updatedby'=> $fk_updatedby
                    ]);

                   
                    //retrieve salesdtl then recompute new discount scheme
                    $salesdtl = SalesDtl::where('fk_salesmstr', '=', $id)->get();

                    foreach($salesdtl as $key => $e){

                        //recompute amount
                        $discountamount = floatval($e->totalamount) * ( floatval($salesmstr->discrate) / 100 );

                        $netamount = floatval($e->totalamount) - floatval($discountamount);

                        //sales tax base on net amount
                        $vatpercentage = 1 + ( floatval($salesmstr->companyvat) / 100 );
                        //without vat
                        $vatable = floatval($netamount) / floatval($vatpercentage);
                        //compute vat
                        $vatamount = floatval($netamount) - floatval($vatable);

                        //update salesdtl

                        SalesDtl::where('fk_salesmstr', '=', $id)->where('fk_products', '=', $e->fk_products)->update([

                            'discrate'=> $salesmstr->discrate,
                            'discamount'=> $discountamount,
                            'netamount'=> $netamount,
                            'vatable'=> $vatable,
                            'vatamount'=> $vatamount

                        ]);



                    };//END foreach



                    //$id = pk_salesmstr
                    return $this->RecomputeSalesMstr($id);

                        

                }//END $isdiscount

                

            });//END transaction

            return $transaction;

        }   
        else{
            
            return 'no transaction';
 
        }



    }//END update


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //$id = -1;
        $salesmstr = SalesMstr::findOrFail($id);

        if($salesmstr){

            //begin transaction
            $transaction = DB::transaction(function() use($salesmstr, $id) {

                //delete salesdtl
                //SalesDtl::where('fk_salesmstr', '=', $id)->delete();

                //$salesmstr->delete(); //delete model

                $salesmstr->update([
                    'iscancel'=> 1,
                    'cancel_at'=> Carbon::now(),
                    'fk_cancelby'=> Auth::id()
                ]);

                session()->flash('success', "sales no. $salesmstr->docno is now cancelled!");
                return 'success';

            });//END transaction

            return $transaction;

        }   
        else{
            
            return 'no transaction';
 
        }


    }//END destroy





    public function searchitems(){


        //check if user selected a store
        //@HomeController.php / selectStore()
        if( !session('session_store') ){
            return 'no selected store';
        }

        if( request()->ajax() ){

            $products = ProductsDtlView::query();

            $session_store = session('session_store');

            $search = ( request()->search ) ? request()->search : null;
            $type = ( request()->type ) ? request()->type : null; //search for barcode

            $category = ( request()->category ) ? request()->category : null; //search by category

            $load = ( request()->load ) ? request()->load : null; //onload dependencies


            if($load == 'onload'){
                


            }//END onload

            //search by description etc
            if($search){

                $products->where(function($query){
                    $query->where('name', 'like', '%'.request()->search.'%')
                        ->orWhere('barcode', '=', request()->search )
                        ->orWhere('pk_products', '=', request()->search );
                });

            }

            //search by barcode
            if($type == 'barcode'){
                $products->where('barcode', '=', $search);
            }

            //search by category
            if($category){
                $products->where('category', '=', $category);
            }

            //filter by selected store
            $products->where('fk_stores', '=', $session_store)
                    ->where('fk_storesvisibility', '=', $session_store )
                    ->where('stat', '=', 1);
          
            $products = $products->orderBy('name', 'ASC')->paginate(30);
            
            return ['products'=> $products];
           
        }//END ajax()

       
       return redirect('/pos');

      
    }//END searchitems


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function removeitems(Request $request, $id)
    {
        //
        //$id = -1;
        if( request()->ajax() ){

            //remove items only to open transaction
            $salesmstr = SalesMstr::where('pk_salesmstr', '=', $id)->where('stat', '=', 1)->first();

            //return $salesmstr;

            if( !$salesmstr ){

                return 'no transaction';

            }

            //start transaction
            $transaction = DB::transaction(function() use($salesmstr, $request, $id) {


                //delete salesdtl
                $salesdtl = SalesDtl::where('fk_salesmstr', '=', $id)->where('fk_products', '=', $request->fk_products)->delete();

                //remove old salescompositions
                SalesCompostion::where('fk_products', $request->fk_products)->where('fk_salesmstr', $id)->delete();


                //$id = pk_salesmstr
                return $this->RecomputeSalesMstr($id); //@top page


            });//END transaction

            return $transaction;
           



        }//END ajax()

      
    }//END removeitems



    //
    public function additems(Request $request, $id){

        //$id = -1;
        //check if user selected a store
        //@HomeController.php / selectStore()
        if( !session('session_store') ){
            return 'no selected store';
        }

        if( request()->ajax() ){

            //add items only to open transaction
            $salesmstr = SalesMstr::where('pk_salesmstr', '=', $id)->where('stat', '=', 1)->first();

            //return $salesmstr;

            if(!$salesmstr){

                return 'no transaction';

            }

            //return $request->all();

            $session_store = session('session_store');
            $pk_products = $request->pk_products;
            //$pk_products = -1;

            //retrieve correct product base on the selected store and stat
            $products = ProductsDtlView::where('fk_stores', '=', $session_store)
                    ->where('fk_storesvisibility', '=', $session_store )
                    ->where('pk_products', '=', $pk_products)
                    ->where('stat', '=', 1)->first();


            if( !$products ){

                return 'item not found';

            }

            //start transaction
            $transaction = DB::transaction(function() use($products, $salesmstr, $request, $session_store, $id) {

                $companyvat = $salesmstr->companyvat;

                $taxtype = $products->tax; //inc = exc

                //input  = adjustment of qty = keyboard, additional qty = click
                $input = ($request->input) ? $request->input : null;

                if( $input == 'click' ){

                    //supposedly 1 qty per click
                    $qty = 1;
                    //check for inventory and out of stock items
                    if( $products->type == 'inventory' && ( $products->qty < $qty  ) ){

                        return 'out of stock';

                    }

                    //retrieve ang ge charged na qty to be incremented
                    $chargedqty = SalesDtl::where('fk_salesmstr', '=', $id)->where('fk_products', '=', $products->pk_products)->pluck('qty')->first();

                    $qty = ($chargedqty) ? $qty + $chargedqty : $qty;

                }else{

                    //input = keyboard
                    //qty adjustment from input keyboard
                    $qty = ($request->qty) ? $request->qty : 1;

                    //retrieve ang ge charged na qty para e add sa running balance
                    //after ma compute ang running balance then e check na ang ge input na qty > runningbalance
                    $chargedqty = SalesDtl::where('fk_salesmstr', '=', $id)->where('fk_products', '=', $products->pk_products)->pluck('qty')->first();

                    $runningbalance = $products->qty + $chargedqty;

                    //check for inventory and out of stock items
                    if( $products->type == 'inventory' && ( $qty > $runningbalance ) ){

                        return 'out of stock';

                    }


                }//END click

                //return $qty . ' '. $products->qty;

                //return $qty;
            
                //retrieve item compositions
                $compositions = ProductsComposition::getItemCompositions($products->pk_products);

                //return $compositions;

                foreach($compositions as $key=> $v){

                    $prod = ProductsDtlView::where('fk_stores', '=', $session_store)
                        ->where('fk_storesvisibility', '=', $session_store )
                        ->where('pk_products', '=', $v->fk_compositions)
                        ->where('stat', '=', 1)->first();

                    //retrieve ang ge charged na qty sa sales composition
                    $chargedqty = SalesCompostion::where('fk_salesmstr', '=', $id)->where('fk_compositions', '=', $v->fk_compositions)->pluck('qty')->first();
                    $chargedqty = ($chargedqty) ? $chargedqty : 0;
              
                    //revert running balance
                    /*if( $prod->type == 'inventory' && ( ($prod->qty + $chargedqty) < ( $qty * $v->qty)  ) ){

                        return 'out of stock';

                    }*/
                    
                    //revert running balance
                    if( !$prod || ( $prod->type == 'inventory' && ( ($prod->qty + $chargedqty) < ( $qty * $v->qty) ) ) ){

                        return 'out of stock';

                    }
   
                }
  
                //note: compute tax base on net amount

                //vat exclusive
                //unitprice = unitprice + vatabale
                if($taxtype == 'exc'){

                    //compute addonvat to add to selling price
                    $addonvat = floatval($products->price) * ( floatval($companyvat) / 100 );

                    //unitprice = unitpice + vatamount
                    $unitprice = floatval($products->price) + floatval($addonvat);

                    //with individual discount
                    //unitprice = unitprice - unitdiscount
                    $unitdiscount =  floatval($unitprice) * ( floatval($products->discount) / 100 );
                    $unitprice = floatval($unitprice) - floatval($unitdiscount);

                    //partial amount
                    $totalamount = $unitprice * $qty;//

                    $discountamount = floatval($totalamount) * ( floatval($salesmstr->discrate) / 100 );

                    $netamount = floatval($totalamount) - floatval($discountamount);

                   

                }else{

                    //vat inclusive. unit price already have vat amount

                    //with individual discount
                    //unitprice = unitprice - unitdiscount
                    $unitdiscount =  floatval($products->price) * ( floatval($products->discount) / 100 );
                    $unitprice = floatval($products->price) - floatval($unitdiscount);

                    $totalamount = $unitprice * $qty;//

                    $discountamount = floatval($totalamount) * ( floatval($salesmstr->discrate) / 100 );

                    $netamount = floatval($totalamount) - floatval($discountamount);



                }//END vat

                //sales tax base on net amount
                $vatpercentage = 1 + ( floatval($companyvat) / 100 );
                //without vat
                $vatable = floatval($netamount) / floatval($vatpercentage);
                //return $vatable;
                //compute vat
                $vatamount = floatval($netamount) - floatval($vatable);

                //return $vatable;
                //return [ $totalamount, $vatable, $vatamount, $discountamount, $netamount ];

                //vat excempt computation here....

                //delete existing records
                SalesDtl::where('fk_salesmstr', '=', $id)->where('fk_products', '=', $products->pk_products)->delete();

                //update details
                SalesDtl::create([

                    'fk_salesmstr'=> $id,
                    'fk_products'=> $products->pk_products,
                    'qty'=> $qty,
                    'uom'=> $products->uom,
                    'unitprice'=> $unitprice,
                    'unitcost'=> $products->cost,
                    'totalamount'=> $totalamount,
                    'discrate'=> $salesmstr->discrate,
                    'discamount'=> $discountamount,
                    'netamount'=> $netamount,
                    'vatable'=> $vatable,
                    'vatamount'=> $vatamount,

                ]);

                //remove old salescompositions
                SalesCompostion::where('fk_products', $products->pk_products)->where('fk_salesmstr', $id)->delete();

                //retrieved @the top of this page  
                foreach($compositions as $ckey => $cv){

                    SalesCompostion::create([

                        'fk_salesmstr'=> $id,
                        'fk_products'=> $products->pk_products,
                        'fk_compositions'=> $cv->fk_compositions,
                        'qty'=>  floatval($qty) * floatval($cv->qty),
                        'uom'=> $cv->uom,
                        'unitcost'=> $cv->cost

                    ]);

                }



                //$id = pk_salesmstr
                return $this->RecomputeSalesMstr($id);

                

            });//END transaction

            return $transaction;

           
        }//END ajax()

       
       return redirect('/pos');

      
    }//END additems




    public function addpayments(Request $request, $id){
        
        //$id = -1;
        if( request()->ajax() ){

            //return $request->all();
          
            //start transaction
            $transaction = DB::transaction(function() use($request, $id) {

                //insert to payments
                $salespayments = SalesPayment::create([
                    'fk_salesmstr'=> $id,
                    'docdate'=> date('Y-m-d'),
                    'mop'=> $request->mop,
                    'amount'=> $request->paymentamount,
                    'cardno'=> $request->cardno,
                    'cardholder'=> $request->cardholder,
                    'cardmonth'=> $request->cardmonth,
                    'cardyear'=> $request->cardyear,
                    'cardcodecv'=> $request->cardcodecv,
                    'chequeno'=> $request->chequeno,
                    'payername'=> $request->payername,
                    'remarks'=> $request->remarks,
                    'fk_createdby'=> Auth::id(),
                ]);

                //update docno for proper formatting
                $salespayments->update(
                    [ 
                        'docno'=> str_pad($salespayments->pk_salespayments, '11', '0', STR_PAD_LEFT)  
                    ]
                );


                //total payments
                $totalpayment = DB::select("SELECT coalesce(sum(amount),0) as totalpayment FROM salespayments WHERE fk_salesmstr = '$id' ");

                //retrieve salesmstr to be updated
                $salesmstr = SalesMstr::findOrFail($id);

                $docno = $salesmstr->pk_salesmstr;

                $totalpayment = $totalpayment[0]->totalpayment;

                $changeamount  = floatval($salesmstr->netamount) - floatval($totalpayment);

                //if already paid then close transaction
                $stat = ( floatval($totalpayment) >= floatval($salesmstr->netamount) ) ? 0 : 1;

                //update salesmstr
                $salesmstr->update([
                    'payername'=> $request->payername,
                    'totalpayment'=> $totalpayment,
                    'changeamount'=> $changeamount,
                    'stat'=> $stat
                ]);


                //return for printing of receipt
                $salesmstr = SalesMstrView::where('pk_salesmstr', '=', $id)->get();

                $salesdtl = SalesDtlView::where('fk_salesmstr', '=', $id)->orderBy('name', 'ASC')->get();


                //applicable @index page
                //mo refresh man ang page
                $paymentamount = $request->paymentamount;
                session()->flash('success', "payments of sales no. $docno has been updated!\n  amount: $paymentamount ");

                return [ 'salesmstr'=> $salesmstr, 'salesdtl' => $salesdtl];


            });//END transaction

            return $transaction;


        }


    }//END addpayments




}//END class




    //check for discount schemes exception
    //for consideration
    //1 = senior, 2 = pwd
    /*if( $salesmstr->fk_discounts == 1 || $salesmstr->fk_discounts == 2 ){

        //exempted from paying value-added tax
        //without vat
        $unitprice = $vatable;
        $discountamount = floatval($unitprice) * ( floatval($salesmstr->discrate) / 100 );
        $totalamount = floatval($unitprice) - floatval($discountamount);

        //vat excempt
        $vatable = 0; $vatamount = 0;
    

    }else{

        //
        $discountamount = floatval($unitprice) * ( floatval($salesmstr->discrate) / 100 );
        $totalamount = floatval($unitprice) - floatval($discountamount);

    }//END discounts*/
