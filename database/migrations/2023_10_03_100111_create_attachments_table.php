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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('att_id');
            $table->unsignedBigInteger('task_id');
            $table->string('file_name');
            $table->timestamps();

            //define a foreign key id of tasks table
            $table->foreign('task_id')
            ->references('task_id') //the task_id is the task_id of task given attachment
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
        Schema::dropIfExists('attachments');
    }
};
