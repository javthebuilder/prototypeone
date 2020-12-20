<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Validation\Rule;

use Validator;

use App\AppStorage;

use App\Product;
use App\ProductsStore;
use App\ProductsQty;
use App\ProductsPrice;
use App\ProductsMstrView;
use App\ProductsComposition;
use App\Category;
use App\Person;
use App\User;
use App\Store;

use Carbon\Carbon; //laravel date time

class ProductsCompositionsController extends Controller
{
    //

	 //default selected sidebar
    public $active_parent = 'Master Files';

    public $menu_group = '/products';


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

        //default active sidebar
        $this->setActiveParent();

      
        if( request()->ajax() ){

        	return ['compositions'=> ProductsComposition::getItemCompositions($id), 'searchitems'=> $this->search(request(), $id)];

        }

        $products = Product::findOrFail($id);

        return view('products.composition-create', compact('products'));

    }//END create



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $id)
    {
        //

        if( request()->ajax() ){

	
			$search = ( $request->search ) ?  '%'.$request->search.'%' : '%%';     	

        	$products = Product::where('name', 'like', $search)
        				->where('pk_products', '<>', $id)
        				->where('stat', 1)
        				->orderBy('name', 'ASC')
        				->limit(20)
        				->get();

        	return $products;

        }


    }//END search






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $products = Product::find($id);

        if(!$products){
        	return 'not found!';
        }

    	//begin transaction
        $transaction = DB::transaction(function() use($request, $id) {

            $request['fk_createdby'] = Auth::id();


            //remove all compositions
            ProductsComposition::where('fk_products', $id)->delete();

            foreach($request->compositions as $key => $v){

            	ProductsComposition::create([

            		'fk_products'=> $id,
            		'fk_compositions'=> $v['fk_compositions'],
            		'qty'=> $v['qty'],
            		'fk_createdby'=> $request->fk_createdby

            	]);

            }

            return 'success';


        });//END transaction

        return $transaction;
    

    }//END update







}

