<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSignupDateNotADatetime extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->dropColumn('signup_deadline');
        });
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->date('signup_deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->dropColumn('signup_deadline');
        });
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->datetime('signup_deadline');
        });
    }

}
