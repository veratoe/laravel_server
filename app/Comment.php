<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Comment extends Model
{

    protected $fillable = ['content', 'author_id', 'thread_id'];

    public static function boot()
    {

        self::creating(function($comment) {
            $thread = $comment->thread;
            $thread->title = "wub";
            $thread->save();

            $scripts = $thread->scripts;
            foreach($scripts as $script) {
                $script->run($comment);
            }
        });

    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
