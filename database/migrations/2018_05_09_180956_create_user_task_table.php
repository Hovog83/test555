<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_task', function (Blueprint $table) {
             $table->increments('id');
             $table->unsignedInteger('user_id');
             $table->unsignedInteger('task_id');
             $table->timestamps();
             $table->foreign('user_id')->references('id')->on('users');
             $table->foreign('task_id')->references('id')->on('task');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_task');
    }
}
