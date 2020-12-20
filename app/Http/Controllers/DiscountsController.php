<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\Discount;
use App\DynamicForm;
use App\User;

class DiscountsController extends Controller
{
   
    //default selected sidebar
    public $active_parent = 'Settings';

    public $menu_group = '/discounts';


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
            'description'  =>  ['required','max:255'],
            'rate'  =>  ['required','numeric','between:0,100'],
       
        ];

        if( $form == 'store' ){

            array_push($common_rule['description'], 'unique:discounts');

        }else if($form == 'update' ){ 

            array_push($common_rule['description'],
                //discounts = table name 
                //ignore($id,'primarykey')//optional
                Rule::unique('discounts')->ignore($request->id,'pk_discounts')
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
            'description.required' => 'Description is required',
            'description.unique'    => 'Description already exists',
            'rate.required' => 'Rate is required',
            'rate.numeric'  => 'Rate must be numeric',
            'rate.between'  =>  'Rate must be between 0 to 100 only',
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
          
            $discounts = Discount::select();

            $search = ( request()->search ) ? request()->search : '';

            $stat = ( request()->stat ) ? request()->stat : null;

            $discounts->where('description', 'like', "%$search%")->where('stat', '=', $stat);

            $discounts = $discounts->orderBy('description', 'ASC')->limit(10)->get();

            return $discounts;

        }//END ajax()


        $discounts = Discount::query();

        $search = ( request()->search ) ? request()->search : null;

        if($search){

            $discounts->where('description', 'like', "%$search%");

        }

        //default discounts 
        //senior & pwd
        //should not be modified since fix ang computation sa discounts sa senior of pwd sa POSController @additems
        //$discounts->where('pk_discounts', '<>', 1)->where('pk_discounts', '<>', 2);

        $discounts = $discounts->orderBy('description', 'ASC')->paginate(20);

        //$discounts = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);


        return view('discounts.index', compact('discounts', 'search', 'sub_menu'));

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
        $form_fields = DynamicForm::form_fields('create', [], null, Discount::form_fields() );

        return view('discounts.create', compact('form_fields'));


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

            Discount::create($request->all()); //insert all $request
            
            session()->flash('success', "$request->description has been created!");
            //return redirect('/discounts/create');
            return redirect()->back();
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Discount::form_fields() );
            return view('discounts.create', compact('form_fields'))->withErrors($validator);

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

        $discounts = Discount::findOrFail($id);

        //dd($discounts);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $discounts, null, Discount::form_fields() );

        return view('discounts.show', compact('form_fields', 'discounts') );


    }//END show


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $discounts = Discount::findOrFail($id);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $discounts, null, Discount::form_fields() );

        return view('discounts.edit', compact('form_fields', 'discounts') );


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

        $validator = $this->custom_validation($request, 'update');

        $discounts = Discount::findOrFail($id);

        //check if $validator is true && record is found
        if( $validator === true && $discounts ){

            $request['fk_updatedby'] = Auth::id();

            $discounts->update($request->all());

            session()->flash('success', "$request->description has been updated!");

            //return redirect("/discounts/edit/$id");
            return redirect()->back();

        }else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $discounts, null, Discount::form_fields() );
            return view('discounts.edit', compact('form_fields', 'discounts'))->withErrors($validator);



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
        $discounts = Discount::findOrFail($id);

        if($discounts){

            $description = $discounts->description;

            $discounts->delete(); //delete model

            session()->flash('success', "$description has been deleted!");
            return 'success';
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }
         

        //return $discounts;


    }//END destroy


}//END class
