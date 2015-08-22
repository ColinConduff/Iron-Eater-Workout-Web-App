<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_exercise_id')->unsigned();
            $table->integer('expected_reps')->unsigned();
            $table->integer('expected_weight')->unsigned();
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
        Schema::drop('plan_sets');
    }
}
