<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //

   	protected $table = 'discounts';
    protected $primaryKey = 'pk_discounts';

    protected $fillable = ['description', 'rate', 'fk_createdby', 'fk_updatedby', 'stat'];


    //to be used in DynamicForm creation
    public static function form_fields(){

    	return [
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
            	'id'=> 'rate',
            	'name'=> 'rate', 
            	'desc'=> 'Discount Rate', 
            	'val'=>	null, 
            	'type'=> 'number',
            	'min'=> 0,
            	'max'=> 100,
            	'step'=> '0.01',
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

    }//EMD form_fields

}//END class
