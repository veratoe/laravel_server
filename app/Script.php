<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    //
    public function roles()

    {
        return $this->belongsToMany('App\Thread');
    }


}
