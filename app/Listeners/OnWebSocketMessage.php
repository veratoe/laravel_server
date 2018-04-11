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
        //
        $m = $event->message;
        switch($m) {

            case "FETCH_THREADS":
                Redis::publish('websocket-out', json_encode(array( "type" => "RECEIVE_THREADS", "payload" => Thread::all())));
                break;

        }
    }
}
