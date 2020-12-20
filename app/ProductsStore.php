<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsStore extends Model
{
    //

    protected $table = 'productsstore';

    protected $fillable = [ 'fk_products', 'fk_stores', 'fk_createdby', 'fk_updatedby' ];

}
