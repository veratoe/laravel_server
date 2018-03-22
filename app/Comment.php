<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['content', 'author_id', 'thread_id'];

    public static function boot()
    {

        self::created(function($comment) {
            $thread = $comment->thread();
            $thread->title = "wub";
            $thread->save();

        });

    }

    public function author ()
    {
        return $this->belongsTo('App\Author');
    }
}
