<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNumFamiliesToNumSponsorships extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropColumn('num_families_to_sponsor');
            $table->integer('num_sponsorships')->nullable()->unsigned();
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
            $table->dropColumn('num_sponsorships');
            $table->integer('num_families_to_sponsor')->nullable();
        });
    }

}
