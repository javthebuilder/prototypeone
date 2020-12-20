<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    //
	protected $table = 'useraccess';

    protected $fillable = [ 'fk_users', 'fk_permalink', 'fk_createdby', 'fk_updatedby' ];

}
