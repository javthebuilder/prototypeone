<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\User;
use App\UserAccess;
use App\UserStore;
use App\DynamicForm;

use App\AppStorage;

class UsersController extends Controller
{

    //default selected sidebar
    public $active_parent = 'Settings';

    public $menu_group = '/users';

    public $primaryKey = 1000;//super admin account id


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
            'usercode'  =>  ['required','max:25'],
            'password'  =>  [],
            'pictx'     =>  ['image', 'mimes:jpg,jpeg,png,', 'max:1000' ], //500kb

        ];



        if( $form == 'store' ){
            //usercode must be unique in the users table
            array_push($common_rule['usercode'], 'unique:users');
            array_push($common_rule['password'], 'required' );
            array_push($common_rule['password'], 'confirmed' );

        }else if( $form == 'update' || $form == 'profile' ){ 

            //check if on update user has changed the password
            if( $request->password || $request->password_confirmation ){
                array_push($common_rule['password'], 'required' );
                array_push($common_rule['password'], 'confirmed' );
            }

            //when updating profile, the route does not accept the user id of the object, instead it is using the default Auth::id
            //mogamit ra ok $request->id if wala nag update sa session profile
            $id = ( $request->id ) ? $request->id : Auth::id();

            //ignore unique rule for the current updated record
            array_push($common_rule['usercode'], 
                //ignore($id,'custom_field')//optional
                Rule::unique('users')->ignore($id,'id')
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
            'name.required' => 'Fullname is required',
            'usercode.required' => 'Username is required',
            'usercode.unique' => 'Username already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'pictx.image' => 'Avatar must be an image',
            'pictx.mimes' => 'Avatar must be a type of jpeg,jpg,png',
            'pictx.max'=> 'Avatar size must be under 1000kb'
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
          
            $users = User::query();

            $search = ( request()->search ) ? request()->search : '';

            $users->where('name', 'like', "%$search%");

            //do not display super admin account to avoid data modification

            $users->where('id', '<>', $this->primaryKey);

            $users = $users->orderBy('name', 'ASC')->limit(10)->get();

            return $users;

        }//END ajax()


        $users = User::query();

        $search = ( request()->search ) ? request()->search : null;

        if($search){

            $users->where('name', 'like', "%$search%");

        }

        //do not display super admin account to avoid data modification

        $users->where('id', '<>', $this->primaryKey);

        $users = $users->orderBy('name', 'ASC')->paginate(20);

        //$users = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);


        return view('users.index', compact('users', 'search', 'sub_menu'));

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
        $form_fields = DynamicForm::form_fields('create', [], null, User::form_fields() );

        return view('users.create', compact('form_fields'));

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

            $request['password'] = bcrypt($request->password);

            $users = User::create($request->all()); //insert all $request

            //if request uploaded picture
            if( $request->pictx ){

                //update DB for correct filename @pictx
                $users->update([
                    'pictx'=> AppStorage::store('users', $request->pictx)
                ]);

            }//END check if request has uploaded picture
            
            session()->flash('success', "$request->name has been created!");
            //return redirect('/users/create');
            return redirect()->back();
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, User::form_fields() );
            return view('users.create', compact('form_fields'))->withErrors($validator);


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
        //highlight sidebar
        $this->setActiveParent();

        //do not display super admin account to avoid data modification
        //get the first record only to allow DynamicForm @attributes to work
        $users = User::where('id', '=', $id)
                ->where('id', '<>', $this->primaryKey)
                ->first();

        //dd($users);

        //set password to null
        if( $users ){
            $users->password = null;
        }

        //dd($users->password);

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $users, null, User::form_fields() );

        //dd($form_fields);

        return view('users.show', compact('users', 'form_fields') );

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

         //highlight sidebar
        $this->setActiveParent();

        //do not display super admin account to avoid data modification
        //get the first record only to allow DynamicForm @attributes to work
        $users = User::where('id', '=', $id)
                ->where('id', '<>', $this->primaryKey)
                ->first();

        //dd($users);

        //set password to null
        if( $users ){
            $users->password = null;
        }

        //dd($users->password);

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $users, null, User::form_fields() );

        //dd($form_fields);

        return view('users.edit', compact('users', 'form_fields') );

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
        //$id = 1000;
        $validator = $this->custom_validation($request, 'update');

        //highlight sidebar
        $this->setActiveParent();

       
        //do not display super admin account to avoid data modification
        $users = User::where('id', '=', $id)->where('id', '<>', $this->primaryKey)->first();


        //check if $validator is true && record is found
        if( $validator === true && $users ){

            $users->name = $request->name;
            $users->usercode = $request->usercode;
            $users->stat = $request->stat;

            //check if user has changed the password
            if( $request->password  ){
                $users->password = bcrypt($request->password);

            }

            //to be remove from storage
            $oldfilename = $users->pictx; 

            $users->save(); 

            //check if user removed the logo
            if( $request->removepictx && $request->removepictx == 'on' ){
                                   
                AppStorage::remove($oldfilename);

                //update DB for correct filename @pictx
                $users->update([
                    'pictx'=> null
                ]);

            }//END check if user removed the logo


            //if request uploaded picture
            if( $request->pictx ){

                AppStorage::remove($oldfilename);

                //update DB for correct filename @pictx
                $users->update([
                    'pictx'=> AppStorage::store('users', $request->pictx)
                ]);

            }//END check if request has uploaded picture

            //dd($users);

            
            session()->flash('success', "$request->name has been updated!");
            //return redirect('/users/edit/'.$id);
            return redirect()->back();

        }
        else{

            //set password to null
            if( $users ){
                $users->password = null;
            }

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $users, null, User::form_fields() );
            return view('users.edit', compact('form_fields', 'users'))->withErrors($validator);


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
        //$id = 1000;
        //return $id;

        //do not display super admin account to avoid data modification
        $users = User::where('id', '=', $id)->where('id', '<>', $this->primaryKey)->first();

        //return $users;

        if($users){

            //begin transaction
            $transaction = DB::transaction(function() use($users, $id) {

                //delete useraccess
                UserAccess::where('fk_users', '=', $id)->delete();
             
                //delete current userstores
                UserStore::where('fk_users', '=', $id)->delete();

                $description = $users->name;

                $users->delete(); //delete model

                session()->flash('success', "$description has been deleted!");
                return 'success';

            });//END transaction

            return $transaction;

          
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }
         

    }//END destroy




    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        //

        //highlight header nav
        session()->flash('active_parent', 'Profile');

        $users = User::findOrFail(Auth::id());

        //dd($users);

        //set password to null
        if( $users ){
            $users->password = null;
        }

        //dd($users->password);

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $users, null, User::form_fields() );

        //dd($form_fields);

        return view('users.profile', compact('users', 'form_fields') );

    }//END showProfile



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //
        $validator = $this->custom_validation($request, 'profile');

        //highlight header nav
        session()->flash('active_parent', 'Profile');

        //dd($request->all());

        $users = User::findOrFail(Auth::id());

        //check if $validator is true && record is found
        if( $validator === true && $users ){

            $users = User::findOrFail(Auth::id());

            //to be remove from storage
            $oldfilename = $users->pictx; 

            $users->name = $request->name;
            $users->usercode = $request->usercode;
            //$user->stat = $request->stat; //hidden when updating profile
            //check if on update profile has changed the password
            if( $request->password ){
                $users->password = bcrypt($request->password);
            }
            
            $users->save();

            //check if user removed the logo
            if( $request->removepictx && $request->removepictx == 'on' ){
                                   
                AppStorage::remove($oldfilename);

                //update DB for correct filename @pictx
                $users->update([
                    'pictx'=> null
                ]);

            }//END check if user removed the logo

            //if request uploaded picture
            if( $request->pictx ){

                AppStorage::remove($oldfilename);

                //update DB for correct filename @pictx
                $users->update([
                    'pictx'=> AppStorage::store('users', $request->pictx)
                ]);

            }//END check if request has uploaded picture
            
            session()->flash('success', "your profile has been updated!");
            //return redirect('/profile');
            return redirect()->back();

        }
        else{

            //set password to null
            if( $users ){
                $users->password = null;
            }

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $users, null, User::form_fields() );
            return view('users.profile', compact('form_fields', 'users'))->withErrors($validator);


        }

        //dd($request->all());

    }//END updateProfile



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAccessibility($id)
    {
      
        if( request()->ajax() ){

            //modules A - parent, B - child of A, C - child of B
            $A = DB::select("call usp_getModules($id, 'A')");
            $B = DB::select("call usp_getModules($id, 'B')");
            $C = DB::select("call usp_getModules($id, 'C')");

            $stores = DB::select("call usp_getStores($id)");
            
            return ['A'=>$A, 'B'=>$B, 'C'=>$C, 'stores'=> $stores ];
        }  

        //
        //highlight sidebar
        $this->setActiveParent();

        //do not display super admin account to avoid data modification
        //get the first record only to allow DynamicForm @attributes to work
        $users = User::where('id', '=', $id)
                ->where('id', '<>', $this->primaryKey)
                ->first();

        //dd($users);
        
        if(!$users){
            return redirect('/404');
        }

        return view('users.accessibility', compact('users') );

    }//END showAccessibility



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccessibility(Request $request, $id)
    {
      
        if( request()->ajax() ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $id) {

                $fk_createdby = Auth::id();
                $fk_updatedby = Auth::id(); 

                //remove current useraccess
                UserAccess::where('fk_users', '=', $id)->delete();
                //loop selected modules to be inserted to useraccess table
                foreach ($request->modules as $key => $v) {

                   UserAccess::create([
                        'fk_users'=> $id,
                        'fk_permalink'=> $v['pk_permalink'],
                        'fk_createdby'=> $fk_createdby,
                        'fk_updatedby'=> $fk_updatedby
                    ]);
                }

                //remove current userstores
                UserStore::where('fk_users', '=', $id)->delete();
                //loop selected modules to be inserted to userstores table
                foreach ($request->stores as $key => $v) {

                   UserStore::create([
                        'fk_users'=> $id,
                        'fk_stores'=> $v['pk_stores'],
                        'fk_createdby'=> $fk_createdby,
                        'fk_updatedby'=> $fk_updatedby
                    ]);
                }

        
                //all query are successful
                return 'success'; 

            });//END transaction

            return $transaction;


        }  

      
    }//END updateAccessibility




}//END class
