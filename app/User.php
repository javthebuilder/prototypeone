<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB; //responsible for DB

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'usercode', 'password', 'pictx', 'fk_createdby', 'fk_updatedby', 'stat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    //to be used in DynamicForm creation
    public static function form_fields(){

        return [

            [
                'id'=> 'name',
                'name'=> 'name', 
                'desc'=> 'Fullname', 
                'val'=> null, 
                'type'=> 'text',
                'maxlength'=> 255,
                'required'=> 'required',
            ],

            [
                'id'=> 'usercode',
                'name'=> 'usercode', 
                'desc'=> 'Username', 
                'val'=> null, 
                'type'=> 'text',
                'maxlength'=> 25,
                'required'=> 'required',
            ],

            [
                'id'=> 'password',
                'name'=> 'password', 
                'desc'=> 'Password', 
                'val'=> null, 
                'type'=> 'password',
                'maxlength'=> 25,
                //required only in custom validation
            ],

            [
                'id'=> 'password_confirmation',
                'name'=> 'password_confirmation', 
                'desc'=> 'Repeat Password', 
                'val'=> null, 
                'type'=> 'password',
                'maxlength'=> 25,
                //required only in custom validation
            ],



            [
                'id'=> 'pictx',
                'name'=> 'pictx', 
                'desc'=> 'Avatar', 
                'val'=> null, 
                'type'=> 'file',
                'placeholder'=> 'Accepted files(images|jpg,jpeg,png) Max size:500kb'
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



    /**
        retrive user mainMenu
    */
    public static function getMainMenu($user_id){
        return DB::select("call usp_getMainMenu($user_id);");
    }


    /**
        retrieve user subMenu
    */
    public static function getSubMenu($user_id, $menu_group){
        return DB::select("call usp_getSubMenu($user_id, '$menu_group');");
    }//END getSubMenu



}
