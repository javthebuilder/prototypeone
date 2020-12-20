<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

class Product extends Model
{
    //


   	protected $table = 'products';
    protected $primaryKey = 'pk_products';

    protected $fillable = ['barcode', 'type', 'name', 'fk_categories', 'fk_supplier', 'cost', 'tax', 'uom', 'alertqty', 'pictx', 'background', 'remarks', 'fk_createdby', 'fk_updatedby', 'stat', 'sku'];


    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [

    		[
            	'id'=> 'type',
            	'name'=> 'type', 
            	'desc'=> 'Type', 
            	'val'=>	'inventory', 
            	'type'=> 'select',
            	'required'  => 'required',
                'option'	=> [
                	['value'=>'inventory', 'description'=>'Inventory'],
                	['value'=>'service', 'description'=>'Service'],
                ]
            	
            ],

    		[
            	'id'=> 'barcode',
            	'name'=> 'barcode', 
            	'desc'=> 'Barcode ID', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            ],

            [
                'id'=> 'sku',
                'name'=> 'sku', 
                'desc'=> 'Product SKU', 
                'val'=> null, 
                'type'=> 'text',
                'maxlength'=> 255,
            ],
            
        
    		[
            	'id'=> 'name',
            	'name'=> 'name', 
            	'desc'=> 'Product Name', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'fk_categories',
            	'name'=> 'fk_categories', 
            	'desc'=> 'Category', 
            	'val'=>	null, 
            	'type'=> 'select',
            	'required'=> 'required',
                'option'	=> [
                	//dynamic @form populated
                ]
            	
            ],

            [
            	'id'=> 'fk_supplier',
            	'name'=> 'fk_supplier', 
            	'desc'=> 'Supplier', 
            	'val'=>	-1, 
            	'type'=> 'select',
                'option'	=> [
                	//dynamic @form populated
                ]
            	
            ],


            [
            	'id'=> 'cost',
            	'name'=> 'cost', 
            	'desc'=> 'Unit Cost', 
            	'val'=>	0, 
            	'type'=> 'number',
            	'min'=> 0,
            	'step'=> '0.01',
            ],


            [
            	'id'=> 'tax',
            	'name'=> 'tax', 
            	'desc'=> 'Tax Method', 
            	'val'=>	null, 
            	'type'=> 'select',
            	'maxlength'=> 3,
                'option'	=> [
                	['value'=>'inc', 'description'=>'Inclusive'],
                	['value'=>'exc', 'description'=>'Exclusive'],
                ]
            	
            ],


            [
            	'id'=> 'uom',
            	'name'=> 'uom', 
            	'desc'=> 'Unit', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 15,
            ],


            [
            	'id'=> 'alertqty',
            	'name'=> 'alertqty', 
            	'desc'=> 'Alert Qty', 
            	'val'=>	0, 
            	'type'=> 'number',
            	'min'=> 0,
            	'step'=> '0.01',
            ],

           
            [
            	'id'=> 'pictx',
            	'name'=> 'pictx', 
            	'desc'=> 'Product Logo', 
            	'val'=>	null, 
            	'type'=> 'file',
            	'placeholder'=> 'Accepted files(images|jpg,jpeg,png) Max size:500kb'
            ],

            /*[
            	'id'=> 'background',
            	'name'=> 'background', 
            	'desc'=> 'Background Color', 
            	'val'=>	'grey', 
            	'type'=> 'select',
            	'maxlength'=> 10,
                'option'	=> [
                    //['value'=>'', 'description'=>'No Background'],
                	['value'=>'grey', 'description'=>'Grey'],
                	['value'=>'purple', 'description'=>'Purple'],
                	['value'=>'green', 'description'=>'Green'],
                	['value'=>'blue', 'description'=>'Blue'],
                ]
            	
            ],*/

         	[
            	'id'=> 'remarks',
            	'name'=> 'remarks', 
            	'desc'=> 'Product Remarks', 
            	'val'=>	null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,
            ],

            [
            	'id'=> 'stat',
            	'name'=> 'stat', 
            	'desc'=> 'isActive', 
            	'val'=>1, 
            	'type'=> 'checkbox',
            ],


        ];

    }//EMD form_fields


    //return pk_products as concatenated string 
    //to use in query parameters as IN ()
    //will return pk_products concatenated as string
    //1000,1002,1003
    public static function getProductIDAsString($products){

    	 //NOTE: retrieve pk_products, pluck returns array with keys
        $arrID = $products->pluck('pk_products');   

        //manually convert array with keys to a normal array so that implode function will work
        $tempArr = []; $i=0;
        foreach ($arrID as $key => $value) {
            $tempArr[$i++] = $value;
        }
        $strProducts = implode(',', $tempArr); //arr to string
        //if empty string, set default to -1 to avoid sql syntax error
        $strProducts = ( $strProducts != '' ) ? $strProducts : '-1';

        return $strProducts;

    }//END getProductIDAsString




    //return pk_stores as concatenated string 
    //to use in query parameters as IN ()
    //will return pk_stores concatenated as string
    //1000,1002,1003
    public static function getAssignedStoresAsString(){

    	//get assigned stores on current login user
        $sessionID = Auth::id();

        $arrID = DB::select("CALL usp_getAssignedStores($sessionID)");

        //manually convert arry with keys to a normal array so that implode function will work
        $tempArr = []; $i=0;
        foreach ($arrID as $key => $value) {
            $tempArr[$i++] = $value->pk_stores;
        }
        $strStores =  implode(',', $tempArr); //arr to string
        //if empty string, set default to -1 to avoid sql syntax error
        $strStores = ( $strStores != '' ) ? $strStores : '-1';

        return $strStores;

    }//END getAssignedStoresAsString



    //$strProducts = 1000,1001,1002
    //strStores = 1000, 1001, 1002
    public static function getItemPriceListPerStore($strProducts = '-1', $strStores = '-1' ){

    	//price = current price 
    	//priceadj = newly adjusted price
    	//display only product prices on assigned stores
        return DB::select("
                SELECT a.fk_products, b.name as storename, b.pk_stores, 
                coalesce(a.price,0) as price, coalesce(a.price,0) as priceadj,
                coalesce(a.discount,0) as discount, coalesce(a.discount,0) as discountadj
                FROM productsprices a 
                RIGHT JOIN stores b 
                ON a.fk_stores = b.pk_stores AND a.fk_products IN ($strProducts)
                WHERE b.stat = 1 
                AND b.pk_stores IN ($strStores)
                ORDER BY b.name ASC
        ");

    }//END getItemPriceListPerStore



    //$strProducts = 1000,1001,1002
    //strStores = 1000, 1001, 1002
    public static function getItemQtyListPerStore($strProducts = '-1', $strStores = '-1'){

    	//qty = current qty 
    	//qtyadj = newly adjusted qty
    	return  DB::select("
                SELECT a.fk_products, b.name as storename, b.pk_stores, 
                udf_getLastQtyAdj(a.fk_products, b.pk_stores )
                - udf_getLastQtySales(a.fk_products, b.pk_stores)
                - udf_getLastQtySalesCompositions(a.fk_products, b.pk_stores)
                as qty, 
                0 as qtyadj, 
                IF(c.uom IS NULL, '', c.uom) AS uom,
                a.remarks as qtyremarks
                FROM productsqty a 
                RIGHT JOIN stores b 
                ON a.fk_stores = b.pk_stores AND a.fk_products IN ($strProducts)
                LEFT JOIN products c 
                ON a.fk_products = c.pk_products
                WHERE b.stat = 1 
                AND b.pk_stores IN ($strStores)
                GROUP BY a.fk_products, b.pk_stores, b.name, c.uom
        ");

    }//END getItemQtyListPerStore


    //$strProducts = 1000,1001,1002
    //strStores = 1000, 1001, 1002
    public static function getItemVisibilityPerStore($strProducts = '-1', $strStores = '-1'){

    	return DB::select("
                SELECT a.fk_products, b.name as storename, b.pk_stores, 
                IF(a.fk_products IS NULL, '0', '1') AS 'selected'
                FROM productsstore a 
                RIGHT JOIN stores b 
                ON a.fk_stores = b.pk_stores AND a.fk_products IN ($strProducts)
                WHERE b.stat = 1 
                AND b.pk_stores IN ($strStores)
                ORDER BY b.name ASC
        ");


    }//END getItemVisibilityPerStore



}//END class
