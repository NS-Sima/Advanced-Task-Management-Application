<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->string('title');
            $table->text('description');
            $table->string('priority');
            $table->integer('status')->default(0);
        //status left to default 0, it will be changed to diffenet status
        //0-todo Performed, 1-initialized,2-quartile,3-half,4-third-quartile,5-completed
            $table->string('due_date'); //date expected to be completed
            $table->unsignedBigInteger('user_id'); //if assigned user individually
            $table->unsignedBigInteger('team_id');     //if assigned to teams by manages or admins
            $table->timestamps();

            //define a foreign key id of users table
            $table->foreign('user_id')
            ->references('user_id') //the user_id is the user id assigned a task to do
            ->on('users')
            ->onDelete('CASCADE') // Define cascading on delete
            ->onUpdate('CASCADE'); // Define cascading on update

            //define a foreign key id of teams table
            $table->foreign('team_id')
            ->references('team_id') //the user_id is the user id assigned a task to do
            ->on('teams')
            ->onDelete('CASCADE') // Define cascading on delete
            ->onUpdate('CASCADE'); // Define cascading on update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
