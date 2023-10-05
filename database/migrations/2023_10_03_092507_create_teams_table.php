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
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('team_id');
            $table->string('teamName');
            $table->text('descriptions');
            $table->unsignedBigInteger('manager_id');
            $table->timestamps();

            $table->foreign('manager_id')
            ->references('user_id') //the user id is the user id with role as manager to control a certain team or department
            ->on('users')
            ->onDelete('CASCADE') // Define cascading on delete
            ->onUpdate('CASCADE'); // Define cascading on update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
