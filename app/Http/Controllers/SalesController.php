<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use Carbon\Carbon; //laravel date time

use App\SalesMstr;
use App\SalesDtl;
use App\SalesMstrView;
use App\SalesDtlView;
use App\SalesPayment;
use App\User;
use App\Category;
use App\Store;
use App\Company;

class SalesController extends Controller
{
    
    //default selected sidebar
    public $active_parent = 'Finance';

    public $menu_group = '/sales';

    public $pk_company = 1000; //default company


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( request()->ajax() ){
            return 'ajax';
        }

        $sessionID = Auth::id();
        $salesmstr = SalesMstrView::query();

        $search = ( request()->search ) ? request()->search : null;

        $dateFrom = ( request()->dateFrom ) ? request()->dateFrom : date('Y-m-d');
        $dateTo = ( request()->dateTo ) ? request()->dateTo : date('Y-m-d');

        $fk_stores = ( request()->fk_stores ) ? request()->fk_stores : 'All';
        $stores_arr =  DB::select("CALL usp_getAssignedStores($sessionID)");
        //set default store if no selected
        /*if($fk_stores == null ){
            $fk_stores = ( count($stores_arr) > 0 ) ? $stores_arr[0]->pk_stores : 'All';
        }*/
        //dd($stores_arr);

        if($search){

            $salesmstr->where(function($query){
                $query->where('docno', 'like', '%'.request()->search.'%')
                    ->orWhere('payername', 'like', '%'.request()->search.'%')
                    ->orWhere('paymentstat', 'like', '%'.request()->search.'%');
            });

        }//END $search


        if($fk_stores != 'All'){


            $salesmstr->where('fk_stores', '=', $fk_stores);


            $stores = Store::findOrFail($fk_stores); //select current selected store 


        }else{
            //display all
            $tempArr = []; $i=0;
            foreach ($stores_arr as $key => $v) {
                $tempArr[$i++] = $v->pk_stores;
            }
            //dd($tempArr);

            $salesmstr->whereIn('fk_stores', $tempArr );
            //dd($expense);

            $stores = [];

        }//END $fk_stores != 'All'

        //dd($fk_stores);

        //do not include empty transaction or netamount < 0
        $salesmstr->whereBetween('docDate', [$dateFrom, $dateTo] )->where('netamount', '>', 0);


        $salesmstr = $salesmstr->orderBy('pk_salesmstr', 'DESC')->paginate(20);

        //$salesmstr = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        //trivial to the receipt modals
        $company = Company::findOrFail($this->pk_company)->first();

        return view('sales.index', compact('salesmstr', 'search', 'dateFrom', 'dateTo', 'fk_stores', 'stores_arr', 'sub_menu', 'company', 'stores'));


    }//END index




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }//END edit
    

    //update only the status 
    //1 = open, 0 = close
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        //
        if(request()->ajax()){

            $salesmstr = SalesMstr::findOrFail($id);

            if($salesmstr){

                $docno = $salesmstr->docno;

                $stat = $request->stat;

                $statdesc = ( $stat == 1 ) ? 'open' : 'close';

                $salesmstr->update([
                    'stat'=> $stat,
                    'fk_updatedby'=> Auth::id()
                ]);

                session()->flash('success', "sales no. $docno is now $statdesc!");
                return 'success';

            }else{

                session()->flash('error', "Code $id is not found!");
                return 'error';
            }


        }//END ajax()




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

    }//END destroy



    public function showpayments(Request $request, $id){

        if( request()->ajax() ){

            $salesmstr = SalesMstrView::findOrFail($id);

            $payments = SalesPayment::where('fk_salesmstr', '=', $id)
                        ->where('iscancel', 0)
                        ->get();

            return ['salesmstr'=> $salesmstr, 'payments'=> $payments];
           
        }

    }//END $id





    public function deletepayments($id){

        if( request()->ajax() ){

            $payments = SalesPayment::findOrFail($id);

            if($payments){

                //begin transaction
                $transaction = DB::transaction(function() use($payments, $id) {
                    
                    //findOrFail salesmstr to update totalpayment and changeamount
                    $salesmstr = SalesMstr::findOrFail( $payments->fk_salesmstr);

                    $docno =  $salesmstr->pk_salesmstr;

                    //old totalpayment
                    $totalpayment = $salesmstr->totalpayment;

                    //old paymentamount
                    $paymentamount = $payments->amount;

                    $newtotalpayment = floatval($totalpayment) - floatval($paymentamount);

                    $changeamount = floatval($salesmstr->netamount) - floatval($newtotalpayment);

                    $payments->update([
                        'iscancel'=> 1,
                        'cancel_at'=> Carbon::now(),
                        'fk_cancelby'=> Auth::id()
                    ]);

                    //$payments->delete(); //delete model

                    //update salesmstr for totalpayments
                    $salesmstr->update([
                        'totalpayment'=> $newtotalpayment,
                        'changeamount'=> $changeamount
                    ]);

                    session()->flash('success', "payments of sales no. $docno has been deleted!\n  amount: $paymentamount ");
                    return 'success';

                });//END transaction

                return $transaction;

                
            }   
            else{
                session()->flash('error', "Code $id is not found!");
                return 'error';
     
            }
                        
        }

    }//END $id




}//END class
