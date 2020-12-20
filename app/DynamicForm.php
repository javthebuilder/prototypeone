<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    //

    //return custom fields to be populated @the form base on what kind of form
    //$obj = if form equals edit/show then $obj equals to the record of the selected $id 
    //$request = current form request submitted by the view
    //$elements = dynamic form elements depending on the controller
    public static function form_fields($form, $obj = [], $request = null, $elements = []){

    	$result = [];

        //dd($obj);

        //when editing form we have to make sure that we found the obj to be edited or else return empty arrays
        //commented since this will only be called of findOrFail returns a record
        //if( count($obj)<=0 && ( $form=='edit' || $form=='show'  ){
        //	return [ 'form'=>$result ];
        //}

        if( $form == 'edit' || $form == 'show' || $form == 'update' ){

        	//initialize value based on the query object
        	$i=0;
        	foreach($elements as $e){

        		//attributes will only be available in eloquent with only one record
        		$actualObj = ( isset($obj->attributes) ) ? $obj->attributes : [];

        		//laravel model attributes means getting the actual value of the object from Model::find(id)
        		foreach( $actualObj as $key => $val ){

        			//compare name and key then set specific value
        			//ex. key = name or name = 'Store name'
        			if( $elements[$i]['name'] == $key ){

        				$elements[$i]['val'] = $val;

        			}

        		}//END foreach $obj->attributes

        		$i++;

        	}//END foreach $elements

        	//dd($obj->attributes);
        	//dd($elements);

        }else if( $form == 'store' ){

        	//initialize value base on submitted request

        	$i=0;
        	foreach($elements as $e){

        		foreach( $request->all() as $key => $val ){

        			//compare name and key then set specific value
        			//ex. key = name or name = 'Store name'
        			if( $elements[$i]['name'] == $key ){

        				$elements[$i]['val'] = $val;

        			}
        			

        		}//END foreach $request->all()

        		$i++;

        	}//END foreach $elements

        	//dd($elements);

        }//END else if


        //configure input form to be populated @view form
        $i = 0;
        foreach($elements as $e){

        	$result[$i] = [

        		'divID'=> 'div'.$e['name'],

        		'id'=> 	$e['id'],

        		'type'=> $e['type'],

        		'name'=> $e['name'],

        		'value'=> $e['val'],

        		'description'=> (isset($e['desc'])) ? $e['desc'] : '',

        		'option'=> (isset($e['option'])) ? $e['option'] : [],

        		'maxlength'=> (isset($e['maxlength'])) ? "maxlength=".$e['maxlength'] : '',

        		'required'=> (isset($e['required'])) ? "required" : '',

        		'min'=> (isset($e['min'])) ? "min=".$e['min'] : '',

        		'max'=> (isset($e['max'])) ? "max=".$e['max'] : '',

        		'step'=> (isset($e['step'])) ? "step=".$e['step'] : '',

        		'placeholder'=> (isset($e['placeholder'])) ? $e['placeholder'] : '',

        	];

        	$i++;

        }//END foreach
  
        return [ 'form'=>$result ];

    }//END function form_fields


}//END class
