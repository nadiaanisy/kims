<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentxmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentxmodules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentid');
            $table->foreign('studentid')->references('id')->on('students');
            $table->unsignedInteger('modid');
            $table->foreign('modid')->references('id')->on('modules');
            $table->string('smgroup');
            $table->string('smsession');
            $table->string('smyear');
            $table->timestamp('time')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('studentxmodules');
    }
}
