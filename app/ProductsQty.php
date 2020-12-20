<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsQty extends Model
{
    //

    protected $table = 'productsqty';

    protected $fillable = [ 'fk_products', 'fk_stores', 'qty', 'oldqty', 'fk_createdby', 'fk_updatedby', 'remarks' ];

}
