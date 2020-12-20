<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\AppStorage;

use App\Expense;
use App\ExpenseMstrView;
use App\DynamicForm;
use App\User;
use App\Category;
use App\Store;


class ExpenseController extends Controller
{
    
    //default selected sidebar
    public $active_parent = 'Finance';

    public $menu_group = '/expense';

    public $categories = [];
    public $stores = [];


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }



    //setup our required requisite for the form
    public function setPrerequisites(){

        $sessionID = Auth::id();

        $this->categories = Category::where('type', '=', 'expense')
                    ->where('stat', 1)
                    ->orderBy('description', 'asc')->get();

        $this->stores = DB::select("CALL usp_getAssignedStores($sessionID)");
                    

    }//END setPrerequisites()



    /**
        - $form = 'store', 'update'
    */
    public function custom_validation($request, $form){
        
        //$extension = strtolower($request->attachment->getClientOriginalExtension());

        $common_rule = [
            'docdate'       =>  ['required','date'],
            'docno'         =>  ['required','max:255'],
            'fk_categories' =>  ['required'],
            'fk_stores'     =>  ['required'],
            'amount'        =>  ['required', 'numeric', 'min:1'],
            'remarks'       =>  ['required', 'max:255'],
            'attachment'    =>  ['mimes:jpg,jpeg,png,doc,docx,xls,xlsx,pdf,zip', 'max:2000' ], //2000kb or 2mb
       
        ];

        if( $form == 'store' ){
            //no unique keys

        }else if( $form == 'update' ){ 

            //no unique keys
        }

        //dd($common_rule);

        //checkboxes
        $request['stat'] = 1; //default
        //dd($request->all());

        //validate the form
        $validator = Validator::make( $request->all(), $common_rule, $this->messages() );

        if( $validator->fails() ){
            return $validator;
        }

        return true;
    }


    //custome validation error messages
    public function messages(){
        return [
            'docdate.required' => 'Document Date is required',
            'docdate.date' => 'Invalid Date format (yyyy-mm-dd)',
            'docno.required' => 'Reference No. is required',
            'fk_categories.required' => 'Expense category is required',
            'fk_stores.required' => 'Store is required',
            'amount.numeric'  => 'Amount must be numeric',
            'amount.min'  => 'Amount must be greater than or equals to 1',
            'remarks.required' => 'Remarks is required',
            'attachment.mimes' => 'Accepted Attachment file types must be (jpg|jpeg|png|pdf||doc|docx|xls|xlsx|zip)',
            'attachment.max'=> 'Attachment must be under 2Mb'
        ];
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
        $expense = ExpenseMstrView::query();

        $search = ( request()->search ) ? request()->search : null;

        $dateFrom = ( request()->dateFrom ) ? request()->dateFrom : date('Y-m-d');
        $dateTo = ( request()->dateTo ) ? request()->dateTo : date('Y-m-d');

        $fk_stores = ( request()->fk_stores ) ? request()->fk_stores : 'All';
        $stores_arr =  DB::select("CALL usp_getAssignedStores($sessionID)");
        //set default store if no selected
        /*if($fk_stores == null){
            $fk_stores = ( count($stores_arr) > 0 ) ? $stores_arr[0]->pk_stores : 'All';
        }*/
        //dd($stores_arr);
        
        $fk_categories = ( request()->fk_categories ) ? request()->fk_categories : 'All';
        $categories_arr =  Category::getActiveCategoriesByType('expense');
        //set default categories if no selected
        /*if($fk_categories == null){
            $fk_categories = ( count($categories_arr) > 0 ) ? $categories_arr[0]->pk_categories : 'All';
        }*/
        //dd($categories_arr);

        if($search){

            $expense->where(function($query){
                $query->where('docno', 'like', '%'.request()->search.'%')
                    //->orWhere('category', 'like', '%'.request()->search.'%')
                    ->orWhere('remarks', 'like', '%'.request()->search.'%');
            });

        }//END $search

        if($fk_stores != 'All'){

            $expense->where('fk_stores', '=', $fk_stores);

        }else{
            //display all
            /*$tempArr = []; $i=0;
            foreach ($stores_arr as $key => $v) {
                $tempArr[$i++] = $v->pk_stores;
            }
            //dd($tempArr);

            $expense->whereIn('fk_stores', $tempArr ); */
            //dd($expense);

        }//END $fk_stores != 'All'

        
        if($fk_categories != 'All'){

            $expense->where('fk_categories', '=', $fk_categories);

        }else{
          
        }//END $fk_categories != 'All'


        $expense->whereBetween('docDate', [$dateFrom, $dateTo] );


        $expense = $expense->orderBy('pk_expense', 'DESC')->paginate(20);

        //$expense = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        return view('expense.index', compact('expense', 'search', 'dateFrom', 'dateTo', 'fk_stores', 'stores_arr', 'fk_categories', 'categories_arr', 'sub_menu'));


    }//END index




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //default active sidebar
        $this->setActiveParent();

        //[] = current query object
        //null = current request
        $form_fields = DynamicForm::form_fields('create', [], null, Expense::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $stores = $this->stores;

        return view('expense.create', compact('form_fields', 'categories', 'stores'));


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
        $validator = $this->custom_validation($request, 'store');

        //highlight sidebar
        $this->setActiveParent();

        //dd($validator);

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                //create will return the newly created object
                $expense = Expense::create($request->all()); //insert all $request

                //dd($expense);

                //if request uploaded picture
                if( $request->attachment ){

                    //update DB for correct filename @pictx
                    $expense->update([
                        'attachment'=> AppStorage::store('expense', $request->attachment)
                    ]);

                }//END check if request has uploaded picture


                session()->flash('success', "new expense has been created!");
                //return redirect('/expense/create');
                return redirect()->back();

            });//END transaction

            return $transaction;
            
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Expense::form_fields() );
            $this->setPrerequisites();
            $categories = $this->categories;
            $stores = $this->stores;

            return view('expense.create', compact('form_fields', 'categories', 'stores'))->withErrors($validator);

        }

        //dd($request->all());

    }//END store





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $expense = Expense::findOrFail($id);

        //dd($expense);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $expense, null, Expense::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $stores = $this->stores;

        return view('expense.show', compact('form_fields', 'expense', 'categories', 'stores') );


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
        $expense = Expense::findOrFail($id);

        //dd($expense);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $expense, null, Expense::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $stores = $this->stores;

        return view('expense.edit', compact('form_fields', 'expense', 'categories', 'stores') );

    }//END edit



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
        $validator = $this->custom_validation($request, 'update');

        $expense = Expense::findOrFail($id);

        //highlight sidebar
        $this->setActiveParent();

        //dd($validator);

        //check if $validator is true && record is found
        if( $validator === true && $expense  ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $expense) {

                $request['fk_updatedby'] = Auth::id();

                //to be remove from storage
                $oldfilename = $expense->attachment; 

                //update expense object
                //NOTE: empty attachment will not be updated automatically
                $expense->update($request->all());

                //check if user removed the attachment
                if( $request->removeattachment && $request->removeattachment == 'on' ){
                                       
                    AppStorage::remove($oldfilename);

                    //update DB for correct filename @pictx
                    $expense->update([
                        'attachment'=> null
                    ]);

                }//END check if user removed the logo


                //if request uploaded attachment
                if( $request->attachment ){

                    AppStorage::remove($oldfilename);
                    
                    //update DB for correct filename @pictx
                    $expense->update([
                        'attachment'=> AppStorage::store('expense', $request->attachment)
                    ]);

                }//END check if request uploaded picture



                session()->flash('success', "expense has been updated!");
                //return redirect("/expense/edit/$expense->pk_expense");
                return redirect()->back();

            });//END transaction

            return $transaction;
            
        }
        else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $expense, null, Expense::form_fields() );

            $this->setPrerequisites();
            $categories = $this->categories;
            $stores = $this->stores;

            return view('expense.edit', compact('form_fields', 'expense', 'categories', 'stores'))->withErrors($validator);

        }

        //dd($request->all());

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
        $expense = Expense::findOrFail($id);

        //return $expense;

        if($expense){

            //begin transaction
            $transaction = DB::transaction(function() use($expense, $id) {

            
                $docno = $expense->docno;

                $oldfilename = $expense->attachment;

                $expense->delete(); //delete model
                AppStorage::remove($oldfilename);


                session()->flash('success', "Reference No. $docno has been deleted!");
                return 'success';

            });//END transaction

            return $transaction;

          
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }


    }//END destroy





}//END class
