<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\Category;
use App\DynamicForm;
use App\User;

class CategoriesController extends Controller
{
    


    //default selected sidebar
    public $active_parent = 'Settings';

    public $menu_group = '/categories';


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
            'type'  =>  ['required'],
       
        ];

        if( $form == 'store' ){
            //add rule to description field

            //manual validation for two columns as unique value @store function



        }else if($form == 'update' ){ 

           //manual validation for two columns as unique value @update function
        }

        //dd($common_rule);

        //checkboxes
        $request['stat'] = ($request['stat'] == 'on') ? 1 : 0;

        //validate the form
        $validator = Validator::make( $request->all(), $common_rule, $this->messages() );

        //dd($validator);

        if( $validator->fails() ){
            return $validator;
        }

        return true;

    }//end custom_validation


    //custome validation error messages
    public function messages(){
        return [
            'description.required' => 'Description is required',
        ];
    }//end messages



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

        $categories = Category::query();

        $search = ( request()->search ) ? request()->search : null;

        if($search){

            $categories->where('description', 'like', "%$search%")
            ->orWhere('type', 'like',  "%$search%");

        }

        $categories = $categories->orderBy('type', 'ASC')
                    ->orderBy('description', 'ASC')->paginate(20);

        //$discounts = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);


        return view('categories.index', compact('categories', 'search', 'sub_menu'));



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
        $form_fields = DynamicForm::form_fields('create', [], null, Category::form_fields() );

        return view('categories.create', compact('form_fields'));

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

        //normal validator is true
        if( $validator === true ){

            //manual check for duplicate entry for description & type
            $temp = Category::where('description', $request->description)
                    ->where('type', $request->type)->get();
            
            //dd( $temp );

            //record already exists
            if( count($temp) > 0 ){

                //[] = query object
                $form_fields = DynamicForm::form_fields('store', [], $request, Category::form_fields() );
                return view('categories.create', compact('form_fields'))->withErrors('Description with the same type already exists');
            }

            //record does not exist
            $request['fk_createdby'] = Auth::id();

            Category::create($request->all()); //insert all $request
            
            session()->flash('success', "$request->description has been created!");
            //return redirect('/categories/create');
            return redirect()->back();
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Category::form_fields() );
            return view('categories.create', compact('form_fields'))->withErrors($validator);

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

        $categories = Category::findOrFail($id);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $categories, null, Category::form_fields() );

        return view('categories.show', compact('form_fields', 'categories') );

    }//END show



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::findOrFail($id);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $categories, null, Category::form_fields() );

        return view('categories.edit', compact('form_fields', 'categories') );


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

        //highlight sidebar
        $this->setActiveParent();

        $categories = Category::findOrFail($id); 

        //normal validator is true && record is found
        if( $validator === true && $categories ){
            

            //manual check for duplicate entry for description & type
            $temp = Category::where('description', $request->description)
                    ->where('type', $request->type)
                    ->where('pk_categories', '<>', $id)
                    ->get();
            
            //dd( $temp );

            //record already exists
            if( count($temp) > 0 ){

                session()->flash('error', "Description with the same type already exists");

                return redirect("/categories/edit/$id");
            }


            //record does not exist
            $request['fk_updatedby'] = Auth::id();

            $categories->update($request->all()); //update all $request
            
            session()->flash('success', "$request->description has been updated!");

            //return redirect("/categories/edit/$id");
            return redirect()->back();

        }
        else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $categories, null, Category::form_fields() );
            return view('categories.edit', compact('categories', 'form_fields'))->withErrors($validator);

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
        $categories = Category::findOrFail($id);

        if($categories){

            $description = $categories->description;

            $categories->delete(); //delete model

            session()->flash('success', "$description has been deleted!");
            return 'success';
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }
         


    }//END destroy


}//END class
