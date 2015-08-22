<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToPlanExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_exercises', function (Blueprint $table) {
            $table->foreign('plan_workout_id')
                  ->references('id')
                  ->on('plan_workouts')
                  ->onDelete('cascade');

            $table->foreign('exercise_id')
                  ->references('id')
                  ->on('exercises')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_exercises', function (Blueprint $table) {
            $table->dropForeign(['plan_workout_id']);
            $table->dropForeign(['exercise_id']);
        });
    }
}
