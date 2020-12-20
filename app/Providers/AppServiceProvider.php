<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //\URL::forceScheme("https");
        
        /*if( strpos(url()->current() , 'tercet') === false ){
            die();
        }*/
        
        //
        //dd(request()->path());
        //select main_menu
        view()->composer('layouts.master', function($view){

            $main_menu = User::getMainMenu(Auth::id());

            // $main_menu = [];
            
            //default active child menu 
            $active_child = '/'.request()->path();//compare to navigation url for active display

            $userID = Auth::id();

            // $storesobj = \App\Store::getAssignedStores(Auth::id());
            // $storesobj = [];

            /*$stores = [];
            foreach($storesobj as $key=> $v){
                $stores[]=$v->pk_stores;
            }*/

            //$stores = implode(',', $stores);
            
            // $criticalnotifications = \App\ProductsMstrView::getInventoryCriticalLevelAllStores();

            $criticalnotifications =  DB::select("
                SELECT distinct a.fk_storesvisibility, a.storename
                FROM vw_productsdtl a 
                WHERE ( a.fk_storesvisibility in (
                    SELECT x1.pk_stores
                    FROM stores x1
                    LEFT JOIN userstores x2
                    ON x1.`pk_stores` = x2.`fk_stores` AND x2.fk_users = $userID
                    WHERE  x1.stat = 1
                ) )
                AND a.stat = 1 
                AND a.qty <= a.alertqty
                AND a.type = 'inventory'
                LIMIT 5;
            ");
         
            //if( $limit > 0 ){

                /*$criticalnotifications =  DB::select("
                    SELECT a.fk_storesvisibility, a.storename
                    FROM vw_productsdtl a 
                    WHERE ( a.fk_storesvisibility in ($stores) )
                    -- AND ( a.fk_stores in ($stores) )
                    AND a.stat = 1 
                    AND a.qty <= a.alertqty
                    AND a.type = 'inventory'
                    GROUP BY a.fk_storesvisibility
                    ORDER BY a.storename ASC -- , a.name ASC
                ");*/

                // add limit to prevent sql server connection gone away
               /*$criticalnotifications =  DB::select("
                    SELECT distinct a.fk_storesvisibility, a.storename
                    FROM vw_productsdtl a 
                    WHERE ( a.fk_storesvisibility in ($stores) )
                    -- AND ( a.fk_stores in ($stores) )
                    AND a.stat = 1 
                    AND a.qty <= a.alertqty
                    AND a.type = 'inventory'
                    LIMIT $limit
                ");*/

            //}//END count($storesobj) > 0

            //dd($criticalnotifications);

           
            $view->with(compact('main_menu', 'active_child', 'criticalnotifications'));

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
