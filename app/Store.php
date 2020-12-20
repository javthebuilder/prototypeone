<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB; //responsible for DB

class Store extends Model
{
    //

	protected $table = 'stores';
    protected $primaryKey = 'pk_stores';

    protected $fillable = ['name', 'description', 'email', 'phone', 'address', 'tinno', 'receiptfooter', 'fk_createdby', 'fk_updatedby', 'stat'];

    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [
            [
            	'id'=> 'name',
            	'name'=> 'name', 
            	'desc'=> 'Store name', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [	
            	'id'=> 'description',
            	'name'=> 'description', 
            	'desc'=> 'Store description', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [
            	'id'=> 'email',
            	'name'=> 'email', 
            	'desc'=> 'Email', 
            	'val'=>	null, 
            	'type'=> 'email',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [
            	'id'=> 'phone',
            	'name'=> 'phone', 
            	'desc'=> 'Contact No.', 
            	'val'=>null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [
            	'id'=> 'address',
            	'name'=> 'address', 
            	'desc'=> 'Address', 
            	'val'=>null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [
                'id'=> 'tinno',
                'name'=> 'tinno', 
                'desc'=> 'tinno', 
                'val'=>null, 
                'type'=> 'text',
                'maxlength'=> 255,
            ],
            [
            	'id'=> 'receiptfooter',
            	'name'=> 'receiptfooter', 
            	'desc'=> 'Receipt Footer', 
            	'val'=>null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],
            [
            	'id'=> 'stat',
            	'name'=> 'stat', 
            	'desc'=> 'isActive', 
            	'val'=>1, 
            	'type'=> 'checkbox',
            ],
        ];

    }


    //display assigned stores to specified user via stored procedure
    public static function getAssignedStores($user_id){

    	return DB::select("call usp_getAssignedStores($user_id);");

    }


   
}
