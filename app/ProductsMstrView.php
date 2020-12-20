<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB


class ProductsMstrView extends Model
{
    //

    protected $table = 'vw_productsmstr';
    protected $primaryKey = 'pk_products';


    public static function getInventoryCriticalLevel($fk_stores){

    	$result = DB::select("
            SELECT a.storename, a.pk_products, a.type, a.name, a.category, 
            a.supplier, a.qty, a.uom, a.alertqty
            FROM vw_productsdtl a 
            WHERE ( a.fk_storesvisibility = '$fk_stores'  or '$fk_stores' = 'All' )
            AND ( a.fk_stores = '$fk_stores' or '$fk_stores' = 'All' )
            AND a.stat = 1 
            AND a.qty <= a.alertqty
            AND a.type = 'inventory'
            GROUP BY a.fk_storesvisibility
            ORDER BY a.storename ASC, a.name ASC
        ");

        return $result;


    }

    public static function getInventoryCriticalLevelAllStores(){

        $userID = Auth::id();
        $limit = 5; // add limit to prevent mysql connection gone away
        return DB::select("CALL usp_getInventoryCriticalLevel($userID, $limit)");

    }

}//END class
