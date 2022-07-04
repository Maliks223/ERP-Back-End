<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Team_id')->unsigned();
            $table->foreign('Team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->bigInteger('Project_id')->unsigned();
            $table->foreign('Project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_projects');
    }
}
