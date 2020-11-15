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
            $table->bigInteger('id')->primary();
            $table->string('name_last');
            $table->string('name_first');
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->string('shift')->nullable();
            $table->string('status');
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
        //Drop employee__positions table first, becuase of Foreign Key Constrant
        Schema::dropIfExists('employee__position');
        Schema::dropIfExists('employees');
    }
}
