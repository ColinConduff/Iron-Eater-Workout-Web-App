<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToSessionSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessionSets', function (Blueprint $table) {
            $table->foreign('session_id')
                  ->references('id')
                  ->on('sessions')
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
        Schema::table('sessionSets', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
        });
    }
}
