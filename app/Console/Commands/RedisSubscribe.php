<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

use App\Events\NodeMessage;
use App\Events\WebSocketMessage;
use Log;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to Redis channel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo("handle");

        $subscriber = Redis::connection('external');
        $subscriber->psubscribe(['*'], function ($message, $channel) {
            switch($channel) {
                case "node": event(new NodeMessage($message)); break;
                case "websocket-in": event(new WebSocketMessage($message)); break;
            }

            Log::debug($channel . ' => ' . $message);
        });

    }
}
