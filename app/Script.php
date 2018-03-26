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
            'last_run_time' => null
    );

    public function run($comment)
    {
        $script_id = $this->id;
        Redis::set('payload', json_encode(array('script'=> $this, 'comment' => $comment)));
        exec('node run_script.js', $output);
        Log::debug($output);
    }



}
