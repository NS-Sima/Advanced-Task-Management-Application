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
        Schema::create('user_teams', function (Blueprint $table) {
            $table->bigIncrements('userTeam_id'); //specify users to their specific team
            $table->unsignedBigInteger('user_id'); //foreign key from users
            $table->unsignedBigInteger('team_id'); //foreign key from teams
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')
            ->on('users')->onDelete('CASCADE')
            ->onUpdate('CASCADE'); //Establishing their relationship on users table

            $table->foreign('team_id')->references('team_id')
            ->on('teams')->onDelete('CASCADE')
            ->onUpdate('CASCADE'); //Establishing their relationship on teams table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_teams');
    }
};
