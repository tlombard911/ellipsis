<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__position', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->bigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->string('position')->nullable();
            $table->boolean('can_act');
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
        Schema::dropIfExists('employee__position');
    }
}
