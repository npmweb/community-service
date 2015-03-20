<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexesToPackageJoinTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_attributes', function($table) {
            $table->unique(['beneficiary_id','attribute_value_id'],
                'beneficiary_attributes_join_unique');
        });
        Schema::table('campaign_beneficiaries', function($table) {
            $table->unique(['campaign_id','beneficiary_id'],
                'campaign_beneficiaries_join_unique');
        });
        Schema::table('campaign_organizations', function($table) {
            $table->unique(['campaign_id','organization_id'],
                'campaign_organizations_join_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TODO: doesn't seem to work
        Schema::table('beneficiary_attributes', function($table) {
            $table->dropUnique('beneficiary_attributes_join_unique');
        });
        Schema::table('campaign_beneficiaries', function($table) {
            $table->dropUnique('campaign_beneficiaries_join_unique');
        });
        Schema::table('campaign_organizations', function($table) {
            $table->dropUnique('campaign_organizations_join_unique');
        });
    }

}
