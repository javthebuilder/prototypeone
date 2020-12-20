<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDtl extends Model
{
    //

    protected $table = 'salesdtls';
    
    protected $fillable = [ 'fk_salesmstr', 'fk_products', 'qty', 'uom', 'unitprice', 'unitcost','totalamount', 'discrate', 'discamount', 'netamount', 'vatable', 'vatamount' ];

}
