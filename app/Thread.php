<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //
    //
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scripts()
    {
        return $this->belongsToMany('App\Script');
    }

}
