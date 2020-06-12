<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulexstaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulexstaff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staffid');
            $table->foreign('staffid')->references('id')->on('staff');
            $table->unsignedInteger('modid');
            $table->foreign('modid')->references('id')->on('modules');
            $table->integer('msgroup');
            $table->string('msyear');
            $table->date('msdate');
            $table->unsignedInteger('msplace');
            $table->foreign('msplace')->references('id')->on('tempat');
            
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
        Schema::dropIfExists('modulexstaff');
    }
}
