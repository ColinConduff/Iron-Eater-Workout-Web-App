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
        Schema::table('planDates', function (Blueprint $table) {
            $table->foreign('planWorkout_id')
                  ->references('id')
                  ->on('planWorkouts')
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
        Schema::table('planDates', function (Blueprint $table) {
            $table->dropForeign(['planWorkout_id']);
        });
    }
}
