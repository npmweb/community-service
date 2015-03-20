<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeetingAddressToOrganization extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->string('meeting_city', 45)->nullable();
            $table->string('meeting_state', 45)->nullable();
            $table->string('meeting_country', 45)->nullable();
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
            $table->dropColumn('meeting_city');
            $table->dropColumn('meeting_state');
            $table->dropColumn('meeting_country');
        });
    }

}
