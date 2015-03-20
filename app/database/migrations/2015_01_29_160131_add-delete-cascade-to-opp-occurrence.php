<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToOppOccurrence extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropForeign('opportunity_occurrences_opportunity_id_foreign');
            $table->foreign('opportunity_id')
                ->references('id')->on('opportunities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropForeign('opportunity_occurrences_opportunity_id_foreign');
            $table->foreign('opportunity_id')
                ->references('id')->on('opportunities');
        });
    }

}
