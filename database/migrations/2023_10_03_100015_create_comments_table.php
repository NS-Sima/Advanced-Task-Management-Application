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
        Schema::create('comments', function (Blueprint $table) { //this table take all comments from users,admins or managers on specific task
            $table->bigIncrements('comm_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->text('comment');
            $table->timestamps();

            //define a foreign key id of users table
            $table->foreign('user_id')
            ->references('user_id') //the user_id is the user_id for user given a comment
            ->on('users')
            ->onDelete('CASCADE') // Define cascading on delete
            ->onUpdate('CASCADE'); // Define cascading on update

            //define a foreign key id of tasks table
            $table->foreign('task_id')
            ->references('task_id') //the task_id is the task_id of task being collaborated on comments or attachment
            ->on('tasks')
            ->onDelete('CASCADE') // Define cascading on delete
            ->onUpdate('CASCADE'); // Define cascading on update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
