<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesMstr extends Model
{
    //
    protected $table = 'salesmstr';
    protected $primaryKey = 'pk_salesmstr';

    protected $fillable = ['fk_stores', 'docdate', 'docno', 'doctype', 'fk_trxno', 'fk_discounts', 'discrate', 'fk_persons', 'payername', 'remarks', 'totalitem', 'totalqty', 'totalamount', 'totaldisc', 'netamount', 'companyvat', 'vatexcempt', 'zerorated', 'vatable', 'vatamount', 'totalpayment', 'changeamount', 'fk_createdby', 'fk_updatedby', 'iscancel', 'cancel_at', 'fk_cancelby', 'cancelremarks', 'stat'];

     
}
