<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignOrganizationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_organizations', function($table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campaign_organizations');
    }

}
