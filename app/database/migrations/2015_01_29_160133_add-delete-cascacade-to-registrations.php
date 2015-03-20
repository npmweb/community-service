<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascacadeToRegistrations extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->dropForeign('registrations_occurrence_id_foreign');
            $table->foreign('occurrence_id')
                ->references('id')->on('opportunity_occurrences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function($table) {
            $table->dropForeign('registrations_occurrence_id_foreign');
            $table->foreign('occurrence_id')
                ->references('id')->on('opportunity_occurrences');
        });
    }

}
