<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeKPISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_k_p_i_s', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->bigInteger('kpi_id');
            $table->integer('rate');
            $table->date('KPI-date');
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
        Schema::dropIfExists('employee_k_p_i_s');
    }
}
