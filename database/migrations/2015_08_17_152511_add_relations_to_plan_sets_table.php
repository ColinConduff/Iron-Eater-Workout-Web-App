<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToPlanSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_sets', function (Blueprint $table) {
            $table->foreign('plan_exercise_id')
                  ->references('id')
                  ->on('plan_exercises')
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
        Schema::table('plan_sets', function (Blueprint $table) {
            $table->dropForeign(['plan_exercise_id']);
        });
    }
}

