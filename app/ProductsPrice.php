<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsPrice extends Model
{
    //

    protected $table = 'productsprices';

    protected $fillable = [ 'fk_products', 'fk_stores', 'price', 'oldprice', 'discount', 'olddiscount', 'fk_createdby', 'fk_updatedby' ];

}
