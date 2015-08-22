<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToPlanDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_dates', function (Blueprint $table) {
            $table->foreign('plan_workout_id')
                  ->references('id')
                  ->on('plan_workouts')
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
        Schema::table('plan_dates', function (Blueprint $table) {
            $table->dropForeign(['plan_workout_id']);
        });
    }
}
