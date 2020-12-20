<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    protected $table = 'company';
    protected $primaryKey = 'pk_company';

    protected $fillable = ['name', 'description', 'address', 'contact', 'email', 'owner', 'website', 'tinno', 'vat', 'pictx', 'receiptheader', 'receiptfooter', 'fk_createdby', 'fk_updatedby' ];


    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [
    		[
            	'id'=> 'name',
            	'name'=> 'name', 
            	'desc'=> 'Company Name', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'description',
            	'name'=> 'description', 
            	'desc'=> 'Description', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'address',
            	'name'=> 'address', 
            	'desc'=> 'Address', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'contact',
            	'name'=> 'contact', 
            	'desc'=> 'Contact No.', 
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
            	'id'=> 'owner',
            	'name'=> 'owner', 
            	'desc'=> 'Owner', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'website',
            	'name'=> 'website', 
            	'desc'=> 'Website', 
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
            	'id'=> 'vat',
            	'name'=> 'vat', 
            	'desc'=> 'Default Tax', 
            	'val'=>	null, 
            	'type'=> 'number',
            	'min'=> 0,
            	'max'=> 100,
            	'step'=> '0.01',
            	'required'=> 'required',
            ],

            [
            	'id'=> 'pictx',
            	'name'=> 'pictx', 
            	'desc'=> 'Company Logo', 
            	'val'=>	null, 
            	'type'=> 'file',
            	'maxlength'=> 255,
            	'placeholder'=> 'Accepted files(images|jpg,jpeg,png) Max size:500kb'
            ],

         	[
            	'id'=> 'receiptheader',
            	'name'=> 'receiptheader', 
            	'desc'=> 'Default Receipt Header', 
            	'val'=>	null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

            [
            	'id'=> 'receiptfooter',
            	'name'=> 'receiptfooter', 
            	'desc'=> 'Default Receipt Footer', 
            	'val'=>	null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,
            	'required'=> 'required',
            ],

        ];

    }//EMD form_fields


}//END class
