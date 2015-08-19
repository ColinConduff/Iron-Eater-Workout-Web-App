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
        Schema::table('planSets', function (Blueprint $table) {
            $table->foreign('planExercise_id')
                  ->references('id')
                  ->on('planExercises')
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
        Schema::table('planSets', function (Blueprint $table) {
            $table->dropForeign(['planExercise_id']);
        });
    }
}

