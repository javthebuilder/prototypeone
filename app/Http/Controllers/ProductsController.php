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
use App\ProductPricesHistory;
use App\ProductsMstrView;
use App\DynamicForm;
use App\Category;
use App\Person;
use App\User;
use App\Store;

use Carbon\Carbon; //laravel date time


class ProductsController extends Controller
{

    //default selected sidebar
    public $active_parent = 'Master Files';

    public $menu_group = '/products';

    public $categories = [];
    public $supplier = [];


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }


    //setup our required requisite for the form
    public function setPrerequisites(){

        $this->categories = Category::where('type', '=', 'products')
                    ->where('stat', 1)
                    ->orderBy('description', 'asc')->get();

        $this->supplier = Person::where('issupplier', 1)
                    ->where('stat', 1)
                    ->orderBy('fullname', 'asc')->get();
                    

    }//END setPrerequisites()



    /**
        - $form = 'store', 'update'
    */
    public function custom_validation($request, $form){
  
        $common_rule = [
            'barcode'   =>  ['required','max:255'],
            'type'      =>  ['required','max:10'],
            'name'      =>  ['required','max:255'],
            'fk_categories'    =>  ['required'],
            'cost'      =>  ['numeric', 'min:0'],
            'tax'       =>  ['required','max:3'],
            'uom'       =>  ['max:15'],
            'alertqty'  =>  ['numeric', 'min:0'],
            'pictx'     =>  ['image', 'mimes:jpg,jpeg,png,', 'max:1000' ], //500kb
            'background'  =>  ['max:10'],
            'remarks'  =>  ['max:255'],
       
        ];

        if( $form == 'store' ){
            //unique column from table products
            array_push($common_rule['barcode'], 'unique:products');
            //array_push($common_rule['name'], 'unique:products');

        }else if($form == 'update' ){ 

            array_push($common_rule['barcode'],
                //products = table name 
                //ignore($id,'primarykey')//optional
                Rule::unique('products')->ignore($request->id,'pk_products')
            );

            /*array_push($common_rule['name'],
                //products = table name 
                //ignore($id,'primarykey')//optional
                Rule::unique('products')->ignore($request->id,'pk_products')
            ); */
        }

        //dd($common_rule);

        //when barcode is not specified the system will automatically generate a random default value
        if( !$request->barcode ){

            //dd($barcode);
           $request['barcode'] = substr( $request->type, 0,3) . mt_rand();

        }//END barcode

       
        //null values
        $request['fk_supplier'] = ($request['fk_supplier'] != '-1') ? $request['fk_supplier'] : null;

        //checkboxes
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
            //'barcode.required' => 'Barcode ID is required',
            'barcode.unique' => 'Barcode ID already exists',
            'type.required' => 'Type is required',
            'name.required' => 'Product name is required',
            'name.unique' => 'Product name already exists',
            'fk_categories.required' => 'Product category is required',
            'cost.numeric'  => 'Unit cost must be numeric',
            'tax.required' => 'Tax method is required',
            'alertqty.numeric'  => 'Alert qty must be numeric',
            'pictx.image' => 'Product logo must be an image',
            'pictx.mimes' => 'Product logo must be a type of jpeg,jpg,png',
            'pictx.max'=> 'Product logo size must be under 1000kb'
        ];
    }



    //for select2 or other search option
    public function searchproductsperstore(Request $request){

        if( $request->ajax() ){


            $session_id = Auth::id();

            $stat = ( $request->stat ) ? $request->stat : 1;

            //error if store selected is all since data type of stored procedure is int; must select specific store
            $fk_stores = ($request->fk_stores) ? $request->fk_stores : null;
            if( $fk_stores == 'All' ){
                $fk_stores = 0;
            }

            $search = ($request->search) ? $request->search : '';

            $products = DB::select("CALL usp_searchAssignedProductsPerStores2($session_id, $fk_stores, $stat, '%$search%')");

            return $products;

        }

        return redirect('/products');

    }//END searchproductsperstore


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

        $products = ProductsMstrView::query();

        $search = ( request()->search ) ? request()->search : null;

        $fk_categories = ( request()->fk_categories ) ? request()->fk_categories : 'All';
        $categories_arr =  Category::getActiveCategoriesByType('products');

        $producttype = ( request()->producttype ) ? request()->producttype : 'All';


        if($search){

            $products->where(function($query){
                $query->where('name', 'like', '%'.request()->search.'%')
                    ->orWhere('type', '=', request()->search )
                    ->orWhere('category', '=', request()->search )
                    ->orWhere('barcode', '=', request()->search )
                    ->orWhere('pk_products', '=', request()->search );
            });


        }


        if($fk_categories != 'All'){

            $products->where('fk_categories', '=', $fk_categories);

        }else{
          
        }//END $fk_categories != 'All'



        if($producttype != 'All'){

            $products->where('type', '=', $producttype);

        }else{
          
        }//END $producttype != 'All'

      
        $products = $products->orderBy('name', 'ASC')->paginate(20);
    

        //will return pk_stores concatenated as string
        //1000,1002,1003
        $strStores = Product::getAssignedStoresAsString();

        $strProducts = Product::getProductIDAsString($products);
    
        $prices = Product::getItemPriceListPerStore($strProducts, $strStores);

        //dd($prices);

        $qty = Product::getItemQtyListPerStore($strProducts, $strStores);

        //dd($qty);


        //insert prices & qty table
        $i = 0;
        foreach ($products as $k1 => $v1) {

            $products[$i]['prices_str'] = "";  //initialize string
            //actual array of prices base on stores
            $products[$i]['prices_arr'] = []; //actual array
            $tempPricesArr= []; 
            $xx = 0;
           
            foreach ($prices as $k2 => $v2) {

                if( $v1->pk_products == $v2->fk_products ){
                   
                    $products[$i]['prices_str'] .= "<p><b>".$v2->storename .'</b><br>'.
                    'Price: <span class="text-danger">'. number_format($v2->price,2).'</span><br>'.
                    'Disc%: <span class="text-danger">'. number_format($v2->discount,2).'</span></p>';

                    $tempPricesArr[$xx++] = $v2;


                }//END if pk_products


            }//END foreach prices

            $products[$i]['prices_arr'] = $tempPricesArr; //set actual array of prices


            $products[$i]['qty_str'] = "";  //initialize string
            //actual array of qty base on stores
            $products[$i]['qty_arr'] = []; //actual array
            $tempQtyArr= [];
            $xx = 0;

            $totalqty = 0;

            foreach ($qty as $k2 => $v2) {

                if( $v1->pk_products == $v2->fk_products  ){

                    $totalqty += floatval($v2->qty);
                   
                    $products[$i]['qty_str'] .="<p><b>".$v2->storename .'</b><br>'.
                    'Qty: <span class="text-danger">'. number_format($v2->qty,2).'</span> '.$v1->uom.'<br></p>';

                    $tempQtyArr[$xx++] = $v2;

                }//END if pk_products

            }//END foreach qty

            //set total
            $products[$i]['qty_str'] .='<p><b>Total:</b> <span class="text-danger">'. number_format($totalqty,2). '</span> '. $v1->uom .'</p>';


            $products[$i]['qty_arr'] = $tempQtyArr; //set actual array of qty

            $i++;//base index products
         
        }//END foreach $products

        //dd($products);

        //$products = [];

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);


        return view('products.index', compact('products', 'search', 'fk_categories', 'categories_arr', 'producttype', 'sub_menu'));


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
        $form_fields = DynamicForm::form_fields('create', [], null, Product::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $supplier = $this->supplier;

        //dd($categories . $supplier);
        return view('products.create', compact('form_fields', 'categories', 'supplier'));

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

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                //create will return the newly created object
                $products = Product::create($request->all()); //insert all $request

                //dd($products);

                //if request uploaded picture
                if( $request->pictx ){

                    //update DB for correct filename @pictx
                    $products->update([
                        'pictx'=> AppStorage::store('products', $request->pictx)
                    ]);

                }else{

                    //default picture
                    //update DB for correct filename @pictx
                    $products->update([
                        'pictx'=> 'products/apple-icon.png'
                    ]);


                }//END check if request has uploaded picture

                //by default set visibility to all stores 
                $stores = Store::where('stat', 1)->pluck('pk_stores');
                foreach ($stores as $key => $v) {
                   
                   //insert to ProductsStore
                    ProductsStore::create([
                        'fk_products'=> $products->pk_products,
                        'fk_stores'=> $v,
                        'fk_createdby'=> Auth::id()
                    ]);


                }//END foreach
                //dd($stores);

                session()->flash('success', "$request->name has been created!");
                return redirect()->back();


            });//END transaction

            return $transaction;
            
        }
        else{

            //[] = query object
            $form_fields = DynamicForm::form_fields('store', [], $request, Product::form_fields() );
            $this->setPrerequisites();
            $categories = $this->categories;
            $supplier = $this->supplier;
            return view('products.create', compact('form_fields', 'categories', 'supplier'))->withErrors($validator);

            //return redirect()->back()->withInput()->withErrors($validator);


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

        if( request()->ajax() ){

            $products = Product::findOrFail($id);

            return $products;

        }

        //
        $products = Product::findOrFail($id);

        //dd($products);

        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('show', $products, null, Product::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $supplier = $this->supplier;

        return view('products.show', compact('form_fields', 'products', 'categories', 'supplier') );


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

        $products = Product::findOrFail($id);


        //highlight sidebar
        $this->setActiveParent();

        //null = current request
        $form_fields = DynamicForm::form_fields('edit', $products, null, Product::form_fields() );

        $this->setPrerequisites();
        $categories = $this->categories;
        $supplier = $this->supplier;

        return view('products.edit', compact('form_fields', 'products', 'categories', 'supplier') );



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

        $products = Product::findOrFail($id);

        //check if $validator is true && record is found
        if( $validator === true && $products ){

           
            //begin transaction
            $transaction = DB::transaction(function() use($request, $products) {

                $request['fk_updatedby'] = Auth::id();

                //to be remove from storage
                $oldfilename = $products->pictx; 

                //dd($request->all());

                $products->update($request->all());

                //check if user removed the logo
                if( $request->removepictx && $request->removepictx == 'on' ){
                                       
                    AppStorage::remove($oldfilename);

                    //update DB for correct filename @pictx
                    $products->update([
                        'pictx'=> null
                    ]);

                }//END check if user removed the logo


                //if request uploaded picture
                if( $request->pictx ){

                    AppStorage::remove($oldfilename);
                    
                    //update DB for correct filename @pictx
                    $products->update([
                        'pictx'=> AppStorage::store('products', $request->pictx)
                    ]);

                }//END check if request uploaded picture



                session()->flash('success', "$request->name has been updated!");

                //return redirect("/products/edit/$products->pk_products");
                return redirect()->back();



            });//END transaction

            return $transaction;
            


    
        }else{

            //null = current request
            $form_fields = DynamicForm::form_fields('update', $products, null, Product::form_fields() );

            $this->setPrerequisites();
            $categories = $this->categories;
            $supplier = $this->supplier;

            return view('products.edit', compact('form_fields', 'products', 'categories', 'supplier'))->withErrors($validator); 
            //return redirect()->back()->withInput()->withErrors($validator);




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

        $products = Product::findOrFail($id);

        //return $products;

        if($products){

            //begin transaction
            $transaction = DB::transaction(function() use($products, $id) {

                //delete productsstore
                ProductsStore::where('fk_products', '=', $id)->delete();

                //delete productsqty
                ProductsQty::where('fk_products', '=', $id)->delete();

                //delete productsprice
                ProductsPrice::where('fk_products', '=', $id)->delete();
            
                $name = $products->name;

                $oldfilename = $products->pictx;

                $products->delete(); //delete model
                AppStorage::remove($oldfilename);

                session()->flash('success', "$name has been deleted!");
                return 'success';

            });//END transaction

            return $transaction;

          
        }   
        else{
            session()->flash('error', "Code $id is not found!");
            return 'error';
 
        }


    }//END destroy



    public function showPriceList($id){

        if( request()->ajax() ){

            //will return pk_stores concatenated as string
            //1000,1002,1003
            $strStores = Product::getAssignedStoresAsString();

            $pricelist = Product::getItemPriceListPerStore($id, $strStores);

            return $pricelist;

        }


    }//END showPriceList



    public function updatePriceList(Request $request, $id){

        if( request()->ajax() ){

            $products = Product::findOrFail($id);

            $params = $request->params;

            //return $params;

            if( $products ){

                
                //begin transaction
                $transaction = DB::transaction(function() use($products, $params) {

                    foreach ($params as $key => $v) {

                        //delete older prices
                        ProductsPrice::where('fk_products', '=', $products->pk_products)
                                ->where('fk_stores', '=', $v['pk_stores'])
                                ->delete();
                        
                        $data = [
                            'fk_products'=> $products->pk_products,
                            'fk_stores'=> $v['pk_stores'],
                            'price'=> $v['priceadj'],
                            'oldprice'=> $v['price'],
                            'discount'=> $v['discountadj'],
                            'olddiscount'=> $v['discount'],
                            'fk_createdby'=> Auth::id()
                        ];

                        ProductsPrice::create($data);

                        //store prices history
                        ProductPricesHistory::create($data);

                    }//END foreach

                    $name = $products->name;
                    
                    session()->flash('success', "price of $name has been updated!");
                    return 'success';

                });//END transaction

                return $transaction;
           
            }   
            else{
                session()->flash('error', "Code $id is not found!");
                return 'error';
     
            }//END if $products
             

        }//END ajax()


    }//END updatePriceList


    public function showQtyList($id){

        if( request()->ajax() ){

            //will return pk_stores concatenated as string
            //1000,1002,1003
            $strStores = Product::getAssignedStoresAsString();

            $qtylist = Product::getItemQtyListPerStore($id, $strStores);

            $type = Product::where('pk_products', '=', $id)->pluck('type');// validation for service type. qty is not applicable

            return ['type'=> $type, 'qtylist'=> $qtylist];

        }


    }//END showQtyList


    public function updateQtyList(Request $request, $id){

        if( request()->ajax() ){

            $products = Product::findOrFail($id);

            $params = $request->params;

            //return $params;

            if( $products ){

                
                //begin transaction
                $transaction = DB::transaction(function() use($products, $params) {

                    foreach ($params as $key => $v) {
                        
                        ProductsQty::create([
                            'fk_products'=> $products->pk_products,
                            'fk_stores'=> $v['pk_stores'],
                            'qty'=> $v['qtyadj'],
                            'oldqty'=> $v['qty'],
                            'fk_createdby'=> Auth::id(),
                            'remarks'=> $v['qtyremarks']
                        ]);

                    }//END foreach

                    $name = $products->name;
                    
                    session()->flash('success', "qty of $name has been updated!");
                    return 'success';

                });//END transaction

                return $transaction;
           
            }   
            else{
                session()->flash('error', "Code $id is not found!");
                return 'error';
     
            }//END if $products
             

        }//END ajax()


    }//END updateQtyList



    public function showVisibility($id){

        if( request()->ajax() ){

            //will return pk_stores concatenated as string
            //1000,1002,1003
            $strStores = Product::getAssignedStoresAsString();

            $visibility = Product::getItemVisibilityPerStore($id, $strStores);

            return $visibility;

        }


    }//END showVisibility


    public function updateVisibility(Request $request, $id){

        if( request()->ajax() ){

            $products = Product::findOrFail($id);

            $params = $request->params;

            //return $params;

            if( $products ){

                
                //begin transaction
                $transaction = DB::transaction(function() use($products, $params) {

                   
                    foreach ($params as $key => $v) {

                        //delete older visibility
                        ProductsStore::where('fk_products', '=', $products->pk_products)
                            ->where('fk_stores', '=', $v['pk_stores'])
                            ->delete();

                        
                        //insert only selected
                        if( $v['selected'] ){

                            ProductsStore::create([
                                'fk_products'=> $products->pk_products,
                                'fk_stores'=> $v['pk_stores']
                            ]);

                        }//END if selected

                       

                    }//END foreach

                    $name = $products->name;
                    
                    session()->flash('success', "visibility of $name has been updated!");
                    return 'success';

                });//END transaction

                return $transaction;
           
            }   
            else{
                session()->flash('error', "Code $id is not found!");
                return 'error';
     
            }//END if $products
             

        }//END ajax()


    }//END updateVisibility




}//END class
