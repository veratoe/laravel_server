<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Comment extends Model
{

    protected $fillable = ['content', 'user_id', 'thread_id', 'type'];

    public static function boot()
    {

        self::creating(function($comment) {
            $thread = $comment->thread;
            $scripts = $thread->scripts;
            foreach($scripts as $script) {
                $script->run($comment);
            }
        });

        self::created(function($comment) {
            Redis::publish('websocket', json_encode(array('type' => 'CREATE_COMMENT', 'payload' => $comment)));
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
