<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth; //responsible for our authentication 


use App\Store;

class HomeController extends Controller
{   
    
    //default selected sidebar
    public $active_parent = 'Home';

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
        $stores = Store::getAssignedStores(Auth::id());

        //highlight sidebar
        $this->setActiveParent();
        
        return view('home', compact('stores'));
    }

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
        //
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
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selectStore($id)
    {
        //
        $result = Store::find($id);

        if($result){

            //create session
            session(['session_store'=> $result->pk_stores]);

            //redirect to POS
            return redirect('/pos');

            //retrieve session
            //session('session_store');

            //retrieve session and delete in one statement
            //session()->pull('session_store');

            //delete
            //session()->forget('session_store');
            //session()->flush();

        }

        return redirect('/home');

    }

}
