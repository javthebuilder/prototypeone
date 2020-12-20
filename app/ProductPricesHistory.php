<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPricesHistory extends Model
{
    //

    protected $table = 'products_prices_history';

    protected $fillable = [ 'fk_products', 'fk_stores', 'price', 'oldprice', 'discount', 'olddiscount', 'fk_createdby', 'fk_updatedby' ];

}
