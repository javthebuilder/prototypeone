<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    //
    protected $table = 'salespayments';
    protected $primaryKey = 'pk_salespayments';

    protected $fillable = ['fk_salesmstr', 'docdate', 'docno', 'mop', 'amount', 'cardno', 'cardholder', 'cardmonth', 'cardyear', 'cardcodecv', 'chequeno', 'payername', 'remarks', 'fk_createdby', 'fk_updatedby', 'iscancel', 'cancel_at', 'fk_cancelby', 'cancelremarks', ];

}
