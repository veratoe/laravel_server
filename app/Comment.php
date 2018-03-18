<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'author_id', 'thread_id'];

    //

    public function author ()

    {
        return $this->belongsTo('App\Author');
    }
}
