<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    //
    public function author () 

    {
        return $this->hasOne('App\Author');
    }
}
