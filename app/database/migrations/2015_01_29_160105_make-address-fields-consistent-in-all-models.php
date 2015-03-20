<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAddressFieldsConsistentInAllModels extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table)
        {
            $table->dropColumn('location_address');
            $table->string('location_address1',150)->nullable()->after('location_name');
            $table->string('location_address2',150)->nullable()->after('location_address1');
            $table->string('location_country',45)->nullable()->after('location_postal_code');
        });

        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropColumn('address1');
            $table->dropColumn('address2');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->string('address1', 150)->after('last_name');
            $table->string('address2', 150)->nullable()->after('address1');
        });

        Schema::table('registrations', function($table)
        {
            $table->dropColumn('address1');
            $table->dropColumn('address2');
        });
        Schema::table('registrations', function($table)
        {
            $table->string('address1', 150)->after('last_name');
            $table->string('address2', 150)->nullable()->after('address1');
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
            $table->string('location_address',150)->nullable()->after('location_name');
            $table->dropColumn('location_address1');
            $table->dropColumn('location_address2');
            $table->dropColumn('location_country');
        });

        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropColumn('address1');
            $table->dropColumn('address2');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->string('address1', 45)->after('last_name');
            $table->string('address2', 45)->nullable()->after('address1');
        });

        Schema::table('registrations', function($table)
        {
            $table->dropColumn('address1');
            $table->dropColumn('address2');
        });
        Schema::table('registrations', function($table)
        {
            $table->string('address1', 45)->after('last_name');
            $table->string('address2', 45)->nullable()->after('address1');
        });
    }

}
