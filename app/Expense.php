<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{


   	protected $table = 'expense';
    protected $primaryKey = 'pk_expense';

    protected $fillable = ['docdate', 'docno', 'fk_categories', 'fk_stores',  'amount', 'remarks', 'attachment', 'fk_createdby', 'fk_updatedby', 'stat'];

    //

    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [

    		[
            	'id'=> 'docdate',
            	'name'=> 'docdate', 
            	'desc'=> 'Document Date', 
            	'val'=>	date('Y-m-d'), //default date
            	'type'=> 'date',
            	'required'  => 'required',
            ],


    		[
            	'id'=> 'docno',
            	'name'=> 'docno', 
            	'desc'=> 'Reference No.', 
            	'val'=>	null, 
            	'type'=> 'text',
            	'required'  => 'required',
            	'maxlength'=> 255,
            ],




    		[
            	'id'=> 'fk_categories',
            	'name'=> 'fk_categories', 
            	'desc'=> 'Expense Category', 
            	'val'=>	null, 
            	'type'=> 'select',
            	'required'  => 'required',
                'option'	=> [
                	//populated @prerequisites
                ]
            	
            ],

            [
            	'id'=> 'fk_stores',
            	'name'=> 'fk_stores', 
            	'desc'=> 'Store', 
            	'val'=>	null, 
            	'type'=> 'select',
            	'required'  => 'required',
                'option'	=> [
                	//populated @prerequisites
                ]
            	
            ],

            [
            	'id'=> 'amount',
            	'name'=> 'amount', 
            	'desc'=> 'Amount', 
            	'val'=>	1, 
            	'type'=> 'number',
            	'min'=> 1,
            	'step'=> '0.01',
            	'required'  => 'required',
            ],


         	[
            	'id'=> 'remarks',
            	'name'=> 'remarks', 
            	'desc'=> 'Remarks', 
            	'val'=>	null, 
            	'type'=> 'textarea',
            	'maxlength'=> 255,
            	'required'  => 'required',
            ],


           
            [
            	'id'=> 'attachment',
            	'name'=> 'attachment', 
            	'desc'=> 'Attachment', 
            	'val'=>	null, 
            	'type'=> 'file',
            	'placeholder'=> 'Accepted files(images|pdf||doc|docx|xls|xlsx|zip) Max size:2Mb'
            ],


            //not applicable
            /*[
            	'id'=> 'stat',
            	'name'=> 'stat', 
            	'desc'=> 'isActive', 
            	'val'=>1, 
            	'type'=> 'checkbox',
            ],*/


        ];

    }//EMD form_fields


}//END class
