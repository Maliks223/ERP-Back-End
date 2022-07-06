<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
                $table->string('firstname');
                $table->string('lastname');
                $table->integer('phonenumber')->default(0);
                $table->string('email');
                $table->string('image')->nullable(); 
                // $table->integ('team_id');
            $table->timestamps();
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade')->nullable(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
