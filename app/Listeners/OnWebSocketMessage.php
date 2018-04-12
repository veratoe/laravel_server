<?php

namespace App\Listeners;

use App\Events\WebSocketMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Thread;
use Redis;
use Log;

class OnWebSocketMessage
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
     * @param  WebSocketMessage  $event
     * @return void
     */
    public function handle(WebSocketMessage $event)
    {

        $message = $event->message;

        echo $message . "\n";

        if (strpos($message, config('actions.fetchThreads')) !== false) {
            Redis::publish('websocket-out', json_encode([
                "type" => config('actions.receiveThreads'), 
                "payload" => Thread::all()]));

        } else if (strpos($message, config('actions.fetchThreadComments')) !== false) {
            $threadId = preg_replace('/\D/', '', $message);
            Redis::publish('websocket-out', json_encode([
                "type" => config('actions.receiveThreadComments'),
                "payload" => [
                    'threadId' => $threadId, 
                    'comments' => Thread::find($threadId)->comments()->get()
                ]
            ]));
        }
    }
}
