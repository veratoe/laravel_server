<?php

namespace App\Http\Controllers;

use App\Script;
use App\Thread;
use Illuminate\Http\Request;
use Log;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($threadId)
    {
        //
        return Thread::find($threadId)->scripts()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $threadId)
    {
        //
        $script = new Script([
            'active' => true,
            'runs_left' => 10,
        ]);

        $thread = Thread::find($threadId);
        $thread->scripts()->save($script);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function show(Script $script)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function edit(Script $script)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $threadId, $scriptId)
    {
        //
        $script = Script::find($scriptId);
        $script->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function destroy(Script $script)
    {
        //
    }
}
