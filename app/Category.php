<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $table = 'categories';
    protected $primaryKey = 'pk_categories';

    protected $fillable = ['description', 'type', 'fk_createdby', 'fk_updatedby', 'stat'];


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
            	'id'=> 'type',
            	'name'=> 'type', 
            	'desc'=> 'Type', 
            	'val'=>	'products', 
            	'type'=> 'select',
            	'required'  => 'required',
                'option'	=> [
                	['value'=>'products', 'description'=>'Products'],
                	['value'=>'expense', 'description'=>'Expense'],
                ]
            	
            ],

            [
            	'id'=> 'stat',
            	'name'=> 'stat', 
            	'desc'=> 'isActive', 
            	'val'=>1, 
            	'type'=> 'checkbox',
            ],
        ];

    }//END form_fields



    public static function getActiveCategoriesByType($type){

        return Category::where('type', '=', $type)
            ->where('stat', 1)
            ->orderBy('description', 'asc')->get();

    }//END getActiveCategoriesByType

}//END class
