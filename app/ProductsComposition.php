<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB; //responsible for DB


class ProductsComposition extends Model
{
    //

    protected $table = 'productscomposition';

    protected $fillable = [ 'fk_products', 'fk_compositions',  'qty', 'fk_createdby', 'fk_updatedby' ];


    public static function getItemCompositions($id){

    	return DB::SELECT("

    		SELECT a.fk_compositions, a.qty, b.name, b.cost, b.uom
			FROM productscomposition a 
			INNER JOIN products b 
			ON a.fk_compositions = b.pk_products 
			WHERE  b.stat = 1
			AND a.fk_products = '$id'
			ORDER BY b.name ASC;

    	");

    }//END getItemCompositions

}
