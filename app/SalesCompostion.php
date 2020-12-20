<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCompostion extends Model
{
    //

    protected $table = 'salescompositions';

    public $timestamps = true;

    protected $fillable = [ 'fk_salesmstr',  'fk_products', 'fk_compositions',  'qty', 'uom', 'unitcost' ];



}
