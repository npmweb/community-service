<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetCountryFieldToTwoCharacters extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->char('temp_country',2);
            $table->char('temp_meeting_country',2);
        });
        DB::update('UPDATE organizations SET temp_country = SUBSTR(country,1,2)');
        DB::update('UPDATE organizations SET temp_meeting_country = SUBSTR(meeting_country,1,2)');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('country');
            $table->dropColumn('meeting_country');
        });
        Schema::table('organizations', function($table)
        {
            $table->char('country',2)->after('postal_code');
            $table->char('meeting_country',2)->after('meeting_state');
        });
        DB::update('UPDATE organizations SET country = temp_country');
        DB::update('UPDATE organizations SET meeting_country = temp_meeting_country');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('temp_country');
            $table->dropColumn('temp_meeting_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function($table)
        {
            $table->string('temp_country',45);
            $table->string('temp_meeting_country',45);
        });
        DB::update('UPDATE organizations SET temp_country = country');
        DB::update('UPDATE organizations SET temp_meeting_country = meeting_country');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('country');
            $table->dropColumn('meeting_country');
        });
        Schema::table('organizations', function($table)
        {
            $table->string('country',45)->after('postal_code');
            $table->string('meeting_country',45)->after('meeting_state');
        });
        DB::update('UPDATE organizations SET country = temp_country');
        DB::update('UPDATE organizations SET meeting_country = temp_meeting_country');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('temp_country');
            $table->dropColumn('temp_meeting_country');
        });
    }

}
