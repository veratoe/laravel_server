<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use Redis;

class Script extends Model
{
    //
    protected $guarded = ['id'];

    protected $attributes = array(
            'name' => '',
            'code' => '',
            'error_message' => '',
            'last_run_time' => null,
            'runs_left' => 10
    );

    public function run($comment)
    {
        Log::debug($this->runs_left);
        if ($this->runs_left < 1) return;
        Redis::publish('node', json_encode(array('script'=> $this, 'comment' => $comment)));
        $this->decrement('runs_left');
    }



}
