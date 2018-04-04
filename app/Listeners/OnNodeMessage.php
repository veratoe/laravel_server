<?php

namespace App\Listeners;

use App\Events\NodeMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Comment;
use Log;

class OnNodeMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NodeMessage  $event
     * @return void
     */
    public function handle(NodeMessage $event)
    {
        //
        $m = json_decode($event->message);
        if (isset($m->output)) {
            Comment::create([
                'user_id' => rand(1, 100),
                'thread_id' => $m->comment->thread_id,
                'content' => $m->output
            ]);
        }
    }
}
