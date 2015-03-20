<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLatLngNullable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->decimal('latitude_tmp', 9, 6);
            $table->decimal('longitude_tmp', 9, 6);
        });
        DB::update('UPDATE organizations SET latitude_tmp = latitude, longitude_tmp = longitude;');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
        Schema::table('organizations', function($table)
        {
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
        });
        DB::update('UPDATE organizations SET latitude = latitude_tmp, longitude = longitude_tmp;');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('latitude_tmp');
            $table->dropColumn('longitude_tmp');
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
            $table->decimal('latitude_tmp', 9, 6);
            $table->decimal('longitude_tmp', 9, 6);
        });
        DB::update('UPDATE organizations SET latitude_tmp = latitude, longitude_tmp = longitude;');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
        Schema::table('organizations', function($table)
        {
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
        });
        DB::update('UPDATE organizations SET latitude = latitude_tmp, longitude = longitude_tmp;');
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('latitude_tmp');
            $table->dropColumn('longitude_tmp');
        });
    }

}
