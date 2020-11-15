<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeCredential extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__credential', function (Blueprint $table) {
            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->bigInteger('credential_id');
            $table->foreign('credential_id')->references('id')->on('credentials');
            $table->date('date_expiration')->nullable()->nullable();
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
        Schema::dropIfExists('employee__credential');
    }
}
