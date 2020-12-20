<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\User;
use App\Store;
use App\DynamicForm;

class StoresController extends Controller
{


    //default selected sidebar
    public $active_parent = 'Settings';

    public $menu_group = '/stores';


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
            'email'  =>  ['required','email','max:255'],
            'phone'  =>  ['required','max:255'],
            'address'  =>  ['required','max:255'],
            'receiptfooter'  =>  ['required','max:255'],
       
        ];

        if( $form == 'store' ){

            array_push($common_rule['name'], 'unique:stores');

        }else if($form == 'update' ){ 

            array_push($common_rule['name'],
                //stores = table name 
                //ignore($id,'primarykey')//optional
                Rule::unique('stores')->ignore($request->id,'pk_stores')
            );
        }

        //dd($common_rule);

        //checkboxes
        $request['stat'] = ($request['stat'] == 'on') ? 1 : 0;

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
            'name.required' => 'Name is required',
            'name.unique'    => 'Name already exists',
            'description.required' => 'Description is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone is required',
            'address.required' => 'Address is required',
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

        $search = ( request()->search ) ? request()->search : null;

        $stores = Store::query();

        if( $search  ){

            $stores->where('name', 'like',  '%'.$search.'%');

        }

        $stores = $stores->orderBy('name', 'ASC')->paginate(20);

        //$stores = [];

        //highlight sidebar
        $this->setActiveParent();
       
        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);

        return view('stores.index', compact('stores', 'sub_menu', 'search'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //highlight sidebar
        $this->setActiveParent();

        //[] = query object
        //null = current request
        $form_fields = DynamicForm::form_fields('create', [], null, Store::form_fields() );
        //dd($el);
        return view('stores.create', compact('form_fields'));
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
        $validator = $this->custom_validation($request, 'store');

        //highlight sidebar
        $this->setActiveParent();

        if( $validator === true ){

            $request['fk_createdby'] = Auth::id();

            Store::create($request->all()); //insert all $request
            
            session()->flash('success', "$request->name has been created!");
            //return redirect('/stores/create');
            return redirect()->back();
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Store::form_fields() );
            return view('stores.create', compact('form_fields'))->withErrors($validator);

        }

        //dd($request->all());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //highlight sidebar
        $this->setActiveParent();

        $stores = Store::findOrFail($id);

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $stores, null, Store::form_fields() );

        return view('stores.show', compact('stores', 'form_fields') );
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

        //highlight sidebar
        $this->setActiveParent();

        $stores = Store::findOrFail($id);

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $stores, null, Store::form_fields() );

        return view('stores.edit', compact('stores', 'form_fields') );
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

        $stores = Store::findOrFail($id);

        //check if $validator is true && record is found
        if( $validator === true && $stores ){

            $request['fk_updatedby'] = Auth::id();

            $stores = $stores->update($request->all()); //update all request
            
            session()->flash('success', "$request->name has been updated!");
            //return redirect('/stores/edit/'.$id);
            return redirect()->back();
        }
        else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $stores, null, Store::form_fields() );
            return view('stores.edit', compact('form_fields', 'stores'))->withErrors($validator);

        }

        //dd($request->all());
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
        //return $id;

        $stores = Store::findOrFail($id);

        if( $stores ){

            $description = $stores->name;
       
            $stores->delete(); //used to delete the model

            session()->flash('success', "$description has been deleted!");
            return 'success';
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }
         

        //return $stores;

    }
}
