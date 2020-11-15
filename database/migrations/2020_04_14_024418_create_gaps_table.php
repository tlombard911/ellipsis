<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaps', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('requirement_id');
            $table->foreign('requirement_id')->references('id')->on('requirements');
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
        Schema::dropIfExists('gaps');
    }
}
