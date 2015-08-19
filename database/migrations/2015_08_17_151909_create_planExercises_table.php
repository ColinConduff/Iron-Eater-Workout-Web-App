<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planExercises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('planWorkout_id')->unsigned();
            $table->integer('exercise_id')->unsigned();
            $table->integer('weightToAddForSuccess')->unsigned();
            $table->integer('weightToSubForFail')->unsigned();
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
        Schema::drop('planExercises');
    }
}
