<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\AppStorage;

use App\Company;
use App\DynamicForm;
use App\User;

class CompanyController extends Controller
{

    //default selected sidebar
    public $active_parent = 'Settings';

    public $menu_group = '/company';

    public $pk_company = 1000; //default company


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }



    /**
        - $form = 'store', 'update'
    */
    public function custom_validation($request, $form){
  
        $common_rule = [
            'name'  =>  ['required','max:255'],
            'description'  =>  ['required','max:255'],
            'address'  =>  ['required','max:255'],
            'contact'  =>  ['required','max:255'],
            'email'  =>  ['required','email','max:255'],
            'owner'  =>  ['required','max:255'],
            'vat'  =>  ['required','numeric','between:0,100'],
            'pictx'  =>  ['image', 'mimes:jpg,jpeg,png,', 'max:1000' ],
            'receiptheader'  =>  ['required','max:255'],
            'receiptfooter'  =>  ['required','max:255'],
       
        ];

        if( $form == 'store' ){

            //not supported. only one record for company

        }else if($form == 'update' ){ 

            //not supported. only one record for company
        }

        //dd($common_rule);

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
            'name.required' => 'Company name is required',
            'description.required' => 'Description is required',
            'address.required' => 'Address is required',
            'contact.required' => 'Contact No. is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'owner.required' => 'Owner is required',
            'vat.required' => 'Vat is required',
            'vat.numeric'  => 'Vat must be numeric',
            'vat.between'  =>  'Vat must be between 0 to 100 only',
            'pictx.image' => 'company logo must be an image',
            'pictx.mimes' => 'company logo must be a type of jpeg,jpg,png',
            'pictx.max'=> 'company logo size must be under 1000kb'
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //default active sidebar
        $this->setActiveParent();

        $company = Company::findOrFail($this->pk_company);

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $company, null, Company::form_fields() );

        return view('company.index', compact('company', 'form_fields'));


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
        //highlight sidebar
        $this->setActiveParent();

        $validator = $this->custom_validation($request, 'update');

        $company = Company::findOrFail($id);

        //check if $validator is true && record is found
        if( $validator === true && $company ){

            //dd($request->all());

            //to be remove from storage
            $oldfilename = $company->pictx; 

            //update DB
            $company->update($request->all());

            //check if user removed the logo
            if( $request->removepictx && $request->removepictx == 'on' ){
                                   
                AppStorage::remove($oldfilename);

                //update DB for correct filename @pictx
                $company->update([
                    'pictx'=> null
                ]);

            }//END check if user removed the logo


            //if request uploaded picture
            if( $request->pictx ){

                AppStorage::remove($oldfilename);
                
                //update DB for correct filename @pictx
                $company->update([
                    'pictx'=> AppStorage::store('company', $request->pictx)
                ]);

            }//END check if request uploaded picture

            session()->flash('success', "$request->name has been updated!");

            //return redirect("/company");
            return redirect()->back();

        }else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $company, null, Company::form_fields() );
            return view('company.index', compact('form_fields', 'company'))->withErrors($validator);
            //return redirect()->back()->withInput()->withErrors($validator);



        }


    }

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



}//END class
