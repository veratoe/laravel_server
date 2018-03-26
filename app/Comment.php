<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Comment extends Model
{

    protected $fillable = ['content', 'use_id', 'thread_id', 'type'];

    public static function boot()
    {

        self::creating(function($comment) {
            $thread = $comment->thread;
            $scripts = $thread->scripts;
            foreach($scripts as $script) {
                $script->run($comment);
            }
        });

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
