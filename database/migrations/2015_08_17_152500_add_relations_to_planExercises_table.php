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
        Schema::table('planExercises', function (Blueprint $table) {
            $table->foreign('planWorkout_id')
                  ->references('id')
                  ->on('planWorkouts')
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
        Schema::table('planExercises', function (Blueprint $table) {
            $table->dropForeign(['planWorkout_id']);
            $table->dropForeign(['exercise_id']);
        });
    }
}
