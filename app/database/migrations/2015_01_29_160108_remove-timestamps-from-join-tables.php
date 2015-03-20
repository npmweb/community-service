<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTimestampsFromJoinTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_organizations', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('campaign_beneficiaries', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('opportunity_attributes', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_organizations', function($table)
        {
            $table->timestamps();
        });

        Schema::table('campaign_beneficiaries', function($table)
        {
            $table->timestamps();
        });

        Schema::table('opportunity_attributes', function($table)
        {
            $table->timestamps();
        });
    }

}
