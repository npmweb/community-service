<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidToAllModels extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // NOTE: don't need this for relational tables that will never be pulled up by ID

        Schema::table('attribute_values', function($table)
        {
            $table->string('uid',8)->unique();
        });
        Schema::table('attributes', function($table)
        {
            $table->string('uid',8)->unique();
        });
        Schema::table('opportunities', function($table)
        {
            $table->string('uid',8)->unique();
        });
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->string('uid',8)->unique();
        });
        Schema::table('registrations', function($table)
        {
            $table->string('uid',8)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_values', function($table)
        {
            $table->dropUnique('attribute_values_uid_unique');
            $table->dropColumn('uid');
        });
        Schema::table('attributes', function($table)
        {
            $table->dropUnique('attributes_uid_unique');
            $table->dropColumn('uid');
        });
        Schema::table('opportunities', function($table)
        {
            $table->dropUnique('opportunities_uid_unique');
            $table->dropColumn('uid');
        });
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->dropUnique('opportunity_occurrences_uid_unique');
            $table->dropColumn('uid');
        });
        Schema::table('registrations', function($table)
        {
            $table->dropUnique('registrations_uid_unique');
            $table->dropColumn('uid');
        });
    }

}
