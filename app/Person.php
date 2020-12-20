<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //


   	protected $table = 'persons';
    protected $primaryKey = 'pk_persons';

    protected $fillable = ['fullname', 'email', 'contact', 'address', 'tinno', 'remarks', 'iscustomer', 'issupplier', 'fk_createdby', 'fk_updatedby', 'stat'];



    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [
    		[
            	'id'=> 'fullname',
            	'name'=> 'fullname', 
            	'desc'=> 'Fullname', 
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

            ],

            [
            	'id'=> 'contact',
            	'name'=> 'contact', 
            	'desc'=> 'Contact No.', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            ],

            [
            	'id'=> 'address',
            	'name'=> 'address', 
            	'desc'=> 'Address', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            ],

            [
            	'id'=> 'tinno',
            	'name'=> 'tinno', 
            	'desc'=> 'TIN', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            ],


         	[
            	'id'=> 'remarks',
            	'name'=> 'remarks', 
            	'desc'=> 'Remarks', 
            	'val'=>	null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,

            ],

   

            [
            	'id'=> 'iscustomer',
            	'name'=> 'iscustomer', 
            	'desc'=> 'isCustomer', 
            	'val'=>1, 
            	'type'=> 'checkbox',
            ],

            [
            	'id'=> 'issupplier',
            	'name'=> 'issupplier', 
            	'desc'=> 'isSupplier', 
            	'val'=>0, 
            	'type'=> 'checkbox',
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


}//END class
