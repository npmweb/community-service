<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLngToOrganization extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
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
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }

}
