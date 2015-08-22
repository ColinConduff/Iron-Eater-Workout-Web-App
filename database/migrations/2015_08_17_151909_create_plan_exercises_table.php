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
        Schema::create('plan_exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_workout_id')->unsigned();
            $table->integer('exercise_id')->unsigned();
            $table->integer('weight_to_add_for_success')->unsigned();
            $table->integer('weight_to_sub_for_fail')->unsigned();
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
        Schema::drop('plan_exercises');
    }
}
