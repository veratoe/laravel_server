<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScriptThreadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('script_thread', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->unsignedInteger('script_id');
            $table->unsignedInteger('thread_id');
        });

        Schema::table('script_thread', function (Blueprint $table) {
            $table->foreign('script_id')->references('id')->on('scripts')->onDelete('cascade');
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('script_thread');
    }
}
