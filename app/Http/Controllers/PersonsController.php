<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\Person;
use App\DynamicForm;
use App\User;

class PersonsController extends Controller
{


    //default selected sidebar
    public $active_parent = 'Master Files';

    public $menu_group = '/persons';


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
            'fullname'  =>  ['required','max:255'],
            'email'     =>  ['max:255'],
            'contact'  =>  ['max:255'],
            'address'  =>  ['max:255'],
            'tinno'  =>  ['max:255'],
            'remarks'  =>  ['max:255'],
        ];


        //validate email if with input
        if( $request->email ){
            array_push($common_rule['email'], 'email');
        }//END email

        
        if( $form == 'store' ){

            array_push($common_rule['fullname'], 'unique:persons');

        }else if($form == 'update' ){ 

            array_push($common_rule['fullname'],
                //persons = table name 
                //ignore($id,'primarykey')//optional
                Rule::unique('persons')->ignore($request->id,'pk_persons')
            );
        }

        //dd($common_rule);

        //checkboxes
        $request['iscustomer'] = ($request['iscustomer'] == 'on') ? 1 : 0;
        $request['issupplier'] = ($request['issupplier'] == 'on') ? 1 : 0;
        $request['stat'] = ($request['stat'] == 'on') ? 1 : 0;

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
            'fullname.required' => 'Fullname is required',
            'fullname.unique'=> 'Fullname already exists'
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
          
            $persons = Person::query();

            $search = ( request()->search ) ? request()->search : '';

            $type = ( request()->type ) ? request()->type : null;

            $stat = ( request()->stat ) ? request()->stat : null;

            $persons->where('fullname', 'like', "%$search%")->where('stat', '=', $stat);

            if( $type == 'customer' ){
                $persons->where('iscustomer', '=', "1");
            }
       
            $persons = $persons->orderBy('fullname', 'ASC')->limit(10)->get();

            return $persons;

        }//END ajax()

        $persons = Person::query();

        $search = ( request()->search ) ? request()->search : null;

        $persontype = ( request()->persontype ) ? request()->persontype : 'All';

        if($search){

            //default search fullname
            $persons->where('fullname', 'like', "%$search%");


        }//END if $search

        if($persontype != 'All'){

            if( $persontype == 'customer' ){
                $persons->where('iscustomer', '1');
            }
            elseif( $persontype == 'supplier'  ){
                $persons->where('issupplier', '1');
            }

        }

        $persons = $persons->orderBy('fullname', 'ASC')->paginate(20);

        //$persons = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);


        return view('persons.index', compact('persons', 'search', 'persontype', 'sub_menu'));

    }//END index()




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
        $form_fields = DynamicForm::form_fields('create', [], null, Person::form_fields() );

        return view('persons.create', compact('form_fields'));


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

        if( $validator === true ){

            $request['fk_createdby'] = Auth::id();

            Person::create($request->all()); //insert all $request
            
            session()->flash('success', "$request->fullname has been created!");
            //return redirect('/persons/create');
            return redirect()->back();
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Person::form_fields() );
            return view('persons.create', compact('form_fields'))->withErrors($validator);

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
        $persons = Person::findOrFail($id);

        //dd($persons);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $persons, null, Person::form_fields() );

        return view('persons.show', compact('form_fields', 'persons') );


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


        $persons = Person::findOrFail($id);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $persons, null, Person::form_fields() );

        return view('persons.edit', compact('form_fields', 'persons') );

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
        //highlight sidebar
        $this->setActiveParent();

        //$id = -1;

        $validator = $this->custom_validation($request, 'update');

        $persons = Person::findOrFail($id);

        //check if $validator is true && record is found
        if( $validator === true && $persons ){

            $request['fk_updatedby'] = Auth::id();

            $persons->update($request->all());

            session()->flash('success', "$request->fullname has been updated!");

            //return redirect("/persons/edit/$id");
            return redirect()->back();

        }else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $persons, null, Person::form_fields() );
            return view('persons.edit', compact('form_fields', 'persons'))->withErrors($validator);

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
        $persons = Person::findOrFail($id);

        if($persons){

            $description = $persons->fullname;

            $persons->delete(); //delete model

            session()->flash('success', "$description has been deleted!");
            return 'success';
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }
         

        //return $persons;

    }//destroy



}//END class
