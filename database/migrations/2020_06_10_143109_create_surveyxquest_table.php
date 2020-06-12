<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyxquestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveyxquest', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qid');
            $table->foreign('qid')->references('id')->on('questions');
            $table->unsignedInteger('surveyid');
            $table->foreign('surveyid')->references('id')->on('surveys');
            $table->string('view_status');
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
        Schema::dropIfExists('surveyxquest');
    }
}
