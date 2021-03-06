<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ranswer');
            $table->string('studentid');
            $table->foreign('studentid')->references('id')->on('students');
            $table->unsignedInteger('modid');
            $table->foreign('modid')->references('id')->on('modules');
            $table->unsignedInteger('sqid');
            $table->foreign('sqid')->references('id')->on('surveyxquest');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
