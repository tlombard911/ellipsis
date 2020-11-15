<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credential_requirement', function (Blueprint $table) {
            $table->bigInteger('credential_id');
            $table->foreign('credential_id')->references('id')->on('credentials');
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
        Schema::dropIfExists('credential_requirement');
    }
}
