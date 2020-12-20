<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    //

    protected $table = 'userstores';

    protected $fillable = [ 'fk_users', 'fk_stores', 'fk_createdby', 'fk_updatedby' ];

}
